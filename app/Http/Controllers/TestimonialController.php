<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TestimonialController
{
    /**
     * Display testimonials for homepage (one-page website)
     */
    public function homepage()
    {
        try {
            // Debug: Cek koneksi database
            Log::info('=== TESTIMONIAL DEBUG START ===');

            // Cek apakah tabel testimonials ada
            $tableExists = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name='testimonials'");
            Log::info('Table testimonials exists: ' . (count($tableExists) > 0 ? 'YES' : 'NO'));

            if (count($tableExists) == 0) {
                Log::error('Table testimonials does not exist!');
                return view('index', ['testimonis' => collect([])]);
            }

            // Cek struktur tabel
            $columns = DB::select("PRAGMA table_info(testimonials)");
            Log::info('Table columns: ' . json_encode($columns));

            // Coba raw query dulu untuk memastikan data ada
            $rawData = DB::select('SELECT * FROM testimonials');
            Log::info('Raw testimonials count: ' . count($rawData));
            Log::info('Raw data: ' . json_encode($rawData));

            // Cek apakah model Testimonial bisa diakses
            Log::info('Accessing testimonials via Eloquent...');

            // Coba ambil semua data dulu untuk debugging
            $allTestimonials = Testimonial::all();
            Log::info('Total testimonials via Eloquent: ' . $allTestimonials->count());

            if ($allTestimonials->count() == 0) {
                Log::warning('No testimonials found in database');

                // Buat dummy data untuk testing jika tidak ada data
                $dummyTestimonials = collect([
                    (object)[
                        'id' => 1,
                        'name' => 'John Doe',
                        'location' => 'Jakarta',
                        'rating' => 5,
                        'testimonial' => 'Layanan yang sangat memuaskan!',
                        'is_active' => true,
                        'created_at' => now()
                    ],
                    (object)[
                        'id' => 2,
                        'name' => 'Jane Smith',
                        'location' => 'Surabaya',
                        'rating' => 4,
                        'testimonial' => 'Pelayanan cepat dan profesional.',
                        'is_active' => true,
                        'created_at' => now()
                    ]
                ]);

                Log::info('Using dummy testimonials for display');
                return view('index', ['testimonis' => $dummyTestimonials]);
            }

            // Cek apakah kolom is_active ada
            $hasIsActiveColumn = collect($columns)->contains(function($col) {
                return $col->name === 'is_active';
            });

            Log::info('Has is_active column: ' . ($hasIsActiveColumn ? 'YES' : 'NO'));

            // Ambil testimoni berdasarkan ketersediaan kolom is_active
            if ($hasIsActiveColumn) {
                $testimonis = Testimonial::where('is_active', true)
                                ->orderBy('rating', 'desc')
                                ->orderBy('created_at', 'desc')
                                ->get();
            } else {
                // Jika tidak ada kolom is_active, ambil semua
                $testimonis = Testimonial::orderBy('rating', 'desc')
                                ->orderBy('created_at', 'desc')
                                ->get();
            }

            Log::info('Final testimonials count: ' . $testimonis->count());

            // Debug: Print data untuk memastikan
            foreach($testimonis as $testimoni) {
                Log::info("Testimoni ID {$testimoni->id}: {$testimoni->name} - Rating: {$testimoni->rating} - Text: " . substr($testimoni->testimonial, 0, 50) . "...");
            }

            Log::info('=== TESTIMONIAL DEBUG END ===');

            return view('index', compact('testimonis'));

        } catch (\Exception $e) {
            Log::error('Error in testimonial controller: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            // Return empty collection jika ada error
            $testimonis = collect([]);
            return view('index', compact('testimonis'));
        }
    }

    /**
     * API endpoint untuk mendapatkan testimoni (untuk AJAX jika diperlukan)
     */
    public function api()
    {
        try {
            // Cek apakah kolom is_active ada
            $columns = DB::select("PRAGMA table_info(testimonials)");
            $hasIsActiveColumn = collect($columns)->contains(function($col) {
                return $col->name === 'is_active';
            });

            // Query berdasarkan ketersediaan kolom
            if ($hasIsActiveColumn) {
                $testimonis = Testimonial::where('is_active', true);
            } else {
                $testimonis = Testimonial::query();
            }

            $testimonis = $testimonis->orderBy('rating', 'desc')
                                ->orderBy('created_at', 'desc')
                                ->get()
                                ->map(function ($testimoni) {
                                    return [
                                        'id' => $testimoni->id,
                                        'name' => $testimoni->name,
                                        'location' => $testimoni->location ?? 'Unknown',
                                        'rating' => $testimoni->rating,
                                        'stars' => $testimoni->stars ?? str_repeat('★', $testimoni->rating),
                                        'testimonial' => $testimoni->testimonial,
                                        'avatar_url' => $testimoni->avatar_url ?? null,
                                        'created_at' => $testimoni->created_at ? $testimoni->created_at->format('d M Y') : 'Unknown'
                                    ];
                                });

            return response()->json([
                'success' => true,
                'data' => $testimonis,
                'count' => $testimonis->count()
            ]);

        } catch (\Exception $e) {
            Log::error('API Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Debug method untuk melihat status database dan tabel
     */
    public function debug()
    {
        try {
            $debug = [];

            // Cek tabel
            $tableExists = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name='testimonials'");
            $debug['table_exists'] = count($tableExists) > 0;

            if ($debug['table_exists']) {
                // Struktur tabel
                $columns = DB::select("PRAGMA table_info(testimonials)");
                $debug['columns'] = $columns;

                // Hitung data
                $count = DB::select('SELECT COUNT(*) as count FROM testimonials')[0]->count;
                $debug['total_records'] = $count;

                // Sample data
                $sampleData = DB::select('SELECT * FROM testimonials LIMIT 3');
                $debug['sample_data'] = $sampleData;

                // Cek Eloquent
                try {
                    $eloquentCount = Testimonial::count();
                    $debug['eloquent_count'] = $eloquentCount;
                } catch (\Exception $e) {
                    $debug['eloquent_error'] = $e->getMessage();
                }
            }

            return response()->json($debug);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
