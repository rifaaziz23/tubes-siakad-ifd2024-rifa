<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIAKAD Login - Sistem Informasi Akademik">
    <title>Login | SIAKAD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-[#0d0d0f] min-h-screen flex items-center justify-center p-6 text-[#e4e4e7]">
    <div class="w-full max-w-[380px]">

        <div class="text-center mb-10">
            <div class="w-12 h-12 bg-[#18181b] border border-white/10 rounded-xl inline-flex items-center justify-center mb-5">
                <i class="ti ti-school text-[22px] text-purple-400" aria-hidden="true"></i>
            </div>
            <h1 class="text-[20px] font-medium text-zinc-100 mb-1">SIAKAD</h1>
            <p class="text-[13px] text-zinc-500">Sistem Informasi Akademik</p>
        </div>

        @if (session('status'))
            <div class="bg-teal-400/8 border border-teal-400/20 rounded-lg p-2.5 px-3 text-teal-400 text-[13px] mb-5 flex items-center gap-2">
                <i class="ti ti-circle-check text-[15px]" aria-hidden="true"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex flex-col gap-3.5 mb-5">
                <div class="block">
                    <label for="email" class="block text-[12px] text-zinc-500 mb-1.5 tracking-wider">Email</label>
                    <div class="relative">
                        <i class="ti ti-mail absolute left-3 top-1/2 -translate-y-1/2 text-[15px] text-zinc-600 pointer-events-none" aria-hidden="true"></i>
                        <input id="email" type="email" name="email" 
                            class="w-full pl-9 pr-3 py-2.5 bg-[#18181b] border rounded-lg text-zinc-300 text-[14px] outline-none transition-all placeholder-[#3f3f46] @error('email') border-red-500/50 focus:border-red-500 focus:ring-3 focus:ring-red-500/8 @else border-white/8 focus:border-purple-500/50 focus:ring-3 focus:ring-purple-500/8 @enderror"
                            value="{{ old('email') }}" placeholder="email@domain.com" required autofocus
                            autocomplete="username">
                    </div>
                    @error('email')
                        <div class="text-[12px] text-red-400 mt-1.5">{{ $message }}</div>
                    @enderror
                </div>

                <div class="block">
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="text-[12px] text-zinc-500 tracking-wider mb-0">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[12px] text-purple-400 no-underline transition-colors hover:text-purple-300">Lupa password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <i class="ti ti-lock absolute left-3 top-1/2 -translate-y-1/2 text-[15px] text-zinc-600 pointer-events-none" aria-hidden="true"></i>
                        <input id="password" type="password" name="password" 
                            class="w-full pl-9 pr-9 py-2.5 bg-[#18181b] border rounded-lg text-zinc-300 text-[14px] outline-none transition-all placeholder-[#3f3f46] @error('password') border-red-500/50 focus:border-red-500 focus:ring-3 focus:ring-red-500/8 @else border-white/8 focus:border-purple-500/50 focus:ring-3 focus:ring-purple-500/8 @enderror"
                            placeholder="••••••••" required autocomplete="current-password">
                        <button type="button" class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-none border-none cursor-pointer p-1 text-zinc-600 flex items-center transition-colors hover:text-zinc-400" id="pw-toggle" aria-label="Tampilkan password">
                            <i class="ti ti-eye text-[15px]" id="pw-toggle-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-[12px] text-red-400 mt-1.5">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="w-full p-2.5 bg-purple-400 border-none rounded-lg text-purple-950 text-[14px] font-medium cursor-pointer flex items-center justify-center gap-2 transition-all active:scale-[0.99] hover:bg-purple-300">
                <i class="ti ti-arrow-right text-[16px]" aria-hidden="true"></i>
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
