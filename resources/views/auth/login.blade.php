<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — PKK Karangtanjung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#075B3C] via-[#0a7050] to-[#14633F] flex items-center justify-center p-4">

    <div class="w-full max-w-sm">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-xl mb-4">
                <img src="{{ asset('images/logo-pkk.png') }}" alt="PKK" class="w-14 h-14 object-contain">
            </div>
            <h1 class="text-2xl font-extrabold text-white">TP. PKK Karangtanjung</h1>
            <p class="text-green-200 text-sm mt-1">Panel Manajemen Konten</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-1">Selamat Datang</h2>
            <p class="text-sm text-gray-500 mb-6">Silakan masuk untuk melanjutkan</p>

            @if(session('error'))
                <div class="mb-5 flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Username</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fa-solid fa-user text-sm"></i>
                        </span>
                        <input type="text" name="username" value="{{ old('username') }}"
                               class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/30 focus:border-[#075B3C] transition-all"
                               placeholder="Masukkan username" required autofocus>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" id="password-input"
                               class="w-full pl-9 pr-10 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/30 focus:border-[#075B3C] transition-all"
                               placeholder="Masukkan password" required>
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fa-regular fa-eye text-sm" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-[#075B3C] hover:bg-[#055030] text-white font-semibold py-2.5 rounded-xl transition-all duration-200 active:scale-95 mt-2">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>
                    Masuk
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-400">
                    Default: <span class="font-mono font-semibold text-gray-600">admin</span> / <span class="font-mono font-semibold text-gray-600">pkk2024</span>
                </p>
            </div>
        </div>

        <p class="text-center text-xs text-green-200 mt-6">
            &copy; {{ date('Y') }} TP. PKK Desa Karangtanjung
        </p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password-input');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>

