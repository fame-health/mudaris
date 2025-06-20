<?php

namespace App\Filament\Widgets;

use App\Models\PageVisitor;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Log;

class VisitorStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Statistik Kunjungan Halaman';
    protected static ?string $description = 'Jumlah kunjungan per halaman situs';

    // Ukuran widget
    protected static ?string $maxHeight = '400px';
    protected int | string | array $columnSpan = 'full';

    /**
     * Tentukan tipe grafik
     */
    protected function getType(): string
    {
        return 'bar';
    }

    /**
     * Dapatkan total pengunjung untuk ditampilkan di heading
     */
    public function getHeading(): ?string
    {
        try {
            $totalVisitors = PageVisitor::sum('visit_count');
            return 'Statistik Kunjungan Halaman (Total: ' . number_format($totalVisitors) . ' pengunjung)';
        } catch (\Exception $e) {
            Log::error("Gagal menghitung total pengunjung: {$e->getMessage()}");
            return 'Statistik Kunjungan Halaman';
        }
    }

    /**
     * Ambil data untuk grafik
     */
    protected function getData(): array
    {
        try {
            // Ambil data dari tabel page_visitors
            $visitors = PageVisitor::all()->pluck('visit_count', 'page_name')->toArray();

            // Daftar semua halaman yang dilacak
            $pages = [
                'Homepage',
                'FAQ Page',
                'Kebijakan Privasi',
                'Syarat & Ketentuan',
                'Tentang Kami',
                'Contact Page',
            ];

            // Siapkan data untuk grafik
            $data = [];
            $totalVisits = 0;

            foreach ($pages as $page) {
                $visitCount = $visitors[$page] ?? 0;
                $data[] = $visitCount;
                $totalVisits += $visitCount;
            }

            // Warna yang lebih menarik dengan gradasi
            $backgroundColors = [
                'rgba(76, 175, 80, 0.8)',   // Homepage - Hijau
                'rgba(33, 150, 243, 0.8)',  // FAQ Page - Biru
                'rgba(255, 152, 0, 0.8)',   // Kebijakan Privasi - Orange
                'rgba(244, 67, 54, 0.8)',   // Syarat & Ketentuan - Merah
                'rgba(96, 125, 139, 0.8)',  // Tentang Kami - Blue Grey
                'rgba(63, 81, 181, 0.8)',   // Contact Page - Indigo
            ];

            $borderColors = [
                'rgba(76, 175, 80, 1)',
                'rgba(33, 150, 243, 1)',
                'rgba(255, 152, 0, 1)',
                'rgba(244, 67, 54, 1)',
                'rgba(96, 125, 139, 1)',
                'rgba(63, 81, 181, 1)',
            ];

            return [
                'datasets' => [
                    [
                        'label' => 'Jumlah Kunjungan',
                        'data' => $data,
                        'backgroundColor' => $backgroundColors,
                        'borderColor' => $borderColors,
                        'borderWidth' => 2,
                        'borderRadius' => 4,
                        'borderSkipped' => false,
                    ],
                ],
                'labels' => $pages,
            ];

        } catch (\Exception $e) {
            Log::error("Gagal mengambil data untuk VisitorStatsWidget: {$e->getMessage()}");

            // Data fallback jika terjadi error
            $pages = [
                'Homepage',
                'FAQ Page',
                'Kebijakan Privasi',
                'Syarat & Ketentuan',
                'Tentang Kami',
                'Contact Page',
            ];

            return [
                'datasets' => [
                    [
                        'label' => 'Jumlah Kunjungan',
                        'data' => array_fill(0, count($pages), 0),
                        'backgroundColor' => [
                            'rgba(76, 175, 80, 0.8)',
                            'rgba(33, 150, 243, 0.8)',
                            'rgba(255, 152, 0, 0.8)',
                            'rgba(244, 67, 54, 0.8)',
                            'rgba(96, 125, 139, 0.8)',
                            'rgba(63, 81, 181, 0.8)',
                        ],
                        'borderColor' => [
                            'rgba(76, 175, 80, 1)',
                            'rgba(33, 150, 243, 1)',
                            'rgba(255, 152, 0, 1)',
                            'rgba(244, 67, 54, 1)',
                            'rgba(96, 125, 139, 1)',
                            'rgba(63, 81, 181, 1)',
                        ],
                        'borderWidth' => 2,
                        'borderRadius' => 4,
                    ],
                ],
                'labels' => $pages,
            ];
        }
    }

    /**
     * Konfigurasi tambahan untuk chart
     */
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                        'font' => [
                            'size' => 12,
                            'weight' => 'bold',
                        ],
                    ],
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleColor' => '#ffffff',
                    'bodyColor' => '#ffffff',
                    'borderColor' => '#ffffff',
                    'borderWidth' => 1,
                    'cornerRadius' => 6,
                    'displayColors' => true,
                    'callbacks' => [
                        'label' => 'function(context) {
                            return context.dataset.label + ": " + context.parsed.y.toLocaleString() + " pengunjung";
                        }',
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(0, 0, 0, 0.1)',
                        'drawBorder' => false,
                    ],
                    'ticks' => [
                        'font' => [
                            'size' => 11,
                        ],
                        'callback' => 'function(value) {
                            return value.toLocaleString();
                        }',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'font' => [
                            'size' => 11,
                            'weight' => 'bold',
                        ],
                        'maxRotation' => 45,
                        'minRotation' => 0,
                    ],
                ],
            ],
            'animation' => [
                'duration' => 1000,
                'easing' => 'easeInOutQuart',
            ],
        ];
    }

    /**
     * Polling interval untuk update data real-time
     */
    protected static ?string $pollingInterval = '30s';

    /**
     * Filter data berdasarkan periode (opsional)
     */
    public function getFilters(): ?array
    {
        return [
            'today' => 'Hari Ini',
            'week' => 'Minggu Ini',
            'month' => 'Bulan Ini',
            'all' => 'Semua Waktu',
        ];
    }
}
