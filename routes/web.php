<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\TestimonialController;
use Artesaos\SEOTools\Facades\SEOTools;

Route::get('/', [TestimonialController::class, 'homepage'])->name('home');

// FAQ
Route::get('/faq', function () {
    SEOTools::setTitle('FAQ - Mudaris Mandiri Wisata', false);
    SEOTools::setDescription('Temukan jawaban atas pertanyaan umum tentang paket umroh kami di Mudaris Mandiri Wisata. Informasi lengkap untuk perjalanan ibadah Anda.');
    SEOTools::opengraph()->setUrl('https://mudarismandiriwisata.com/faq');
    SEOTools::opengraph()->setTitle('FAQ - Mudaris Mandiri Wisata');
    SEOTools::opengraph()->setDescription('Temukan jawaban atas pertanyaan umum tentang paket umroh kami di Mudaris Mandiri Wisata.');
    SEOTools::twitter()->setTitle('FAQ - Mudaris Mandiri Wisata');
    SEOTools::twitter()->setDescription('Temukan jawaban atas pertanyaan umum tentang paket umroh kami.');
    SEOTools::jsonLd()->setTitle('FAQ - Mudaris Mandiri Wisata');
    SEOTools::jsonLd()->setDescription('Temukan jawaban atas pertanyaan umum tentang paket umroh kami di Mudaris Mandiri Wisata.');
    SEOTools::jsonLd()->setType('WebPage');

    return view('faq.index');
})->name('faq');

// Kebijakan Privasi
Route::get('/kebijakan-privasi', function () {
    SEOTools::setTitle('Kebijakan Privasi - Mudaris Mandiri Wisata', false);
    SEOTools::setDescription('Baca kebijakan privasi Mudaris Mandiri Wisata untuk memahami bagaimana kami melindungi data pribadi Anda selama proses pendaftaran umroh.');
    SEOTools::opengraph()->setUrl('https://mudarismandiriwisata.com/kebijakan-privasi');
    SEOTools::opengraph()->setTitle('Kebijakan Privasi - Mudaris Mandiri Wisata');
    SEOTools::opengraph()->setDescription('Baca kebijakan privasi Mudaris Mandiri Wisata untuk perlindungan data Anda.');
    SEOTools::twitter()->setTitle('Kebijakan Privasi - Mudaris Mandiri Wisata');
    SEOTools::twitter()->setDescription('Baca kebijakan privasi Mudaris Mandiri Wisata.');
    SEOTools::jsonLd()->setTitle('Kebijakan Privasi - Mudaris Mandiri Wisata');
    SEOTools::jsonLd()->setDescription('Baca kebijakan privasi Mudaris Mandiri Wisata untuk perlindungan data Anda.');
    SEOTools::jsonLd()->setType('WebPage');

    return view('kebijakan_privasi.index');
})->name('privacy');

// Syarat & Ketentuan
Route::get('/syarat-ketentuan', function () {
    SEOTools::setTitle('Syarat & Ketentuan - Mudaris Mandiri Wisata', false);
    SEOTools::setDescription('Pelajari syarat dan ketentuan layanan umroh dari Mudaris Mandiri Wisata untuk memastikan perjalanan ibadah Anda berjalan lancar.');
    SEOTools::opengraph()->setUrl('https://mudarismandiriwisata.com/syarat-ketentuan');
    SEOTools::opengraph()->setTitle('Syarat & Ketentuan - Mudaris Mandiri Wisata');
    SEOTools::opengraph()->setDescription('Pelajari syarat dan ketentuan layanan umroh dari Mudaris Mandiri Wisata.');
    SEOTools::twitter()->setTitle('Syarat & Ketentuan - Mudaris Mandiri Wisata');
    SEOTools::twitter()->setDescription('Pelajari syarat dan ketentuan layanan umroh kami.');
    SEOTools::jsonLd()->setTitle('Syarat & Ketentuan - Mudaris Mandiri Wisata');
    SEOTools::jsonLd()->setDescription('Pelajari syarat dan ketentuan layanan umroh dari Mudaris Mandiri Wisata.');
    SEOTools::jsonLd()->setType('WebPage');

    return view('syarat_ketentuan.index');
})->name('terms');

// Tentang Kami
Route::get('/tentang-kami', function () {
    SEOTools::setTitle('Tentang Kami - Mudaris Mandiri Wisata', false);
    SEOTools::setDescription('Ketahui lebih lanjut tentang Mudaris Mandiri Wisata, agen umroh terpercaya dengan pengalaman lebih dari 15 tahun melayani jamaah.');
    SEOTools::opengraph()->setUrl('https://mudarismandiriwisata.com/tentang-kami');
    SEOTools::opengraph()->setTitle('Tentang Kami - Mudaris Mandiri Wisata');
    SEOTools::opengraph()->setDescription('Ketahui lebih lanjut tentang Mudaris Mandiri Wisata, agen umroh terpercaya.');
    SEOTools::twitter()->setTitle('Tentang Kami - Mudaris Mandiri Wisata');
    SEOTools::twitter()->setDescription('Ketahui lebih lanjut tentang Mudaris Mandiri Wisata.');
    SEOTools::jsonLd()->setTitle('Tentang Kami - Mudaris Mandiri Wisata');
    SEOTools::jsonLd()->setDescription('Ketahui lebih lanjut tentang Mudaris Mandiri Wisata, agen umroh terpercaya.');
    SEOTools::jsonLd()->setType('WebPage');

    return view('tentang_kami.index');
})->name('about');

// Contact Form Routes (public)
Route::get('/contact', [ContactFormController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactFormController::class, 'store'])->name('contact.store');
Route::get('/contact/thank-you', [ContactFormController::class, 'thankYou'])->name('contact.thank-you');

// API untuk testimoni (untuk AJAX jika diperlukan)
Route::get('/api/testimoni', [TestimonialController::class, 'api'])->name('testimoni.api');
Route::get('/testimonials/debug', [TestimonialController::class, 'debug']);
