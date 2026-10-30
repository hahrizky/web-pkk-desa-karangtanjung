<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TP PKK Desa Karangtanjung')</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- ================= NAVBAR ================= -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Logo & Identitas Desa -->
                <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
                    <!-- Logo PKK -->
                    <img src="{{ asset('images/logo-pkk.png') }}"
                         alt="Logo TP PKK"
                         class="w-11 h-11 object-contain drop-shadow-sm group-hover:scale-105 transition-transform">

                    <!-- Logo Kabupaten Sidoarjo -->
                    <img src="{{ asset('images/logo-kabupaten.png') }}"
                         alt="Logo Kabupaten Sidoarjo"
                         class="w-11 h-11 object-contain drop-shadow-sm group-hover:scale-105 transition-transform">

                    <div class="hidden sm:block pl-2 border-l-2 border-gray-200">
                        <span class="block font-bold text-emerald-800 text-sm md:text-base leading-tight">
                            Tim Penggerak PKK
                        </span>
                        <span class="block text-xs md:text-sm text-gray-500 font-medium">
                            Desa Karangtanjung
                        </span>
                    </div>
                </a>

                <!-- Menu Navigasi Desktop -->
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('beranda') }}" class="px-4 py-2 rounded-lg text-sm {{ request()->routeIs('beranda') ? 'font-semibold text-emerald-800 bg-emerald-100' : 'font-medium text-gray-600 hover:text-emerald-800 hover:bg-emerald-50' }} transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('profil') }}" class="px-4 py-2 rounded-lg text-sm {{ request()->routeIs('profil') ? 'font-semibold text-emerald-800 bg-emerald-100' : 'font-medium text-gray-600 hover:text-emerald-800 hover:bg-emerald-50' }} transition-colors">
                        Profil
                    </a>
                    <a href="{{ route('pokja') }}" class="px-4 py-2 rounded-lg text-sm {{ request()->routeIs('pokja') ? 'font-semibold text-emerald-800 bg-emerald-100' : 'font-medium text-gray-600 hover:text-emerald-800 hover:bg-emerald-50' }} transition-colors">
                        Pokja
                    </a>
                    <a href="#kontak" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-emerald-800 hover:bg-emerald-50 transition-colors">
                        Informasi
                    </a>
                </div>

                <!-- Tombol Menu Mobile -->
                <div class="md:hidden">
                    <button type="button"
                            id="mobile-menu-btn"
                            class="p-2 rounded-lg text-gray-600 hover:text-emerald-800 hover:bg-gray-100 focus:outline-none"
                            aria-label="Toggle menu navigasi">
                        <i class="fa-solid fa-bars text-xl" id="menu-icon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu Navigasi Mobile -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white px-4 pt-2 pb-4 space-y-1 shadow-lg">
            <a href="{{ route('beranda') }}" class="block px-3 py-2 rounded-md text-base {{ request()->routeIs('beranda') ? 'font-semibold text-emerald-800 bg-emerald-50' : 'font-medium text-gray-600 hover:text-emerald-800 hover:bg-gray-50' }}">
                Beranda
            </a>
            <a href="{{ route('profil') }}" class="block px-3 py-2 rounded-md text-base {{ request()->routeIs('profil') ? 'font-semibold text-emerald-800 bg-emerald-50' : 'font-medium text-gray-600 hover:text-emerald-800 hover:bg-gray-50' }}">
                Profil
            </a>
            <a href="{{ route('pokja') }}" class="block px-3 py-2 rounded-md text-base {{ request()->routeIs('pokja') ? 'font-semibold text-emerald-800 bg-emerald-50' : 'font-medium text-gray-600 hover:text-emerald-800 hover:bg-gray-50' }}">
                Pokja
            </a>
            <a href="#kontak" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-emerald-800 hover:bg-gray-50">
                Informasi
            </a>
        </div>
    </nav>

    <!-- ================= MAIN CONTENT ================= -->
    <main>
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    <footer id="kontak" class="bg-emerald-950 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                <!-- Kolom 1: Profil Singkat -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo-pkk.png') }}"
                             alt="Logo PKK"
                             class="w-10 h-10 object-contain drop-shadow">
                        <img src="{{ asset('images/logo-kabupaten.png') }}"
                             alt="Logo Kabupaten Sidoarjo"
                             class="w-10 h-10 object-contain drop-shadow">
                        <div>
                            <h4 class="font-bold text-base leading-snug">TP. PKK Desa Karangtanjung</h4>
                            <p class="text-xs text-emerald-300">Kec. Candi, Kab. Sidoarjo</p>
                        </div>
                    </div>
                    <p class="text-sm text-emerald-100/80 leading-relaxed mb-6">
                        Portal informasi kegiatan, program kerja, dan data statistik Dasawisma TP. PKK Desa Karangtanjung untuk mewujudkan keluarga yang sehat, mandiri, dan sejahtera.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-9 h-9 rounded-full bg-emerald-900/80 hover:bg-emerald-800 flex items-center justify-center text-emerald-200 hover:text-white transition-colors" title="Facebook">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-emerald-900/80 hover:bg-emerald-800 flex items-center justify-center text-emerald-200 hover:text-white transition-colors" title="Instagram">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-emerald-900/80 hover:bg-emerald-800 flex items-center justify-center text-emerald-200 hover:text-white transition-colors" title="YouTube">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Kolom 2: Kelompok Kerja (Pokja) -->
                <div>
                    <h4 class="text-base font-bold text-white mb-4 pb-2 border-b border-emerald-800/80 inline-block">
                        Kelompok Kerja (Pokja)
                    </h4>
                    <ul class="space-y-3 text-sm text-emerald-100/80">
                        <li>
                            <a href="{{ route('beranda') }}#pokja" class="hover:text-emerald-300 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-amber-400"></i>
                                <span><strong>Pokja 1:</strong> Penghayatan & Gotong Royong</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('beranda') }}#pokja" class="hover:text-emerald-300 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-amber-400"></i>
                                <span><strong>Pokja 2:</strong> Pendidikan, Keterampilan & UP2K</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('beranda') }}#pokja" class="hover:text-emerald-300 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-amber-400"></i>
                                <span><strong>Pokja 3:</strong> Pangan, Sandang & Tata Laksana</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('beranda') }}#pokja" class="hover:text-emerald-300 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-amber-400"></i>
                                <span><strong>Pokja 4:</strong> Kesehatan & Lingkungan Hidup</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak Kami -->
                <div>
                    <h4 class="text-base font-bold text-white mb-4 pb-2 border-b border-emerald-800/80 inline-block">
                        Kontak Kami
                    </h4>
                    <ul class="space-y-3 text-sm text-emerald-100/80">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-amber-400 mt-1"></i>
                            <span>Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-amber-400"></i>
                            <span>+62 812-3456-7890 (Sekretariat PKK)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-amber-400"></i>
                            <span>pkk.desakarangtanjung@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-clock text-amber-400"></i>
                            <span>Jam Layanan: Senin - Jumat (08.00 - 15.00 WIB)</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Copyright -->
            <div class="mt-12 pt-6 border-t border-emerald-900/60 flex flex-col sm:flex-row items-center justify-between text-xs text-emerald-300/70 gap-3">
                <p>&copy; {{ date('Y') }} Tim Penggerak PKK Desa Karangtanjung. Semua Hak Dilindungi.</p>
                <p>Website Resmi TP. PKK Desa Karangtanjung — Kec. Candi, Sidoarjo</p>
            </div>
        </div>
    </footer>

    <!-- Tombol Scroll to Top -->
    <button id="btn-back-to-top"
            class="hidden fixed bottom-6 right-6 z-40 w-11 h-11 rounded-full bg-emerald-700 hover:bg-emerald-600 text-white shadow-lg items-center justify-center transition-all duration-300 focus:outline-none"
            aria-label="Kembali ke atas">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <!-- JavaScript Sederhana -->
    <script>
        // Toggle Menu Navigasi Mobile
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        menuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            if (mobileMenu.classList.contains('hidden')) {
                menuIcon.classList.remove('fa-xmark');
                menuIcon.classList.add('fa-bars');
            } else {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-xmark');
            }
        });

        // Tutup menu mobile ketika link diklik
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('fa-xmark');
                menuIcon.classList.add('fa-bars');
            });
        });

        // Tombol Back to Top
        const backToTopBtn = document.getElementById('btn-back-to-top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('hidden');
                backToTopBtn.classList.add('flex');
            } else {
                backToTopBtn.classList.add('hidden');
                backToTopBtn.classList.remove('flex');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>

