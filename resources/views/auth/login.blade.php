<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIAKAD Login - Sistem Informasi Akademik">
    <meta name="theme-color" content="#F5F6FA">
    <title>Login | SIAKAD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-[#F0F0FF] via-[#F5F6FA] to-[#EEF2FF] min-h-screen flex items-center justify-center p-6 font-sans text-gray-900">
    <div class="w-full max-w-[400px] bg-white rounded-[20px] p-10 shadow-[0_4px_24px_rgba(0,0,0,0.06),_0_1px_3px_rgba(0,0,0,0.04)] border border-gray-200">
        <div class="text-center mb-8">
            <div class="w-[52px] h-[52px] bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] rounded-[14px] inline-flex items-center justify-center mb-4 shadow-[0_4px_12px_rgba(99,102,241,0.2)]">
                <i class="ti ti-school" style="font-size:22px; color:#fff" aria-hidden="true"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-900 mb-1">SIAKAD</h1>
            <p class="text-[0.82rem] text-gray-500">Sistem Informasi Akademik</p>
        </div>

        @if (session('status'))
            <div class="bg-emerald-50 border border-emerald-200 rounded-[10px] px-3 py-2.5 text-emerald-600 text-[0.82rem] mb-5 flex items-center gap-2">
                <i class="ti ti-circle-check" style="font-size:15px" aria-hidden="true"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block text-[0.78rem] font-semibold text-gray-500 mb-2 tracking-wide">Email</label>
                <div class="relative mb-4">
                    <i class="ti ti-mail absolute left-3.5 top-1/2 -translate-y-1/2 text-[15px] text-gray-400 pointer-events-none" aria-hidden="true"></i>
                    <input id="email" type="email" name="email"
                        class="w-full py-[0.7rem] pl-10 pr-[0.85rem] bg-[#FAFBFC] border rounded-[10px] text-[0.875rem] text-gray-900 outline-none transition-all duration-200 focus:bg-white focus:ring-3 placeholder-gray-400 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/10 @else border-gray-200 focus:border-[#6366f1] focus:ring-[#6366f1]/10 @enderror" value="{{ old('email') }}"
                        placeholder="email@domain.com" required autofocus autocomplete="username">
                </div>
                @error('email')
                    <div class="text-[0.75rem] text-red-500 mt-1.5">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-[0.78rem] font-semibold text-gray-500 tracking-wide mb-0">Password</label>
                </div>
                <div class="relative mb-4">
                    <i class="ti ti-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-[15px] text-gray-400 pointer-events-none" aria-hidden="true"></i>
                    <input id="password" type="password" name="password"
                        class="w-full py-[0.7rem] pl-10 pr-10 bg-[#FAFBFC] border rounded-[10px] text-[0.875rem] text-gray-900 outline-none transition-all duration-200 focus:bg-white focus:ring-3 placeholder-gray-400 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/10 @else border-gray-200 focus:border-[#6366f1] focus:ring-[#6366f1]/10 @enderror"
                        placeholder="••••••••" required autocomplete="current-password">
                    <button type="button" class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-transparent border-none cursor-pointer p-1 text-gray-400 flex items-center transition-colors duration-150 hover:text-gray-500" id="pw-toggle" aria-label="Tampilkan password">
                        <i class="ti ti-eye" style="font-size:16px" id="pw-toggle-icon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-[0.75rem] text-red-500 mt-1.5">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full py-3 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] border-none rounded-[10px] text-white text-[0.875rem] font-semibold cursor-pointer flex items-center justify-center gap-2 transition-all duration-200 shadow-[0_2px_8px_rgba(99,102,241,0.2)] hover:opacity-90 hover:-translate-y-[1px] hover:shadow-[0_4px_16px_rgba(99,102,241,0.25)] active:scale-[0.995] mt-2">
                <i class="ti ti-arrow-right" style="font-size:16px" aria-hidden="true"></i>
                Masuk
            </button>
        </form>
    </div>

    <script>
        const toggle = document.getElementById('pw-toggle');
        const input = document.getElementById('password');
        const icon = document.getElementById('pw-toggle-icon');

        toggle.addEventListener('click', () => {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            icon.className = isPassword ? 'ti ti-eye-off' : 'ti ti-eye';
            toggle.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
        });
    </script>
</body>

</html>
