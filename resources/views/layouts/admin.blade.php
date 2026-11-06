<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — CMS PKK Karangtanjung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link.active { background-color: rgba(255,255,255,0.15); font-weight: 600; }
        .sidebar-link:hover { background-color: rgba(255,255,255,0.1); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

{{-- Mobile overlay --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

{{-- SIDEBAR --}}
<aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-[#075B3C] text-white z-40 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    {{-- Logo / Brand --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10">
        <img src="{{ asset('images/logo-pkk.png') }}" alt="PKK" class="w-10 h-10 object-contain">
        <div>
            <p class="font-bold text-sm leading-tight">PKK Karangtanjung</p>
            <p class="text-xs text-white/60 leading-tight">Panel Administrator</p>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <p class="text-xs text-white/40 font-semibold uppercase tracking-widest px-3 mb-2">Menu Utama</p>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house-chimney w-5 text-center"></i>
            <span>Dashboard</span>
        </a>

        <p class="text-xs text-white/40 font-semibold uppercase tracking-widest px-3 mt-4 mb-2">Konten</p>

        <a href="{{ route('admin.berita.index') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <i class="fa-solid fa-newspaper w-5 text-center"></i>
            <span>Berita</span>
        </a>

        <a href="{{ route('admin.agenda.index') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-days w-5 text-center"></i>
            <span>Agenda Kegiatan</span>
        </a>

        <a href="{{ route('admin.pokja.index') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.pokja.*') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group w-5 text-center"></i>
            <span>Pokja</span>
        </a>

        <a href="{{ route('admin.struktur.index') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.struktur.*') ? 'active' : '' }}">
            <i class="fa-solid fa-sitemap w-5 text-center"></i>
            <span>Struktur Organisasi</span>
        </a>

        <a href="{{ route('admin.statistik.index') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.statistik.*') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie w-5 text-center"></i>
            <span>Statistik Dasawisma</span>
        </a>

        <p class="text-xs text-white/40 font-semibold uppercase tracking-widest px-3 mt-4 mb-2">Sistem</p>

        <a href="{{ route('admin.profil') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.profil') ? 'active' : '' }}">
            <i class="fa-solid fa-id-card w-5 text-center"></i>
            <span>Profil Desa</span>
        </a>

        <a href="{{ url('/') }}" target="_blank"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all">
            <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center"></i>
            <span>Lihat Website</span>
        </a>
    </nav>

    {{-- User / Logout --}}
    <div class="border-t border-white/10 px-4 py-4">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-user text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold truncate">{{ session('admin_name', 'Administrator') }}</p>
                <p class="text-xs text-white/50 truncate">Admin PKK</p>
            </div>
            <a href="{{ route('admin.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="text-white/60 hover:text-white transition-colors" title="Keluar">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">@csrf</form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<div class="lg:ml-64 min-h-screen flex flex-col">

    {{-- TOP BAR --}}
    <header class="bg-white border-b border-gray-200 sticky top-0 z-20">
        <div class="flex items-center justify-between px-4 md:px-6 h-14">
            {{-- Hamburger (mobile) --}}
            <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-gray-700 transition-colors">
                <i class="fa-solid fa-bars text-lg"></i>
            </button>

            {{-- Page title --}}
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-400 hidden md:inline">{{ config('app.name') }} /</span>
                <span class="text-sm font-semibold text-gray-700">@yield('page-title', 'Dashboard')</span>
            </div>

            {{-- Right side --}}
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-500 hidden sm:inline">
                    <i class="fa-regular fa-clock mr-1"></i>
                    {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                </span>
                <div class="w-8 h-8 bg-[#075B3C] rounded-full flex items-center justify-center text-white text-xs font-bold">
                    A
                </div>
            </div>
        </div>
    </header>

    {{-- Page Content --}}
    <main class="flex-1 p-4 md:p-6">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm" id="flash-success">
                <i class="fa-solid fa-circle-check text-green-500"></i>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-green-400 hover:text-green-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-xmark text-red-500"></i>
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-200 bg-white px-6 py-3 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} CMS TP. PKK Desa Karangtanjung &mdash; Panel Administrator
    </footer>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    // Auto hide flash after 4s
    setTimeout(() => {
        const flash = document.getElementById('flash-success');
        if (flash) flash.remove();
    }, 4000);
</script>
@stack('scripts')
</body>
</html>

