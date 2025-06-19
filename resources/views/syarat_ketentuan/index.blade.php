<!DOCTYPE html>
<html lang="id">
<head>
  <!-- Basic Meta Tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Primary Meta Tags -->
  <title>Syarat dan Ketentuan | Mudaris Mandiri Wisata</title>
  <meta name="title" content="Syarat dan Ketentuan | Mudaris Mandiri Wisata">
  <meta name="description" content="Pelajari syarat dan ketentuan layanan umroh dari Mudaris Mandiri Wisata untuk memastikan perjalanan ibadah Anda berjalan lancar.">
  <meta name="keywords" content="syarat umroh, ketentuan umroh, travel umroh, Mudaris Mandiri Wisata, biaya umroh, pendaftaran umroh, kebijakan pembatalan umroh">
  <meta name="author" content="Mudaris Mandiri Wisata">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

  <!-- Canonical URL -->
  <link rel="canonical" href="https://mudarismandiriwisata.com/syarat-ketentuan">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Mudaris Mandiri Wisata">
  <meta property="og:title" content="Syarat dan Ketentuan - Mudaris Mandiri Wisata">
  <meta property="og:description" content="Pelajari syarat dan ketentuan layanan umroh dari Mudaris Mandiri Wisata untuk memastikan perjalanan ibadah Anda berjalan lancar.">
  <meta property="og:image" content="https://mudarismandiriwisata.com/images/og-image-syarat-ketentuan.jpg">
  <meta property="og:url" content="https://mudarismandiriwisata.com/syarat-ketentuan">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@mudarismandiriwisata">
  <meta name="twitter:creator" content="@mudarismandiriwisata">
  <meta name="twitter:title" content="Syarat dan Ketentuan - Mudaris Mandiri Wisata">
  <meta name="twitter:description" content="Pelajari syarat dan ketentuan layanan umroh dari Mudaris Mandiri Wisata.">
  <meta name="twitter:image" content="https://mudarismandiriwisata.com/images/twitter-card-syarat-ketentuan.jpg">

  <!-- JSON-LD Schema -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Syarat dan Ketentuan - Mudaris Mandiri Wisata",
    "description": "Pelajari syarat dan ketentuan layanan umroh dari Mudaris Mandiri Wisata untuk memastikan perjalanan ibadah Anda berjalan lancar.",
    "url": "https://mudarismandiriwisata.com/syarat-ketentuan",
    "publisher": {
      "@type": "Organization",
      "name": "Mudaris Mandiri Wisata",
      "logo": {
        "@type": "ImageObject",
        "url": "https://mudarismandiriwisata.com/assets/images/logo.png"
      }
    },
    "mainEntity": {
      "@type": "CreativeWork",
      "name": "Syarat dan Ketentuan",
      "text": "Dokumen ini berisi ketentuan umum, syarat pendaftaran, ketentuan pembayaran, kebijakan pembatalan, tanggung jawab, dan ketentuan lain-lain untuk layanan umroh Mudaris Mandiri Wisata."
    }
  }
  </script>

  <!-- Favicon Section for Laravel -->
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('android-chrome-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('android-chrome-512x512.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom Styles -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    * {
      font-family: 'Poppins', sans-serif;
    }

    /* Warna utama biru (gradient identik biru) */
    .gradient-bg {
      background: linear-gradient(135deg, #0052CC 0%, #0ea5e9 50%, #6366f1 100%);
    }

    /* Hero section biru muda */
    .hero-gradient {
      background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 50%, #60a5fa 100%);
    }

    /* Hover effect card */
    .card-hover {
      transition: all 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* kebijakan-privasi Accordion Animation */
    .kebijakan-privasi-content {
      max-height: 0;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .kebijakan-privasi-content.active {
      max-height: 500px;
    }

    .kebijakan-privasi-toggle {
      transition: transform 0.3s ease;
    }

    .kebijakan-privasi-toggle.active {
      transform: rotate(180deg);
    }

    /* Fade-in animation */
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.6s ease;
    }

    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Glassmorphism effect */
    .glass-morphism {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.18);
    }

    /* Search box styling */
    .search-box {
      position: relative;
    }

    .search-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, #f59e0b, #f97316);
      border-radius: 15px;
      padding: 2px;
      z-index: -1;
    }

    .search-box input {
      background: white;
      border-radius: 13px;
    }

    /* Category buttons */
    .category-btn {
      transition: all 0.3s ease;
    }

    .category-btn.active {
      background: linear-gradient(135deg, #0052CC 0%, #0ea5e9 50%, #6366f1 100%);
      color: white;
      transform: translateY(-2px);
    }

    /* Mobile menu animation */
    #mobile-menu {
      transition: all 0.3s ease;
      max-height: 0;
      overflow: hidden;
    }

    #mobile-menu.active {
      max-height: 500px;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 overflow-x-hidden">

  <!-- Navbar -->
  <nav class="glass-morphism fixed w-full z-50 top-0 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-20 items-center">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center space-x-3">
          <div class="items-center justify-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-40 h-26 object-contain" />
          </div>
        </div>

<!-- Desktop Menu -->
<div class="hidden md:flex space-x-8" id="desktopMenu">
  <a href="/" class="nav-link relative text-gray-700 hover:text-yellow-600 transition-colors duration-300 group">
    Beranda
    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-600 transition-all duration-300 group-hover:w-full"></span>
  </a>
  <a href="/kebijakan-privasi" class="nav-link relative text-gray-700 hover:text-yellow-600 transition-colors duration-300 group">
    Kebijakan dan Privasi
    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-600 transition-all duration-300 group-hover:w-full"></span>
  </a>
  <a href="/faq" class="nav-link relative text-gray-700 hover:text-yellow-600 transition-colors duration-300 group">
    FAQ
    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-600 transition-all duration-300 group-hover:w-full"></span>
  </a>
  <a href="/tentang-kami" class="nav-link relative text-gray-700 hover:text-yellow-600 transition-colors duration-300 group">
    Tentang Kami
    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-600 transition-all duration-300 group-hover:w-full"></span>
  </a>
  <a href="/syarat-ketentuan" class="nav-link relative text-gray-700 hover:text-yellow-600 transition-colors duration-300 group">
    Syarat dan Ketentuan
    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-600 transition-all duration-300 group-hover:w-full"></span>
  </a>
</div>

        <!-- CTA Desktop -->
        <div class="hidden md:flex">
          <button class="gradient-bg text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
            Konsultasi Gratis
          </button>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
          <button id="menu-btn" class="text-gray-700 hover:text-yellow-600 transition-colors">
            <i class="fas fa-bars text-2xl"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden glass-morphism absolute top-20 left-0 right-0 w-full z-50">
      <div class="px-4 pt-2 pb-6 space-y-4 bg-white shadow-md rounded-b-xl">
        <a href="/" class="block py-3 px-4 text-gray-700 hover:bg-yellow-50 rounded-lg transition-colors">Beranda</a>
        <a href="/faq" class="block py-3 px-4 text-gray-700 hover:bg-yellow-50 rounded-lg transition-colors">FAQ</a>
        <a href="/tentang-kami" class="block py-3 px-4 text-gray-700 hover:bg-yellow-50 rounded-lg transition-colors">Tentang Kami</a>
        <a href="/kebijakan-privasi" class="block py-3 px-4 text-yellow-600 font-semibold bg-yellow-50 rounded-lg">Kebijakan dan Privasi</a>
        <a href="syarat-ketentuan" class="block py-3 px-4 text-gray-700 hover:bg-yellow-50 rounded-lg transition-colors">Syarat dan ketentuan</a>
        <button class="w-full gradient-bg text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all duration-300">
          Konsultasi Gratis
        </button>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="pt-32 pb-20 hero-gradient relative overflow-hidden">
    <div class="absolute inset-0 bg-white/10"></div>
    <div class="max-w-6xl mx-auto px-4 relative z-10">
      <div class="text-center fade-in">
        <div class="inline-flex items-center justify-center w-20 h-20 gradient-bg rounded-full mb-6">
          <i class="fas fa-question-circle text-3xl text-white"></i>
        </div>
        <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-blue-800 to-blue-600 bg-clip-text text-transparent">
          Syarat dan ketentuan
        </h1>
        <p class="text-xl md:text-2xl text-blue-700 mb-8 max-w-3xl mx-auto">
          Ketentuan yang mengatur penggunaan layanan umoroh Mudaris Mandiri Wisata
        </p>
      </div>
    </div>
  </section>


  <!-- Search & Filter Section -->
  <section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
      <div class="flex flex-col md:flex-row gap-6 items-center justify-between">
        <!-- Search Box -->
        <div class="search-box w-full md:w-2/3">
          <div class="relative">
            <input
              type="text"
              id="searchFAQ"
              placeholder="Cari pertanyaan..."
              class="w-full px-6 py-4 pl-12 text-lg border-0 focus:ring-2 focus:ring-yellow-500 focus:outline-none"
            >
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
          </div>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap gap-2 w-full md:w-1/3 justify-center md:justify-end">
          <button class="category-btn active px-4 py-2 rounded-full border border-gray-300 text-sm font-medium" data-category="all">
            Semua
          </button>
          <button class="category-btn px-4 py-2 rounded-full border border-gray-300 text-sm font-medium" data-category="umum">
            Umum
          </button>
          <button class="category-btn px-4 py-2 rounded-full border border-gray-300 text-sm font-medium" data-category="paket">
            Paket
          </button>
          <button class="category-btn px-4 py-2 rounded-full border border-gray-300 text-sm font-medium" data-category="pembayaran">
            Pembayaran
          </button>
        </div>
      </div>
    </div>
  </section>

<!-- Kebijakan Privasi Section -->
<!-- Tentang Kami Section -->
<!-- Syarat dan Ketentuan Section -->
<section id="syarat-ketentuan" class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Section Header -->


    <!-- Important Notice -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-xl mb-12 fade-in">
      <div class="flex items-start">
        <i class="fas fa-exclamation-triangle text-blue-500 text-xl mr-4 mt-1"></i>
        <div>
          <h3 class="text-lg font-semibold text-blue-800 mb-2">Pemberitahuan Penting</h3>
          <p class="text-blue-700">
            Dengan mendaftar dan menggunakan layanan kami, Anda dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku.
          </p>
        </div>
      </div>
    </div>

    <!-- Terms Content -->
    <div class="space-y-12">

      <!-- 1. Ketentuan Umum -->
      <div class="bg-white rounded-2xl p-8 shadow-lg fade-in">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center mr-4">
            <span class="text-white font-bold text-lg">1</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-800">Ketentuan Umum</h3>
        </div>
        <div class="space-y-4 text-gray-600">
          <div class="flex items-start space-x-3">
            <i class="fas fa-check-circle text-green-500 mt-1"></i>
            <p>Mudaris Mandiri Wisata adalah Penyelenggara Perjalanan Ibadah Umroh (PPIU) yang telah memiliki izin resmi dari Kementerian Agama Republik Indonesia.</p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-check-circle text-green-500 mt-1"></i>
            <p>Layanan kami meliputi pengurusan visa, tiket pesawat, akomodasi hotel, transportasi, konsumsi, dan bimbingan ibadah umroh.</p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-check-circle text-green-500 mt-1"></i>
            <p>Semua jamaah wajib mengikuti ketentuan yang ditetapkan oleh pemerintah Arab Saudi dan Republik Indonesia.</p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-check-circle text-green-500 mt-1"></i>
            <p>Syarat dan ketentuan ini dapat berubah sewaktu-waktu dan akan diberitahukan kepada jamaah.</p>
          </div>
        </div>
      </div>

      <!-- 2. Syarat Pendaftaran -->
      <div class="bg-white rounded-2xl p-8 shadow-lg fade-in">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center mr-4">
            <span class="text-white font-bold text-lg">2</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-800">Syarat Pendaftaran</h3>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Dokumen Wajib</h4>
            <ul class="space-y-2 text-gray-600">
              <li class="flex items-start space-x-2">
                <i class="fas fa-id-card text-blue-500 mt-1"></i>
                <span>KTP yang masih berlaku</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-passport text-blue-500 mt-1"></i>
                <span>Paspor dengan masa berlaku minimal 6 bulan</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-camera text-blue-500 mt-1"></i>
                <span>Pas foto 4x6 background putih (4 lembar)</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-certificate text-blue-500 mt-1"></i>
                <span>Sertifikat vaksin Meningitis</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-file-medical text-blue-500 mt-1"></i>
                <span>Surat keterangan sehat dari dokter</span>
              </li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Persyaratan Umum</h4>
            <ul class="space-y-2 text-gray-600">
              <li class="flex items-start space-x-2">
                <i class="fas fa-user-check text-green-500 mt-1"></i>
                <span>Beragama Islam</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-calendar-alt text-green-500 mt-1"></i>
                <span>Usia minimal 12 tahun</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-heart text-green-500 mt-1"></i>
                <span>Sehat jasmani dan rohani</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-users text-green-500 mt-1"></i>
                <span>Wanita di bawah 45 tahun wajib dengan mahram</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-signature text-green-500 mt-1"></i>
                <span>Menandatangani kontrak perjalanan</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- 3. Ketentuan Pembayaran -->
      <div class="bg-white rounded-2xl p-8 shadow-lg fade-in">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center mr-4">
            <span class="text-white font-bold text-lg">3</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-800">Ketentuan Pembayaran</h3>
        </div>
        <div class="space-y-6">
          <div class="bg-blue-50 rounded-xl p-6">
            <h4 class="text-lg font-semibold text-blue-800 mb-3">Sistem Pembayaran</h4>
            <div class="grid md:grid-cols-3 gap-4 text-sm">
              <div class="bg-white rounded-lg p-4 text-center">
                <i class="fas fa-hand-holding-usd text-2xl text-green-500 mb-2"></i>
                <div class="font-semibold">DP Pendaftaran</div>
                <div class="text-gray-600">Rp 5.000.000</div>
              </div>
              <div class="bg-white rounded-lg p-4 text-center">
                <i class="fas fa-credit-card text-2xl text-yellow-500 mb-2"></i>
                <div class="font-semibold">Cicilan 1</div>
                <div class="text-gray-600">60 hari sebelum berangkat</div>
              </div>
              <div class="bg-white rounded-lg p-4 text-center">
                <i class="fas fa-money-check-alt text-2xl text-blue-500 mb-2"></i>
                <div class="font-semibold">Pelunasan</div>
                <div class="text-gray-600">30 hari sebelum berangkat</div>
              </div>
            </div>
          </div>
          <div class="space-y-3 text-gray-600">
            <div class="flex items-start space-x-3">
              <i class="fas fa-info-circle text-blue-500 mt-1"></i>
              <p>Pembayaran dapat dilakukan melalui transfer bank, cash, atau cicilan dengan bunga 0%.</p>
            </div>
            <div class="flex items-start space-x-3">
              <i class="fas fa-exclamation-triangle text-yellow-500 mt-1"></i>
              <p>Keterlambatan pembayaran dapat mengakibatkan pembatalan keberangkatan.</p>
            </div>
            <div class="flex items-start space-x-3">
              <i class="fas fa-receipt text-green-500 mt-1"></i>
              <p>Bukti pembayaran wajib disimpan dan ditunjukkan saat diminta.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. Kebijakan Pembatalan -->
      <div class="bg-white rounded-2xl p-8 shadow-lg fade-in">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center mr-4">
            <span class="text-white font-bold text-lg">4</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-800">Kebijakan Pembatalan</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="bg-gray-50">
                <th class="text-left p-4 font-semibold">Waktu Pembatalan</th>
                <th class="text-left p-4 font-semibold">Biaya Admin</th>
                <th class="text-left p-4 font-semibold">Dana Dikembalikan</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr>
                <td class="p-4">120+ hari sebelum berangkat</td>
                <td class="p-4 text-red-600">Rp 2.000.000</td>
                <td class="p-4 text-green-600">Sisa dana</td>
              </tr>
              <tr>
                <td class="p-4">90-119 hari sebelum berangkat</td>
                <td class="p-4 text-red-600">Rp 4.000.000</td>
                <td class="p-4 text-green-600">Sisa dana</td>
              </tr>
              <tr>
                <td class="p-4">60-89 hari sebelum berangkat</td>
                <td class="p-4 text-red-600">Rp 6.000.000</td>
                <td class="p-4 text-green-600">Sisa dana</td>
              </tr>
              <tr>
                <td class="p-4">30-59 hari sebelum berangkat</td>
                <td class="p-4 text-red-600">50% dari total</td>
                <td class="p-4 text-green-600">50% dari total</td>
              </tr>
              <tr>
                <td class="p-4">Kurang dari 30 hari</td>
                <td class="p-4 text-red-600">100% dari total</td>
                <td class="p-4 text-red-600">Tidak ada</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
          <p class="text-sm text-yellow-800">
            <i class="fas fa-info-circle mr-2"></i>
            Pembatalan karena visa ditolak akan dikenakan biaya administrasi sesuai ketentuan di atas.
          </p>
        </div>
      </div>

      <!-- 5. Tanggung Jawab -->
      <div class="bg-white rounded-2xl p-8 shadow-lg fade-in">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center mr-4">
            <span class="text-white font-bold text-lg">5</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-800">Tanggung Jawab</h3>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
          <div>
            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
              <i class="fas fa-building text-blue-500 mr-2"></i>
              Tanggung Jawab Perusahaan
            </h4>
            <ul class="space-y-3 text-gray-600">
              <li class="flex items-start space-x-2">
                <i class="fas fa-plane text-green-500 mt-1"></i>
                <span>Menyediakan tiket pesawat sesuai jadwal</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-bed text-green-500 mt-1"></i>
                <span>Menyediakan akomodasi hotel sesuai paket</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-bus text-green-500 mt-1"></i>
                <span>Menyediakan transportasi selama di Arab Saudi</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-user-graduate text-green-500 mt-1"></i>
                <span>Memberikan bimbingan ibadah umroh</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-headset text-green-500 mt-1"></i>
                <span>Memberikan layanan support 24/7</span>
              </li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
              <i class="fas fa-user text-blue-500 mr-2"></i>
              Tanggung Jawab Jamaah
            </h4>
            <ul class="space-y-3 text-gray-600">
              <li class="flex items-start space-x-2">
                <i class="fas fa-file-alt text-red-500 mt-1"></i>
                <span>Melengkapi dokumen sesuai ketentuan</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-clock text-red-500 mt-1"></i>
                <span>Hadir tepat waktu sesuai jadwal</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-rules text-red-500 mt-1"></i>
                <span>Mematuhi peraturan selama perjalanan</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-luggage-cart text-red-500 mt-1"></i>
                <span>Menjaga barang bawaan pribadi</span>
              </li>
              <li class="flex items-start space-x-2">
                <i class="fas fa-user-friends text-red-500 mt-1"></i>
                <span>Menjaga keharmonisan kelompok</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- 6. Ketentuan Lain-lain -->
      <div class="bg-white rounded-2xl p-8 shadow-lg fade-in">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center mr-4">
            <span class="text-white font-bold text-lg">6</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-800">Ketentuan Lain-lain</h3>
        </div>
        <div class="space-y-4 text-gray-600">
          <div class="flex items-start space-x-3">
            <i class="fas fa-shield-alt text-blue-500 mt-1"></i>
            <p><strong>Asuransi:</strong> Semua jamaah wajib memiliki asuransi perjalanan yang telah disediakan dalam paket.</p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-medkit text-green-500 mt-1"></i>
            <p><strong>Kesehatan:</strong> Jamaah yang memiliki riwayat penyakit serius wajib melaporkan kepada perusahaan.</p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-ban text-red-500 mt-1"></i>
            <p><strong>Barang Terlarang:</strong> Dilarang membawa barang-barang yang tidak sesuai dengan ketentuan Arab Saudi.</p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-gavel text-purple-500 mt-1"></i>
            <p><strong>Hukum:</strong> Syarat dan ketentuan ini tunduk pada hukum Republik Indonesia.</p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-phone text-orange-500 mt-1"></i>
            <p><strong>Kontak Darurat:</strong> Perusahaan menyediakan kontak darurat 24/7 selama perjalanan.</p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-edit text-teal-500 mt-1"></i>
            <p><strong>Perubahan:</strong> Perusahaan berhak mengubah syarat dan ketentuan dengan pemberitahuan kepada jamaah.</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Contact Information -->
    <div class="mt-16 gradient-bg rounded-2xl p-8 text-white text-center fade-in">
      <h3 class="text-2xl font-bold mb-4">Butuh Bantuan?</h3>
      <p class="text-blue-100 mb-6">Tim customer service kami siap membantu Anda 24/7</p>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="flex items-center justify-center space-x-2">
          <i class="fas fa-phone text-xl"></i>
          <span>+62 821-xxxx-xxxx</span>
        </div>
        <div class="flex items-center justify-center space-x-2">
          <i class="fas fa-envelope text-xl"></i>
          <span>info@mudarismandiri.com</span>
        </div>
        <div class="flex items-center justify-center space-x-2">
          <i class="fab fa-whatsapp text-xl"></i>
          <span>WhatsApp 24/7</span>
        </div>
      </div>
    </div>

    <!-- Agreement -->
    <div class="mt-8 bg-green-50 border-2 border-green-200 rounded-xl p-6 text-center fade-in">
      <i class="fas fa-check-circle text-3xl text-green-500 mb-4"></i>
      <h3 class="text-xl font-semibold text-green-800 mb-2">Persetujuan</h3>
      <p class="text-green-700">
        Dengan melakukan pendaftaran, Anda menyatakan telah membaca dan menyetujui seluruh syarat dan ketentuan di atas.
      </p>
    </div>

  </div>
</section>




  <!-- CTA Section -->
  <section class="py-20 gradient-bg">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <div class="fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          Masih Ada Pertanyaan?
        </h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
          Tim customer service kami siap membantu Anda 24/7 untuk menjawab semua pertanyaan seputar umroh
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="https://wa.me/6285211451111" target="_blank" class="inline-flex items-center justify-center px-8 py-4 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105">
            <i class="fab fa-whatsapp mr-2 text-xl"></i>
            Chat WhatsApp
          </a>
          <a href="tel:+6285211451111" class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-100 text-blue-600 font-semibold rounded-full transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-phone mr-2"></i>
            Telepon Sekarang
          </a>
        </div>
      </div>
    </div>
  </section>




<!-- Pastikan menambahkan CSRF token di head -->
<meta name="csrf-token" content="{{ csrf_token() }}">
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
<div class="flex-shrink-0 flex items-center space-x-3">
  <div class=" items-center justify-center">
    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-40 h-26 object-contain" />
  </div>
</div>
          <p class="text-gray-400 mb-6">Melayani perjalanan umroh dengan penuh amanah dan berkah sejak 2010.</p>
          <div class="flex space-x-4">
            <a href="#" class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center text-gray-300 hover:bg-yellow-600 hover:text-white transition-colors">
              <i class="fab fa-facebook-f text-sm"></i>
            </a>
            <a href="#" class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center text-gray-300 hover:bg-yellow-600 hover:text-white transition-colors">
              <i class="fab fa-whatsapp text-sm"></i>
            </a>
            <a href="#" class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center text-gray-300 hover:bg-yellow-600 hover:text-white transition-colors">
              <i class="fab fa-instagram text-sm"></i>
            </a>
          </div>
        </div>

        <div>
          <h4 class="text-lg font-semibold mb-4">Layanan</h4>
          <ul class="space-y-2 text-gray-400">
            <li><a href="#" class="hover:text-white transition-colors">Umroh Reguler</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Umroh VIP</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Umroh Keluarga</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Konsultasi</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-semibold mb-4">Informasi</h4>
          <ul class="space-y-2 text-gray-400">
            <li><a href="/tentang-kami" class="hover:text-white transition-colors">Tentang Kami</a></li>
            <li><a href="/syarat-ketentuan" class="hover:text-white transition-colors">Syarat & Ketentuan</a></li>
            <li><a href="/kebijakan-privasi" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
            <li><a href="/faq" class="hover:text-white transition-colors">FAQ</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-semibold mb-4">Kontak</h4>
          <ul class="space-y-2 text-gray-400">
            <li class="flex items-center">
              <i class="fas fa-phone mr-2"></i>
              +62 821-8480-8256
            </li>
            <li class="flex items-center">
              <i class="fas fa-envelope mr-2"></i>
              mudariswisata@gmail.com
            </li>
            <li class="flex items-center">
              <i class="fas fa-map-marker-alt mr-2"></i>
              Pekanbaru, Riau
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
        <p>&copy; 2012 - Mundaris Mandiri Wisata ❤️ for jamaah Indonesia.</p>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp Button -->
  <div class="fixed bottom-6 right-6 z-50">
    <a href="https://wa.me/6285211451111" target="_blank" class="w-14 h-14 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg hover:shadow-xl transition-all duration-300 floating-animation">
      <i class="fab fa-whatsapp text-2xl"></i>
    </a>
  </div>


<script>
    // Mudaris Mandiri Wisata - Enhanced Interactive JavaScript with User Guide Notifications

document.addEventListener('DOMContentLoaded', function() {

    // ============ GUIDE NOTIFICATION SYSTEM ============
    let guideNotificationCount = 0;
    let isFirstVisit = true;
    let hasShownScrollGuide = false;
    let hasShownMenuGuide = false;
    let hasShownFormGuide = false;

    // Initialize user guide
    setTimeout(() => {
        if (isFirstVisit) {
            showGuideNotification('👋 Selamat datang di Mudaris Mandiri Wisata! Scroll ke bawah untuk melihat paket umroh terbaik kami.', 'welcome', 3000);
            isFirstVisit = false;
        }
    }, 1000);

    // ============ MOBILE MENU FUNCTIONALITY ============
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuIcon = menuBtn.querySelector('i');

    // Toggle mobile menu
    if (menuBtn) {
        menuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('active');

            // Show guide for first time menu usage
            if (!hasShownMenuGuide) {
                showGuideNotification('📱 Menu mobile telah dibuka! Klik di luar menu atau tombol ✕ untuk menutup.', 'guide');
                hasShownMenuGuide = true;
            }

            // Toggle icon
            if (mobileMenu.classList.contains('active')) {
                mobileMenuIcon.className = 'fas fa-times text-2xl mobile-menu-icon active';
                showGuideNotification('📋 Pilih menu yang ingin Anda kunjungi', 'info', 2000);
            } else {
                mobileMenuIcon.className = 'fas fa-bars text-2xl mobile-menu-icon';
                showGuideNotification('✅ Menu ditutup', 'success', 1500);
            }
        });
    }

    // Close mobile menu when clicking on menu links
    const mobileMenuLinks = mobileMenu?.querySelectorAll('a');
    mobileMenuLinks?.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('active');
            mobileMenuIcon.className = 'fas fa-bars text-2xl mobile-menu-icon';

            const sectionName = this.textContent.trim();
            showGuideNotification(`🎯 Menuju ke bagian ${sectionName}...`, 'info', 2000);
        });
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (mobileMenu && !menuBtn?.contains(e.target) && !mobileMenu.contains(e.target)) {
            if (mobileMenu.classList.contains('active')) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('active');
                mobileMenuIcon.className = 'fas fa-bars text-2xl mobile-menu-icon';
                showGuideNotification('👆 Menu ditutup karena Anda klik di luar area', 'info', 2000);
            }
        }
    });

    // ============ NAVBAR SCROLL EFFECT ============
    const navbar = document.getElementById('navbar');
    let lastScrollTop = 0;

    window.addEventListener('scroll', throttle(function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Show scroll guide notification
        if (scrollTop > 50 && !hasShownScrollGuide) {
            showGuideNotification('🔄 Navbar akan berubah transparan saat Anda scroll! Coba scroll lebih banyak.', 'guide');
            hasShownScrollGuide = true;
        }

        // Change navbar background on scroll
        if (navbar) {
            if (scrollTop > 100) {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.backdropFilter = 'blur(20px)';
                navbar.style.boxShadow = '0 8px 32px 0 rgba(31, 38, 135, 0.37)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.25)';
                navbar.style.backdropFilter = 'blur(10px)';
                navbar.style.boxShadow = 'none';
            }

            // Hide/show navbar on scroll
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                navbar.style.transform = 'translateY(-100%)';
            } else {
                navbar.style.transform = 'translateY(0)';
            }
        }

        lastScrollTop = scrollTop;
    }, 100));

    // ============ SMOOTH SCROLLING FOR NAVIGATION LINKS ============
    const navLinks = document.querySelectorAll('a[href^="#"]');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            const linkText = this.textContent.trim();

            if (targetSection) {
                const navbarHeight = navbar?.offsetHeight || 0;
                const targetPosition = targetSection.offsetTop - navbarHeight - 20;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                showGuideNotification(`🎯 Menuju ke bagian ${linkText}...`, 'info', 2000);
            }
        });
    });

    // ============ SCROLL REVEAL ANIMATION ============
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');

                // Show section-specific guides
                const sectionId = entry.target.id || entry.target.closest('[id]')?.id;
                showSectionGuide(sectionId);
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach(el => observer.observe(el));

    // ============ ANIMATED COUNTER FOR STATS ============
    const animateCounter = (element, target, duration = 2000) => {
        let start = 0;
        const increment = target / (duration / 16);

        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                element.textContent = target + (element.textContent.includes('+') ? '+' : '') +
                                   (element.textContent.includes('%') ? '%' : '');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(start) + (element.textContent.includes('+') ? '+' : '') +
                                   (element.textContent.includes('%') ? '%' : '');
            }
        }, 16);
    };

    // Animate stats when they come into view
    const statsSection = document.querySelector('.gradient-bg');
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = entry.target.querySelectorAll('.text-4xl');

                statNumbers.forEach(stat => {
                    const text = stat.textContent;
                    const number = parseInt(text.replace(/\D/g, ''));
                    if (number) {
                        stat.textContent = '0' + (text.includes('+') ? '+' : '') +
                                         (text.includes('%') ? '%' : '');
                        animateCounter(stat, number);
                    }
                });

                showGuideNotification('📊 Lihat statistik kami yang menakjubkan!', 'info', 2500);
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    if (statsSection) {
        statsObserver.observe(statsSection);
    }


    // ============ SECTION-SPECIFIC GUIDES ============
    function showSectionGuide(sectionId) {


        if (guides[sectionId]) {
            setTimeout(() => {
                showGuideNotification(guides[sectionId], 'guide', 3000);
            }, 500);
        }
    }

});

// ============ ENHANCED UTILITY FUNCTIONS ============

// Email validation
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Enhanced notification system
function showNotification(message, type = 'info', duration = 5000) {
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }

    const notification = document.createElement('div');
    notification.className = `notification fixed top-24 right-4 z-50 p-4 rounded-xl shadow-lg transform translate-x-full transition-all duration-300 max-w-sm`;

    const colors = {
        success: 'bg-green-500 text-white border-l-4 border-green-700',
        error: 'bg-red-500 text-white border-l-4 border-red-700',
        info: 'bg-blue-500 text-white border-l-4 border-blue-700',
        warning: 'bg-yellow-500 text-black border-l-4 border-yellow-700'
    };

    notification.className += ` ${colors[type] || colors.info}`;

    notification.innerHTML = `
        <div class="flex items-start space-x-3">
            <i class="fas fa-${getIconByType(type)} mt-1"></i>
            <div class="flex-1">
                <span class="text-sm font-medium">${message}</span>
            </div>
            <button onclick="this.closest('.notification').remove()" class="ml-2 hover:opacity-70 transition-opacity">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);

    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    }, duration);
}

// Guide notification system (positioned differently)
function showGuideNotification(message, type = 'guide', duration = 4000) {
    const existingGuide = document.querySelector('.guide-notification');
    if (existingGuide) {
        existingGuide.remove();
    }

    const guide = document.createElement('div');
    guide.className = `guide-notification fixed top-24 left-4 z-40 p-4 rounded-xl shadow-lg transform -translate-x-full transition-all duration-300 max-w-xs`;

    const colors = {
        guide: 'bg-gradient-to-r from-yellow-400 to-orange-500 text-white border-l-4 border-yellow-600',
        welcome: 'bg-gradient-to-r from-purple-500 to-pink-500 text-white border-l-4 border-purple-700',
        info: 'bg-gradient-to-r from-blue-400 to-cyan-500 text-white border-l-4 border-blue-600'
    };

    guide.className += ` ${colors[type] || colors.guide}`;

    const icons = {
        guide: 'lightbulb',
        welcome: 'hand-peace',
        info: 'info-circle'
    };

    guide.innerHTML = `
        <div class="flex items-start space-x-3">
            <i class="fas fa-${icons[type] || icons.guide} mt-1 text-lg"></i>
            <div class="flex-1">
                <div class="text-xs font-bold opacity-80 mb-1">
                    ${type === 'welcome' ? 'SELAMAT DATANG' : type === 'info' ? 'INFO' : 'PANDUAN'}
                </div>
                <span class="text-sm font-medium leading-relaxed">${message}</span>
            </div>
            <button onclick="this.closest('.guide-notification').remove()" class="ml-2 hover:opacity-70 transition-opacity">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        <div class="mt-2 w-full bg-white bg-opacity-20 rounded-full h-1">
            <div class="guide-progress bg-white rounded-full h-1 transition-all duration-${duration}" style="width: 0%"></div>
        </div>
    `;

    document.body.appendChild(guide);

    setTimeout(() => {
        guide.style.transform = 'translateX(0)';
        // Start progress bar
        const progressBar = guide.querySelector('.guide-progress');
        if (progressBar) {
            setTimeout(() => {
                progressBar.style.width = '100%';
            }, 100);
        }
    }, 100);

    setTimeout(() => {
        if (guide.parentElement) {
            guide.style.transform = 'translateX(-100%)';
            setTimeout(() => {
                guide.remove();
            }, 300);
        }
    }, duration);
}

// Get icon by notification type
function getIconByType(type) {
    const icons = {
        success: 'check-circle',
        error: 'exclamation-circle',
        info: 'info-circle',
        warning: 'exclamation-triangle'
    };
    return icons[type] || icons.info;
}

// Enhanced image modal with guide
function createImageModal(src, alt) {
    const existingModal = document.querySelector('.image-modal');
    if (existingModal) {
        existingModal.remove();
    }

    const modal = document.createElement('div');
    modal.className = 'image-modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 opacity-0 transition-opacity duration-300';

    modal.innerHTML = `
        <div class="relative max-w-4xl max-h-full p-4">
            <img src="${src}" alt="${alt}" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
            <button onclick="this.closest('.image-modal').remove()"
                    class="absolute top-2 right-2 w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-white hover:bg-opacity-30 transition-all">
                <i class="fas fa-times"></i>
            </button>
            <div class="absolute bottom-4 left-4 right-4 text-center">
                <p class="text-white text-lg font-semibold bg-black bg-opacity-50 rounded-lg px-4 py-2 inline-block">
                    ${alt}
                </p>
            </div>
        </div>
    `;

    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.remove();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            modal.remove();
        }
    });

    document.body.appendChild(modal);
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
}

// Smooth scroll to top function
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
    showGuideNotification('⬆️ Kembali ke atas halaman', 'info', 2000);
}

// Enhanced scroll to top button with guide
window.addEventListener('scroll', throttle(function() {
    let scrollTopBtn = document.querySelector('.scroll-top-btn');

    if (window.pageYOffset > 300) {
        if (!scrollTopBtn) {
            scrollTopBtn = document.createElement('button');
            scrollTopBtn.className = 'scroll-top-btn fixed bottom-24 right-6 w-12 h-12 bg-yellow-600 hover:bg-yellow-700 rounded-full flex items-center justify-center text-white shadow-lg z-40 transform scale-0 transition-all duration-300';
            scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
            scrollTopBtn.title = 'Kembali ke atas';

            scrollTopBtn.addEventListener('mouseenter', function() {
                showGuideNotification('⬆️ Klik untuk kembali ke atas halaman', 'guide', 2000);
            });

            scrollTopBtn.onclick = scrollToTop;
            document.body.appendChild(scrollTopBtn);
        }
        setTimeout(() => {
            scrollTopBtn.style.transform = 'scale(1)';
        }, 100);
    } else if (scrollTopBtn) {
        scrollTopBtn.style.transform = 'scale(0)';
        setTimeout(() => {
            if (scrollTopBtn.parentElement) {
                scrollTopBtn.remove();
            }
        }, 300);
    }
}, 100));

// ============ LOADING ANIMATION ============
window.addEventListener('load', function() {
    const loader = document.querySelector('.loader');
    if (loader) {
        loader.style.opacity = '0';
        setTimeout(() => {
            loader.remove();
        }, 500);
    }

    const heroContent = document.querySelector('#home .fade-in');
    if (heroContent) {
        heroContent.classList.add('visible');
    }

    // Show welcome message after page load
    setTimeout(() => {
        showGuideNotification('🎉 Website telah dimuat! Jelajahi semua fitur kami dengan panduan yang tersedia.', 'welcome', 4000);
    }, 1500);
});

// ============ PERFORMANCE OPTIMIZATION ============
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}
</script>

</body>
</html>


