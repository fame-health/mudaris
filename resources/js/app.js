import './bootstrap';

    document.addEventListener('DOMContentLoaded', function() {

    // ============ GUIDE NOTIFICATION SYSTEM ============
    let guideNotificationCount = 0;
    let isFirstVisit = !sessionStorage.getItem('hasVisited');
    let hasShownScrollGuide = false;
    let hasShownMenuGuide = false;
    let hasShownFormGuide = false;

    // Initialize user guide
    setTimeout(() => {
        if (isFirstVisit) {
            showGuideNotification('👋 Selamat datang di Mudaris Mandiri Wisata! Scroll ke bawah untuk melihat paket umroh terbaik kami.', 'welcome', 3000);
            sessionStorage.setItem('hasVisited', 'true');
            isFirstVisit = false;
        }
    }, 1000);

    // Track shown section guides
    const shownSectionGuides = JSON.parse(sessionStorage.getItem('shownSectionGuides') || '{}');

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

    // ============ PAKET UMROH BUTTON HANDLERS ============
    const paketBtns = Array.from(document.querySelectorAll('button')).filter(btn =>
        btn.textContent.includes('Pilih Paket')
    );

    paketBtns.forEach((btn, index) => {
        // Add hover guide
        btn.addEventListener('mouseenter', function() {
            showGuideNotification('👆 Klik untuk memilih paket dan mendapat konsultasi gratis!', 'guide', 2000);
        });

        btn.addEventListener('click', function() {
            const paketTypes = ['Reguler', 'VIP', 'Keluarga'];
            const paketType = paketTypes[index] || 'Umroh';

            showNotification(`✅ Anda memilih Paket ${paketType}. Tim kami akan menghubungi Anda segera!`, 'success');
            showGuideNotification('📝 Sekarang lengkapi form kontak di bawah untuk mendapat informasi lebih lanjut!', 'guide', 4000);

            // Scroll to contact form
            setTimeout(() => {
                document.querySelector('#kontak')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 1000);
        });
    });

    // ============ CONTACT FORM HANDLING ============
    const contactForm = document.querySelector('form');

    if (contactForm) {
        // Show form guide when user focuses on first input
        const firstInput = contactForm.querySelector('input');
        if (firstInput) {
            firstInput.addEventListener('focus', function() {
                if (!hasShownFormGuide) {
                    showGuideNotification('📝 Lengkapi semua field yang diperlukan untuk mendapat respon cepat dari tim kami!', 'guide', 4000);
                    hasShownFormGuide = true;
                }
            });
        }

        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const name = this.querySelector('input[placeholder*="nama"]')?.value;
            const email = this.querySelector('input[type="email"]')?.value;
            const phone = this.querySelector('input[type="tel"]')?.value;
            const paket = this.querySelector('select')?.value;
            const message = this.querySelector('textarea')?.value;

            // Basic validation
            if (!name || !email || !phone) {
                showNotification('❌ Mohon lengkapi data yang diperlukan!', 'error');
                showGuideNotification('💡 Tip: Nama, email, dan nomor HP wajib diisi untuk proses yang lebih cepat.', 'guide', 3000);
                return;
            }

            if (!isValidEmail(email)) {
                showNotification('❌ Format email tidak valid!', 'error');
                showGuideNotification('📧 Contoh email yang benar: nama@email.com', 'guide', 3000);
                return;
            }

            // Simulate form submission
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn?.innerHTML;

            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                submitBtn.disabled = true;
            }

            showGuideNotification('⏳ Sedang mengirim pesan Anda...', 'info', 2000);

            setTimeout(() => {
                showNotification('✅ Pesan berhasil dikirim! Tim kami akan menghubungi Anda segera.', 'success');
                showGuideNotification('🎉 Terima kasih! Kami akan menghubungi Anda dalam 1x24 jam. Jangan lupa cek WhatsApp!', 'welcome', 5000);
                this.reset();
                if (submitBtn && originalText) {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }, 2000);
        });
    }

    // ============ GALLERY IMAGE MODAL ============
    const galleryImages = document.querySelectorAll('#galeri img');

    galleryImages.forEach((img, index) => {
        img.addEventListener('mouseenter', function() {
            showGuideNotification('🖼️ Klik gambar untuk melihat dalam ukuran penuh!', 'guide', 2000);
        });

        img.addEventListener('click', function() {
            createImageModal(this.src, this.alt);
            showGuideNotification('🔍 Gunakan tombol ESC atau klik di luar gambar untuk menutup.', 'info', 3000);
        });

        img.style.cursor = 'pointer';
    });

    // ============ FLOATING WHATSAPP BUTTON ============
    const whatsappBtn = document.querySelector('.floating-animation a[href*="wa.me"]');

    if (whatsappBtn) {
        whatsappBtn.addEventListener('mouseenter', function() {
            showGuideNotification('💬 Klik untuk chat langsung via WhatsApp!', 'guide', 2000);
        });

        whatsappBtn.addEventListener('click', function(e) {
            this.style.transform = 'scale(0.95)';
            showGuideNotification('📱 Membuka WhatsApp... Siap untuk konsultasi gratis!', 'success', 2000);
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }

    // ============ HERO BUTTONS FUNCTIONALITY ============
    const heroButtons = document.querySelectorAll('#home button');

    heroButtons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            if (this.textContent.includes('Paket')) {
                showGuideNotification('📦 Lihat berbagai paket umroh yang tersedia!', 'guide', 2000);
            } else if (this.textContent.includes('Hubungi')) {
                showGuideNotification('📞 Hubungi kami untuk konsultasi gratis!', 'guide', 2000);
            }
        });

        btn.addEventListener('click', function() {
            if (this.textContent.includes('Paket')) {
                showGuideNotification('🎯 Menuju ke bagian paket umroh...', 'info', 2000);
                document.querySelector('#paket')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            } else if (this.textContent.includes('Hubungi')) {
                showGuideNotification('📝 Menuju ke form kontak...', 'info', 2000);
                document.querySelector('#kontak')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ============ KONSULTASI GRATIS BUTTONS ============
    const konsultasiButtons = Array.from(document.querySelectorAll('button')).filter(btn =>
        btn.textContent.includes('Konsultasi Gratis')
    );

    konsultasiButtons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            showGuideNotification('💡 Konsultasi gratis dengan expert umroh kami!', 'guide', 2000);
        });

        btn.addEventListener('click', function() {
            showGuideNotification('📞 Menuju form konsultasi gratis...', 'info', 2000);
            document.querySelector('#kontak')?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // ============ FORM INPUT ENHANCEMENTS ============
    const formInputs = document.querySelectorAll('input, textarea, select');

    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement?.classList.add('focused');

            // Show specific input guides
            const placeholder = this.placeholder?.toLowerCase() || this.name?.toLowerCase() || '';
            if (placeholder.includes('nama')) {
                showGuideNotification('👤 Masukkan nama lengkap Anda', 'guide', 2000);
            } else if (placeholder.includes('email')) {
                showGuideNotification('📧 Gunakan email aktif untuk komunikasi', 'guide', 2000);
            } else if (placeholder.includes('phone') || placeholder.includes('hp')) {
                showGuideNotification('📱 Nomor HP untuk WhatsApp lebih diutamakan', 'guide', 2000);
            } else if (this.tagName.toLowerCase() === 'select') {
                showGuideNotification('📋 Pilih paket yang Anda minati', 'guide', 2000);
            } else if (this.tagName.toLowerCase() === 'textarea') {
                showGuideNotification('💬 Ceritakan kebutuhan umroh Anda secara detail', 'guide', 3000);
            }
        });

        input.addEventListener('blur', function() {
            this.parentElement?.classList.remove('focused');
        });

        if (input.value) {
            input.parentElement?.classList.add('has-value');
        }

        input.addEventListener('input', function() {
            if (this.value) {
                this.parentElement?.classList.add('has-value');
            } else {
                this.parentElement?.classList.remove('has-value');
            }
        });
    });

    // ============ SECTION-SPECIFIC GUIDES ============
    function showSectionGuide(sectionId) {
        const guides = {
            'home': '🏠 Selamat datang! Scroll ke bawah untuk melihat layanan kami.',
            'tentang': '🏢 Pelajari lebih lanjut tentang pengalaman dan komitmen kami.',
            'paket': '📦 Pilih paket umroh yang sesuai dengan kebutuhan Anda.',
            'galeri': '🖼️ Lihat dokumentasi perjalanan umroh bersama kami.',
            'testimonial': '⭐ Baca pengalaman jamaah yang telah berangkat bersama kami.',
            'kontak': '📞 Hubungi kami untuk konsultasi gratis dan informasi lebih lanjut.'
        };

        if (guides[sectionId] && !shownSectionGuides[sectionId]) {
            setTimeout(() => {
                showGuideNotification(guides[sectionId], 'guide', 3000);
                shownSectionGuides[sectionId] = true;
                sessionStorage.setItem('shownSectionGuides', JSON.stringify(shownSectionGuides));
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

//kontak-konsultasi
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitButton = document.getElementById('submitButton');
    const buttonText = document.getElementById('buttonText');
    const loadingText = document.getElementById('loadingText');
    const alertMessage = document.getElementById('alert-message');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Disable button dan tampilkan loading
        submitButton.disabled = true;
        buttonText.classList.add('hidden');
        loadingText.classList.remove('hidden');

        // Hide previous alerts
        alertMessage.classList.add('hidden');

        try {
            const formData = new FormData(form);

            const response = await fetch('/contact', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (result.success) {
                // Tampilkan pesan sukses
                showAlert('success', result.message);


            } else {
                showAlert('error', result.message);
            }

        } catch (error) {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        } finally {
            // Re-enable button
            submitButton.disabled = false;
            buttonText.classList.remove('hidden');
            loadingText.classList.add('hidden');
        }
    });

    function showAlert(type, message) {
        alertMessage.className = `mb-4 p-4 rounded-xl ${type === 'success' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'}`;
        alertMessage.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                ${message}
            </div>
        `;
        alertMessage.classList.remove('hidden');

        // Scroll ke alert
        alertMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

//testimoni
document.addEventListener('DOMContentLoaded', function() {
    loadTestimonials();
});

function loadTestimonials() {
    fetch('/api/testimonials/active')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('testimonials-container');
            const staticTestimonials = document.getElementById('static-testimonials');

            if (data.length > 0) {
                container.innerHTML = '';

                const gradientColors = [
                    'from-yellow-50 to-orange-50',
                    'from-green-50 to-blue-50',
                    'from-purple-50 to-pink-50',
                    'from-blue-50 to-indigo-50',
                    'from-pink-50 to-rose-50',
                    'from-indigo-50 to-purple-50'
                ];

                const avatarColors = [
                    'from-yellow-400 to-orange-400',
                    'from-green-400 to-blue-400',
                    'from-purple-400 to-pink-400',
                    'from-blue-400 to-indigo-400',
                    'from-pink-400 to-rose-400',
                    'from-indigo-400 to-purple-400'
                ];

                data.forEach((testimonial, index) => {
                    const colorIndex = index % gradientColors.length;
                    const testimonialHtml = `
                        <div class="fade-in">
                            <div class="bg-gradient-to-br ${gradientColors[colorIndex]} p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br ${avatarColors[colorIndex]} rounded-full flex items-center justify-center overflow-hidden">
                                        ${testimonial.avatar_url.includes('ui-avatars.com') ?
                                            `<i class="fas fa-user text-white"></i>` :
                                            `<img src="${testimonial.avatar_url}" alt="${testimonial.name}" class="w-full h-full object-cover">`
                                        }
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-semibold text-gray-800">${testimonial.name}</h4>
                                        <p class="text-sm text-gray-600">${testimonial.location}</p>
                                    </div>
                                </div>
                                <div class="flex mb-4">
                                    ${generateStars(testimonial.rating)}
                                </div>
                                <p class="text-gray-700 italic">"${testimonial.message}"</p>
                            </div>
                        </div>
                    `;
                    container.innerHTML += testimonialHtml;
                });
            } else {
                container.classList.add('hidden');
                staticTestimonials.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error loading testimonials:', error);
            const container = document.getElementById('testimonials-container');
            const staticTestimonials = document.getElementById('static-testimonials');
            container.classList.add('hidden');
            staticTestimonials.classList.remove('hidden');
        });
}

function generateStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        stars += i <= rating ?
            '<i class="fas fa-star text-yellow-400"></i>' :
            '<i class="far fa-star text-yellow-400"></i>';
    }
    return stars;
}



//mediasosial
// Function untuk load YouTube video
function loadYouTubeVideo(element, videoId) {
    const iframe = document.createElement('iframe');
    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    iframe.className = 'w-full h-full';
    iframe.frameBorder = '0';
    iframe.allowFullscreen = true;
    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';

    element.innerHTML = '';
    element.appendChild(iframe);
}

// Function untuk load TikTok video
function loadTikTokVideo(element, videoId) {
    const iframe = document.createElement('iframe');
    iframe.src = `https://www.tiktok.com/embed/${videoId}`;
    iframe.className = 'w-full h-full';
    iframe.frameBorder = '0';
    iframe.allowFullscreen = true;
    iframe.allow = 'autoplay; encrypted-media';

    element.innerHTML = '';
    element.appendChild(iframe);
}

// Function untuk load Instagram post
function loadInstagramPost(element, postId) {
    const iframe = document.createElement('iframe');
    iframe.src = `https://www.instagram.com/p/${postId}/embed`;
    iframe.className = 'w-full h-full';
    iframe.frameBorder = '0';
    iframe.scrolling = 'no';
    iframe.allowTransparency = true;

    element.innerHTML = '';
    element.appendChild(iframe);
}

//paket-umroh

function sendWhatsApp(packageName, price, duration, hotelRating, category) {
    // Nomor WhatsApp tujuan
    const phoneNumber = '6285211451111'; // Format internasional Indonesia

    // Template pesan yang akan dikirim
    const message = `🕌 *INQUIRY PAKET UMROH* 🕌

Assalamualaikum, saya tertarik dengan:

📦 *Paket*: ${packageName}
🏷️ *Kategori*: ${category}
💰 *Harga*: ${price}
📅 *Durasi*: ${duration} hari
🏨 *Hotel Rating*: ${hotelRating}⭐

Mohon informasi lebih lanjut, terima kasih.`;

    // Encode pesan untuk URL
    const encodedMessage = encodeURIComponent(message);

    // Buat URL WhatsApp
    const url = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

    // Arahkan pengguna ke WhatsApp
    window.open(url, '_blank');
}
