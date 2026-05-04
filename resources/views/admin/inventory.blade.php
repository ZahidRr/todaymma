<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Gudang | Admin ConnectMe</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 900: '#1e3a8a' } },
                    boxShadow: { 'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.03)' }
                }
            }
        }
    </script>
    <style>
        body { background-color: #F4F7F9; } 
        .dark body { background-color: #0f172a; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .animate-fade-out { opacity: 0; transform: translateY(-10px); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        #nav-indicator { left: 0; will-change: transform, width; }
        
        /* Animasi Tab */
        .tab-content { display: none; animation: fadeIn 0.4s ease; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- NAVBAR -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200/80 dark:border-slate-800 shadow-sm transition-colors duration-300">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg">+</div>
                <h1 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <!-- Menu Pil -->
            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-50 dark:bg-slate-800 p-1 rounded-full border border-slate-200/60 dark:border-slate-700 transition-colors">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-white rounded-full shadow-md z-0 transition-all duration-300"></div>
                
                <a href="{{ route('admin.dashboard') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all duration-300">Dashboard</a>
                <a href="{{ route('admin.verifikasi') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all duration-300">Verifikasi Tagihan</a>
                <a href="{{ route('admin.clients') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all duration-300">Database Client</a>
                <a href="{{ route('admin.invoices') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all duration-300">Invoice</a>
                
                <!-- MENU INVENTORY ACTIVE -->
                <a href="{{ route('admin.inventory') }}" class="nav-link active-link relative z-10 px-6 py-2 text-sm font-bold text-white dark:text-slate-900 transition-colors duration-300">Inventory</a>
            </div>
        </div>

        <div class="flex items-center gap-5">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-50 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="h-8 w-px bg-slate-200 dark:bg-slate-700"></div>
            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3">
                @csrf
                <div class="w-10 h-10 rounded-full bg-brand-50 dark:bg-brand-900 text-brand-600 dark:text-brand-400 font-extrabold flex items-center justify-center uppercase text-sm">
                    {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                </div>
                <div class="hidden md:block text-left mr-2">
                    <p class="text-sm font-extrabold text-slate-900 dark:text-white leading-tight">{{ explode(' ', Auth::user()->name ?? 'Admin')[0] }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-tight">Administrator</p>
                </div>
                <button type="submit" class="text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main id="main-content" class="flex-1 p-8 max-w-[1400px] mx-auto w-full animate-fade-in opacity-0">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-[32px] font-black text-slate-900 dark:text-white tracking-tight">Pantau Inventory 📦</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1.5 font-medium">Monitoring stok router dan material dari tim Teknisi (Read-Only).</p>
            </div>
        </div>

        <!-- TAB SWITCHER -->
        <div class="flex gap-2 mb-6 p-1 bg-white dark:bg-slate-900 w-max rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
            <button onclick="switchTab('tab-perangkat')" id="btn-tab-perangkat" class="tab-btn px-6 py-2.5 rounded-lg text-sm font-bold bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 shadow-sm transition-all">
                Daftar Router (SN)
            </button>
            <button onclick="switchTab('tab-material')" id="btn-tab-material" class="tab-btn px-6 py-2.5 rounded-lg text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white transition-all">
                Material Kabel & Alat
            </button>
        </div>

        <!-- TAB 1: PERANGKAT / ROUTER -->
        <div id="tab-perangkat" class="tab-content active">
            <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-soft border border-slate-100 dark:border-slate-800 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50 dark:bg-slate-800/20 text-slate-400 text-[10px] tracking-widest uppercase font-extrabold border-b border-slate-100 dark:border-slate-800">
                        <tr>
                            <th class="p-6 pl-8">Model Perangkat</th>
                            <th class="p-6">Serial Number (SN)</th>
                            <th class="p-6 text-right pr-8">Status Barang</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800 text-sm">
                        @forelse($perangkat ?? [] as $item)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-6 pl-8 font-extrabold text-slate-900 dark:text-white">{{ $item->item_name }}</td>
                            <td class="p-6 font-mono text-brand-600 dark:text-brand-400 font-bold tracking-wide">
                                <span class="bg-brand-50 dark:bg-brand-500/10 px-3 py-1 rounded-md">{{ $item->serial_number ?? '-' }}</span>
                            </td>
                            <td class="p-6 text-right pr-8">
                                @if($item->status == 'Tersedia')
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 px-3 py-1.5 rounded-md text-[10px] font-black uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 px-3 py-1.5 rounded-md text-[10px] font-black uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Terpasang
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="p-12 text-center text-slate-400 font-medium">Belum ada data Router dari tim Teknisi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 2: MATERIAL & ALAT -->
        <div id="tab-material" class="tab-content">
            <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-soft border border-slate-100 dark:border-slate-800 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50 dark:bg-slate-800/20 text-slate-400 text-[10px] tracking-widest uppercase font-extrabold border-b border-slate-100 dark:border-slate-800">
                        <tr>
                            <th class="p-6 pl-8">Nama Material / Alat Kerja</th>
                            <th class="p-6 text-right pr-8">Sisa Stok di Gudang</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800 text-sm">
                        @forelse($material ?? [] as $item)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-6 pl-8 font-extrabold text-slate-900 dark:text-white">{{ $item->item_name }}</td>
                            <td class="p-6 text-right pr-8 flex items-center justify-end gap-2">
                                <span class="font-mono text-2xl text-slate-900 dark:text-white font-black {{ $item->stock_quantity <= 10 ? 'text-red-500 dark:text-red-400' : '' }}">
                                    {{ $item->stock_quantity }}
                                </span>
                                <span class="text-slate-400 font-bold uppercase tracking-wide text-[10px] bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded">{{ $item->unit }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="p-12 text-center text-slate-400 font-medium">Belum ada data Material dari tim Teknisi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- KUMPULAN JAVASCRIPT -->
    <script>
        // 1. LOGIKA THEME TOGGLE
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            lightIcon.classList.remove('hidden');
            darkIcon.classList.add('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });

        // 2. LOGIKA TAB SWITCHER
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.className = 'tab-btn px-6 py-2.5 rounded-lg text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white transition-all';
            });
            
            document.getElementById(tabId).classList.add('active');
            
            const activeClass = 'tab-btn px-6 py-2.5 rounded-lg text-sm font-bold bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 shadow-sm transition-all';
            document.getElementById('btn-' + tabId).className = activeClass;
        }

        // 3. MICRO-ANIMATION MENU KAPSUL MELUNCUR
        const indicator = document.getElementById('nav-indicator');
        const navContainer = document.getElementById('nav-container');
        const navLinks = document.querySelectorAll('.nav-link');
        const mainContent = document.getElementById('main-content');

        function moveIndicatorTo(linkElement) {
            if (!linkElement || !navContainer) return;
            const containerRect = navContainer.getBoundingClientRect();
            const linkRect = linkElement.getBoundingClientRect();
            const offsetLeft = linkRect.left - containerRect.left;
            
            indicator.style.transform = `translateX(${offsetLeft}px)`;
            indicator.style.width = `${linkRect.width}px`;
        }

        window.addEventListener('load', () => {
            const activeLink = document.querySelector('.nav-link.active-link');
            if(activeLink) {
                indicator.style.transition = 'none'; 
                moveIndicatorTo(activeLink);
                setTimeout(() => { 
                    indicator.style.transition = 'transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)'; 
                }, 50);
            }
            if(mainContent) {
                mainContent.classList.remove('opacity-0');
            }
        });

        window.addEventListener('resize', () => {
            const activeLink = document.querySelector('.nav-link.active-link');
            if(activeLink) moveIndicatorTo(activeLink);
        });

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetUrl = this.getAttribute('href');
                if (targetUrl && targetUrl !== '#') {
                    e.preventDefault(); 
                    
                    navLinks.forEach(l => {
                        l.classList.remove('active-link', 'text-white', 'dark:text-slate-900', 'font-bold');
                        l.classList.add('text-slate-500', 'dark:text-slate-400', 'font-medium');
                    });
                    
                    this.classList.remove('text-slate-500', 'dark:text-slate-400', 'font-medium');
                    this.classList.add('active-link', 'text-white', 'dark:text-slate-900', 'font-bold');
                    
                    moveIndicatorTo(this);
                    
                    if(mainContent) {
                        mainContent.classList.remove('animate-fade-in');
                        mainContent.classList.add('animate-fade-out');
                    }
                    setTimeout(() => window.location.href = targetUrl, 250); 
                }
            });
        });
    </script>
</body>
</html>