<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\PageVisitor;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TestimonialController 
{
    /**
     * Display testimonials and partners for homepage (one-page website)
     */
    public function homepage()
    {
        try {
            // Track page visit for Homepage
            Log::info('Attempting to record visit for Homepage');
            $visitor = PageVisitor::incrementVisit('Homepage');
            if ($visitor) {
                Log::info('Visit for Homepage recorded successfully, count: ' . $visitor->visit_count);
            } else {
                Log::warning('Failed to record visit for Homepage');
            }

            // Debug: Check database connection for testimonials
            Log::info('=== TESTIMONIAL DEBUG START ===');

            // Check if testimonials table exists
            $tableExists = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name='testimonials'");
            Log::info('Table testimonials exists: ' . (count($tableExists) > 0 ? 'YES' : 'NO'));

            if (count($tableExists) == 0) {
                Log::error('Table testimonials does not exist!');
                return view('index', ['testimonis' => collect([]), 'partners' => collect([])]);
            }

            // Check table structure
            $columns = DB::select("PRAGMA table_info(testimonials)");
            Log::info('Table columns: ' . json_encode($columns));

            // Raw query to verify data
            $rawData = DB::select('SELECT * FROM testimonials');
            Log::info('Raw testimonials count: ' . count($rawData));
            Log::info('Raw data: ' . json_encode($rawData));

            // Access testimonials via Eloquent
            Log::info('Accessing testimonials via Eloquent...');
            $allTestimonials = Testimonial::all();
            Log::info('Total testimonials via Eloquent: ' . $allTestimonials->count());

            if ($allTestimonials->count() == 0) {
                Log::warning('No testimonials found in database');

                // Create dummy testimonials for display
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
                return view('index', ['testimonis' => $dummyTestimonials, 'partners' => collect([])]);
            }

            // Check if is_active column exists
            $hasIsActiveColumn = collect($columns)->contains(function($col) {
                return $col->name === 'is_active';
            });
            Log::info('Has is_active column: ' . ($hasIsActiveColumn ? 'YES' : 'NO'));

            // Fetch testimonials based on is_active column
            if ($hasIsActiveColumn) {
                $testimonis = Testimonial::where('is_active', true)
                    ->orderBy('rating', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $testimonis = Testimonial::orderBy('rating', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            // Fetch partners
            Log::info('=== PARTNER DEBUG START ===');
            $tableExistsPartners = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name='partners'");
            Log::info('Table partners exists: ' . (count($tableExistsPartners) > 0 ? 'YES' : 'NO'));

            if (count($tableExistsPartners) == 0) {
                Log::error('Table partners does not exist!');
                return view('index', ['testimonis' => $testimonis, 'partners' => collect([])]);
            }

            $partners = Partner::active()->orderBy('created_at', 'desc')->get();
            Log::info('Total partners via Eloquent: ' . $partners->count());

            foreach ($partners as $partner) {
                Log::info("Partner ID {$partner->id}: {$partner->name} - Description: " . substr($partner->description, 0, 50) . "...");
            }

            Log::info('Final testimonials count: ' . $testimonis->count());
            Log::info('Final partners count: ' . $partners->count());
            Log::info('=== TESTIMONIAL AND PARTNER DEBUG END ===');

            return view('index', compact('testimonis', 'partners'));

        } catch (\Exception $e) {
            Log::error('Error in testimonial controller: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return view('index', ['testimonis' => collect([]), 'partners' => collect([])]);
        }
    }

    /**
     * API endpoint untuk mendapatkan testimoni (untuk AJAX jika diperlukan)
     */
    public function api()
    {
        try {
            // Check if is_active column exists
            $columns = DB::select("PRAGMA table_info(testimonials)");
            $hasIsActiveColumn = collect($columns)->contains(function($col) {
                return $col->name === 'is_active';
            });

            // Query based on is_active column
            $testimonis = $hasIsActiveColumn
                ? Testimonial::where('is_active', true)
                : Testimonial::query();

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

            // Check testimonials table
            $tableExists = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name='testimonials'");
            $debug['table_exists_testimonials'] = count($tableExists) > 0;

            if ($debug['table_exists_testimonials']) {
                $columns = DB::select("PRAGMA table_info(testimonials)");
                $debug['columns_testimonials'] = $columns;
                $count = DB::select('SELECT COUNT(*) as count FROM testimonials')[0]->count;
                $debug['total_records_testimonials'] = $count;
                $sampleData = DB::select('SELECT * FROM testimonials LIMIT 3');
                $debug['sample_data_testimonials'] = $sampleData;

                try {
                    $eloquentCount = Testimonial::count();
                    $debug['eloquent_count_testimonials'] = $eloquentCount;
                } catch (\Exception $e) {
                    $debug['eloquent_error_testimonials'] = $e->getMessage();
                }
            }

            // Check partners table
            $tableExistsPartners = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name='partners'");
            $debug['table_exists_partners'] = count($tableExistsPartners) > 0;

            if ($debug['table_exists_partners']) {
                $columnsPartners = DB::select("PRAGMA table_info(partners)");
                $debug['columns_partners'] = $columnsPartners;
                $countPartners = DB::select('SELECT COUNT(*) as count FROM partners')[0]->count;
                $debug['total_records_partners'] = $countPartners;
                $sampleDataPartners = DB::select('SELECT * FROM partners LIMIT 3');
                $debug['sample_data_partners'] = $sampleDataPartners;

                try {
                    $eloquentCountPartners = Partner::count();
                    $debug['eloquent_count_partners'] = $eloquentCountPartners;
                } catch (\Exception $e) {
                    $debug['eloquent_error_partners'] = $e->getMessage();
                }
            }

            return response()->json($debug);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
