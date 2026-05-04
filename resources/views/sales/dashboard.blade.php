<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard | ConnectMe OSS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 900: '#1e3a8a' } },
                    boxShadow: { 'card': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)' }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
        
        #nav-indicator { left: 0; will-change: transform, width; }
        .stat-card { transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease; }
        .stat-card:hover { transform: translateY(-6px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .animate-fade-out { opacity: 0; transform: translateY(-10px); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300 overflow-x-hidden">

    <!-- NAVBAR FULL -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-slate-900 dark:bg-white rounded-full flex items-center justify-center text-white dark:text-slate-900 font-bold text-lg shadow-md">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700 transition-colors">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-white rounded-full shadow-md z-0"></div>
                
                <a href="{{ route('sales.dashboard') }}" id="link-dashboard" class="nav-link active-link relative z-10 px-5 py-2 text-sm font-bold text-white dark:text-slate-900 transition-colors duration-300">Dashboard</a>
                <a href="{{ route('sales.clients.index') }}" id="link-clients" class="nav-link relative z-10 px-5 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-colors duration-300">Daftar Client</a>                
                <a href="{{ route('sales.ticket') }}" class="nav-link relative z-10 px-5 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-colors duration-300">Ticket Troubleshoot</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors focus:outline-none">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>

            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                @csrf
                <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-extrabold flex items-center justify-center uppercase">
                    {{ substr(Auth::user()->name ?? 'SL', 0, 2) }}
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name ?? 'Sales Team' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Account Executive</p>
                </div>
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <!-- QUERY LOGIC KHUSUS UNTUK HALAMAN INI -->
    @php
        $salesId = Auth::id();
        $bulanIni = \Carbon\Carbon::now()->month;
        $tahunIni = \Carbon\Carbon::now()->year;

        // 1. Tarik Data: Klien Baru Bulan Ini (Hanya portofolio sales ini)
        $pemasanganBaru = \App\Models\Customer::where('sales_id', $salesId)
                            ->whereMonth('created_at', $bulanIni)
                            ->whereYear('created_at', $tahunIni)
                            ->count();

        // 2. Tarik Data: Total Klien Aktif (Hanya portofolio sales ini)
        $clientAktif = \App\Models\Customer::where('sales_id', $salesId)
                            ->where('status', 'active')
                            ->count();
                            
        // 3. Tarik Data: 5 Klien Terbaru untuk Tabel (Hanya portofolio sales ini)
        $recentClients = \App\Models\Customer::where('sales_id', $salesId)
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
    @endphp

    <!-- MAIN CONTENT -->
    <main id="main-content" class="flex-1 p-8 max-w-[1600px] mx-auto w-full animate-fade-in opacity-0">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Halo, {{ explode(' ', Auth::user()->name ?? 'Sales')[0] }}! 👋</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Ini adalah rekap performa dan jadwal pemasangan client mu.</p>
            </div>
            
            <a href="{{ route('sales.clients.create') }}" class="flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-brand-500/30 transition-all hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Registrasi Client Baru
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stat-card bg-white dark:bg-slate-900 rounded-[24px] p-6 shadow-card border border-brand-100 dark:border-brand-900/50 flex flex-col justify-between transition-colors relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-brand-50 dark:bg-brand-500/10 rounded-full opacity-50"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-brand-100 dark:bg-brand-900/40 rounded-full"><svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg></div>
                        <h3 class="font-semibold text-slate-700 dark:text-slate-300">Pemasangan Barumu</h3>
                    </div>
                </div>
                <div class="flex items-end gap-3 relative z-10">
                    <!-- ANGKA LIVE DARI DATABASE -->
                    <span class="text-5xl font-extrabold text-brand-600 dark:text-brand-400">{{ $pemasanganBaru }}</span>
                    <span class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-1">Client (Bulan Ini)</span>
                </div>
            </div>
            
            <div class="stat-card bg-white dark:bg-slate-900 rounded-[24px] p-6 shadow-card border border-slate-200 dark:border-slate-800 flex flex-col justify-between transition-colors">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-green-50 dark:bg-green-500/10 rounded-full"><svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <h3 class="font-semibold text-slate-700 dark:text-slate-300">Total Client Aktif</h3>
                    </div>
                </div>
                <div class="flex items-end gap-3">
                    <!-- ANGKA LIVE DARI DATABASE -->
                    <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $clientAktif }}</span>
                    <span class="text-[10px] font-bold text-green-600 dark:text-green-400 mb-2 bg-green-50 dark:bg-green-500/10 px-2 py-0.5 rounded-md">Portofolio Saya</span>
                </div>
            </div>
            
            <div class="stat-card bg-white dark:bg-slate-900 rounded-[24px] p-6 shadow-card border border-slate-200 dark:border-slate-800 flex flex-col justify-between transition-colors opacity-80">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-purple-50 dark:bg-purple-500/10 rounded-full">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="font-semibold text-slate-700 dark:text-slate-300">Jadwal Pemasangan</h3>
                    </div>
                </div>
                <div class="flex justify-between items-end gap-2 w-full mt-2">
                    <!-- Card ini masih Mockup Design sesuai kesepakatan (Fitur Reschedule di Backlog) -->
                    @foreach(['Senin'=>2, 'Selasa'=>1, 'Rabu'=>3, 'Kamis'=>0, 'Jumat'=>2] as $hari => $jumlah)
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-full rounded-lg mb-2 flex items-center justify-center transition-all duration-500 {{ $jumlah == 0 ? 'bg-slate-50 dark:bg-slate-800/50 h-8' : 'bg-brand-50 dark:bg-brand-900/20 h-10 border border-brand-100 dark:border-brand-800' }}">
                                <span class="font-black text-sm {{ $jumlah == 0 ? 'text-slate-400 dark:text-slate-500' : 'text-brand-600 dark:text-brand-400' }}">{{ $jumlah }}</span>
                            </div>
                            <span class="text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">{{ substr($hari, 0, 3) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 p-8 transition-colors">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4 border-b border-slate-100 dark:border-slate-800 pb-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Rekap Client Terbaru </h3>
                    <p class="text-xs font-semibold text-slate-400 mt-1">Hanya menampilkan registrasi terbaru yang kamu tangani secara pribadi.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 dark:text-slate-500 text-[11px] uppercase tracking-wider font-extrabold border-b border-slate-100 dark:border-slate-800">
                            <th class="pb-4 pl-2">Nama Client & Unit</th>
                            <th class="pb-4">Kontak / Paket</th>
                            <th class="pb-4">Jadwal Pasang</th>
                            <th class="pb-4">Status Instalasi</th>
                            <th class="pb-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        
                        <!-- TABEL LIVE DARI DATABASE -->
                        @forelse($recentClients as $client)
                            <tr class="border-b border-slate-50 dark:border-slate-800/50 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="py-4 pl-2">
                                    <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">{{ $client->name }}</p>
                                    <p class="font-mono text-[10px] font-black text-slate-500 mt-1 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded w-max">
                                        {{ substr($client->tower, 0, 1) }}/{{ $client->floor }}/{{ $client->unit }}
                                    </p>
                                </td>
                                <td class="py-4">
                                    <p class="font-semibold text-slate-600 dark:text-slate-400 font-mono text-xs">{{ $client->phone_1 }}</p>
                                    <p class="text-[10px] font-bold text-brand-600 mt-1">{{ explode('MBPS', strtoupper($client->package))[0] ?? $client->package }} MBPS</p>
                                </td>
                                <td class="py-4">
                                    <span class="bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-bold px-3 py-1 rounded-full border border-slate-200 dark:border-slate-700 text-[10px] uppercase">
                                        {{ \Carbon\Carbon::parse($client->install_date)->format('d M') }}
                                    </span>
                                </td>
                                <td class="py-4">
                                    @if($client->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 text-amber-500 text-xs font-bold">
                                            <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menunggu Teknisi
                                        </span>
                                    @elseif($client->status == 'active')
                                        <span class="inline-flex items-center gap-1.5 text-green-600 dark:text-green-400 text-xs font-bold">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-slate-500 text-xs font-bold">
                                            Berhenti Berlangganan
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 text-right pr-2">
                                    <a href="{{ route('sales.clients.show', $client->id) }}" class="text-brand-600 hover:text-brand-700 font-bold text-xs bg-brand-50 hover:bg-brand-100 px-3 py-1.5 rounded-lg transition-colors inline-block">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-500 dark:text-slate-400 font-medium text-sm">
                                    Belum ada registrasi baru. Ayo mulai jualan! 🚀
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 text-center">
                <a href="{{ route('sales.clients.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 hover:underline">Lihat Semua Client &rarr;</a>
            </div>
        </div>
    </main>

    <script>
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
                setTimeout(() => { indicator.style.transition = 'transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)'; }, 50);
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

        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
            document.documentElement.classList.add('dark');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
            document.documentElement.classList.remove('dark');
        }

        document.getElementById('theme-toggle').addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('color-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });
    </script>
</body>
</html>