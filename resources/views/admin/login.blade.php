<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Duta Kampus UIN Madura</title>
    <link rel="icon" type="image/png" href="/images/favicon.png?v=3">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style>
        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #FFFFFF;
            color: #1E293B;
        }
        .bg-mesh {
            background-color: #FFFFFF;
        }
        .gold-text-gradient {
            background: linear-gradient(90deg, #D4AF37 0%, #F5D061 50%, #D4AF37 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: goldShineText 3s linear infinite;
        }
        .glass-panel {
            background: #FFFFFF;
            border: 1px solid #F1F5F9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }
        @keyframes goldShineText {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }
        .btn-gold-shine {
            background: linear-gradient(90deg, #D4AF37 0%, #F5D061 50%, #D4AF37 100%);
            background-size: 200% auto;
            color: #2C2416 !important;
            font-weight: 700;
            transition: all 0.35s ease;
            animation: goldShineText 3s linear infinite;
            border: none;
        }
        .btn-gold-shine:hover {
            background-position: right center;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.35);
            transform: translateY(-1px);
        }
        .gold-glow {
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.12);
        }
    </style>
</head>
<body class="bg-mesh min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <div class="w-full max-w-md glass-panel rounded-3xl p-8 shadow-2xl relative gold-glow">
        <!-- Brand logo -->
        <div class="flex flex-col items-center text-center mb-8">
            <!-- Logo -->
            <div class="w-20 h-20 flex items-center justify-center mb-4 overflow-hidden shrink-0">
                <img src="/images/logo_vogma.png" alt="Logo" class="h-full w-full object-contain">
            </div>
            <h2 class="text-xs uppercase tracking-[0.2em] text-[#D4AF37] font-bold leading-none">ADMINISTRATOR</h2>
            <h1 class="text-xl md:text-2xl font-serif font-bold text-slate-800 mt-2">Prince & Princess English Department</h1>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-700 text-xs leading-relaxed font-semibold">
            <ul class="list-disc pl-4 space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-700 text-xs font-semibold">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="email" class="block text-xs uppercase tracking-wider text-[#D4AF37] font-bold mb-2">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email Address" 
                       class="w-full px-4 py-3.5 rounded-xl bg-white border border-[#D4AF37]/30 focus:outline-none focus:border-[#D4AF37] text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
            </div>

            <div>
                <label for="password" class="block text-xs uppercase tracking-wider text-[#D4AF37] font-bold mb-2">Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                           class="w-full pl-4 pr-12 py-3.5 rounded-xl bg-white border border-[#D4AF37]/30 focus:outline-none focus:border-[#D4AF37] text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-700 focus:outline-none">
                        <!-- Eye Icon (Open by default) -->
                        <svg id="eye-icon-open" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Eye Icon (Closed) -->
                        <svg id="eye-icon-closed" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs py-1">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600 hover:text-slate-800 transition-colors font-medium">
                    <input type="checkbox" name="remember" class="rounded bg-white border-[#D4AF37]/30 text-[#D4AF37] focus:ring-0">
                    Ingat Saya
                </label>
                <a href="/" class="text-[#D4AF37] hover:text-[#C5A028] font-bold">Kembali ke Portal</a>
            </div>

            <button type="submit" class="w-full py-4 rounded-xl btn-gold-shine text-[#2C2416] font-bold tracking-wider hover:shadow-lg transition-all text-xs uppercase mt-8 cursor-pointer shadow-md">
                Login
            </button>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const pwdInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-icon-open');
            const eyeClosed = document.getElementById('eye-icon-closed');

            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                pwdInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>

</body>
</html>

