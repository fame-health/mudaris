<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error | Mudaris Mandiri Wisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'fade-in': 'fadeIn 1s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'glow': 'glow 2s ease-in-out infinite alternate'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(50px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
                            '100%': { boxShadow: '0 0 40px rgba(59, 130, 246, 0.8)' }
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 overflow-hidden relative">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Animated Circles -->
        <div class="absolute top-10 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-20 left-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: 4s;"></div>
        
        <!-- Geometric Shapes -->
        <div class="absolute top-20 right-20 transform rotate-45">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 opacity-20 animate-bounce-slow"></div>
        </div>
        <div class="absolute bottom-32 left-20 transform rotate-12">
            <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-red-500 opacity-20 animate-pulse-slow"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-2xl mx-auto">
            <!-- Logo/Brand -->
            <div class="mb-8 animate-fade-in">
                <div class="inline-flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-kaaba text-white text-sm"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">MMW</span>
                </div>
            </div>

            <!-- Error Number -->
            <div class="mb-8 animate-slide-up" style="animation-delay: 0.2s;">
                <div class="relative inline-block">
                    <h1 class="text-9xl md:text-[12rem] font-black text-transparent bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 bg-clip-text leading-none">
                        500
                    </h1>
                    <div class="absolute inset-0 text-9xl md:text-[12rem] font-black text-blue-600 opacity-10 blur-sm">
                        500
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="mb-8 animate-slide-up" style="animation-delay: 0.4s;">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Oops! Server Sedang Bermasalah
                </h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Mohon maaf, terjadi kesalahan pada server kami.<br>
                    Tim teknis sedang bekerja keras untuk memperbaikinya.
                </p>
            </div>



            <!-- Contact Info -->
            <div class="mt-12 p-6 bg-white/70 backdrop-blur-lg rounded-2xl shadow-lg border border-white/20 animate-slide-up" style="animation-delay: 1s;">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    <i class="fas fa-headset text-blue-600 mr-2"></i>
                    Butuh Bantuan?
                </h3>
                <p class="text-gray-600 mb-4">
                    Jika masalah terus berlanjut, silakan hubungi tim support kami
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:+6285211451111" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                        <i class="fas fa-phone mr-2"></i>
                        Hubungi Kami
                    </a>
                    <a href="https://wa.me/6285211451111" onclick="return false;" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-center text-gray-500 text-sm animate-fade-in" style="animation-delay: 1.2s;">
        <p>&copy; 2012 Mudaris Mandiri Wisata</p>
    </div>

    