<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Prince & Princess Admin Portal</title>
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
            overflow-x: hidden;
        }

        .font-serif {
            font-family: 'Libre Baskerville', Georgia, 'Times New Roman', serif;
        }

        .bg-mesh {
            background-color: #FFFFFF;
        }

        .glass-panel {
            background: #FFFFFF;
            border: 1px solid #F1F5F9;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
        }

        .gold-border {
            border: 1px solid rgba(212, 175, 55, 0.15);
        }

        @keyframes goldShineText {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        .gold-shine {
            background: linear-gradient(90deg, #D4AF37 0%, #F5D061 50%, #D4AF37 100%);
            background-size: 200% auto;
            animation: goldShineText 3s linear infinite;
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

        .gold-text-gradient {
            background: linear-gradient(90deg, #D4AF37 0%, #F5D061 25%, #FFF5CC 50%, #F5D061 75%, #D4AF37 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: goldShineText 4s linear infinite;
        }

        .sidebar-link-active {
            background: rgba(212, 175, 55, 0.08);
            border-left: 3px solid #D4AF37;
            color: #D4AF37 !important;
            font-weight: 700;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #FFFFFF;
        }
        ::-webkit-scrollbar-thumb {
            background: #E2E8F0;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #CBD5E1;
        }
    </style>
</head>
<body class="bg-mesh min-h-screen">

    <!-- 🌑 Mobile Sidebar Overlay Backdrop -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300 opacity-0" onclick="closeMobileSidebar()"></div>

    <!-- 🧭 Admin Dashboard Sidebar -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 w-64 glass-panel border-r border-[#D4AF37]/20 z-50 flex flex-col justify-between p-6 transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0">
        <div>
            <!-- Close button for mobile -->
            <button onclick="closeMobileSidebar()" class="lg:hidden absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-400 hover:text-slate-700 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Branding Header with Logo -->
            <a href="/" target="_blank" class="flex items-center gap-3 mb-10 pb-4 border-b border-slate-100">
                <img src="/images/logo_vogma.png" alt="Logo" class="w-10 h-10 object-contain shrink-0">
                <div>
                    <span class="block text-sm font-extrabold tracking-[0.08em] text-[#D4AF37] font-serif leading-none">PRINCE & PRINCESS</span>
                    <span class="text-[9px] tracking-[0.12em] uppercase text-slate-500 block mt-1 font-bold">English Department</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="space-y-1">
                <span class="block text-[9px] uppercase tracking-widest text-slate-500 font-bold px-3 mb-2">MENU UTAMA</span>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-600 hover:text-[#D4AF37] hover:bg-[#D4AF37]/5 text-xs uppercase tracking-wider transition-all @if(Request::routeIs('admin.dashboard')) sidebar-link-active @endif">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.candidates') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-600 hover:text-[#D4AF37] hover:bg-[#D4AF37]/5 text-xs uppercase tracking-wider transition-all @if(Request::routeIs('admin.candidates')) sidebar-link-active @endif">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Manajemen Finalis
                </a>

                <a href="{{ route('admin.transactions') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-600 hover:text-[#D4AF37] hover:bg-[#D4AF37]/5 text-xs uppercase tracking-wider transition-all @if(Request::routeIs('admin.transactions')) sidebar-link-active @endif">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Log Transaksi Vote
                </a>

                <span class="block text-[9px] uppercase tracking-widest text-slate-500 font-bold px-3 pt-6 mb-2">PENGATURAN</span>

                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-600 hover:text-[#D4AF37] hover:bg-[#D4AF37]/5 text-xs uppercase tracking-wider transition-all @if(Request::routeIs('admin.users')) sidebar-link-active @endif">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    Pengguna Admin
                </a>
            </nav>
        </div>

        <!-- Logout Form -->
        <div class="pt-4 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-[#D4AF37]/10 border border-[#D4AF37]/30 flex items-center justify-center text-xs font-bold text-[#D4AF37] uppercase shadow-sm">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <div>
                    <span class="block text-xs font-bold text-slate-800 truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                    <span class="text-[9px] text-slate-500 block">Administrator</span>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 rounded-lg border border-rose-300 text-rose-600 hover:bg-rose-50 hover:border-rose-500 hover:shadow-sm transition-all text-[10px] uppercase font-bold tracking-wider">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- 🖥️ Top Header & Main Content Area -->
    <div class="lg:pl-64 min-h-screen flex flex-col">
        <!-- Glassmorphism Navbar Header -->
        <header class="h-16 border-b border-[#D4AF37]/20 glass-panel flex items-center justify-between px-6 md:px-10 z-30 sticky top-0">
            <!-- Mobile Menu Toggle Button (hidden on large screen) -->
            <div class="flex items-center gap-3">
                <button id="hamburger-btn" onclick="openMobileSidebar()" class="lg:hidden text-slate-600 hover:text-slate-900">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h1 class="text-sm md:text-lg font-serif font-bold text-slate-800 tracking-wide">
                    @yield('title')
                </h1>
            </div>

            <div>
                <a href="/" target="_blank" class="px-4 py-2 border border-[#D4AF37]/30 hover:border-[#D4AF37] text-[#D4AF37] font-bold rounded-lg transition-all flex items-center gap-2 text-xs hover:bg-[#D4AF37]/5">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Buka Portal Pengguna
                </a>
            </div>
        </header>

        <!-- 📦 Main Page Container -->
        <main class="flex-1 p-6 md:p-10 max-w-7xl w-full mx-auto">
            @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs font-semibold shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-800 text-xs font-semibold shadow-sm">
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- 📱 Mobile Sidebar Toggle Script -->
    <script>
        function openMobileSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            requestAnimationFrame(() => overlay.classList.replace('opacity-0', 'opacity-100'));
            document.body.style.overflow = 'hidden';
        }
        function closeMobileSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
            document.body.style.overflow = '';
        }
    </script>

</body>
</html>
