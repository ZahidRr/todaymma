<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Client | Admin ConnectMe</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { 
                extend: { 
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] }, 
                    colors: { brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 900: '#1e3a8a' } } 
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
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        #nav-indicator { left: 0; will-change: transform, width; }
    </style>
</head>
<body class="text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- NAVBAR ADMIN -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200/80 dark:border-slate-800 shadow-sm transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg">+</div>
                <h1 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>
            
            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-50 dark:bg-slate-800 p-1 rounded-full border border-slate-200/60 dark:border-slate-700">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-white rounded-full shadow-md z-0 transition-all duration-300"></div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Dashboard</a>
                <a href="{{ route('admin.verifikasi') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Verifikasi Tagihan</a>
                
                <!-- ACTIVE LINK -->
                <a href="{{ route('admin.clients') }}" class="nav-link active-link relative z-10 px-6 py-2 text-sm font-bold text-white dark:text-slate-900 transition-colors">Database Client</a>
                
                <a href="{{ route('admin.invoices') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Invoice</a>
                <a href="{{ route('admin.inventory') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Inventory</a>
            </div>
        </div>

        <div class="flex items-center gap-5">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-50 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-slate-100 transition-colors">
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
            </form>
        </div>
    </nav>

    <!-- PISAHKAN DATA CLIENT DENGAN PHP BLADE -->
    @php
        $activeClients = collect($clients ?? [])->filter(function($client) {
            return !in_array($client->status, ['req_terminate', 'terminated']);
        });

        $terminatedClients = collect($clients ?? [])->filter(function($client) {
            return in_array($client->status, ['req_terminate', 'terminated']);
        });
    @endphp

    <!-- MAIN CONTENT -->
    <main id="main-content" class="flex-1 p-8 max-w-[1400px] mx-auto w-full animate-fade-in opacity-0">
        
        <!-- Alerts -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 dark:border-green-900 dark:bg-green-500/10 p-4 rounded-2xl flex items-center gap-3 text-green-700 dark:text-green-400 font-bold text-sm shadow-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 dark:border-red-900 dark:bg-red-500/10 p-4 rounded-2xl flex items-center gap-3 text-red-700 dark:text-red-400 font-bold text-sm shadow-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-4">
            <div>
                <h2 class="text-[32px] font-black text-slate-900 dark:text-white tracking-tight">Database Client 🗄️</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1.5 font-medium">Manajemen seluruh data pelanggan, tagihan, dan kontrol isolir.</p>
            </div>
            
            <form action="{{ route('admin.clients') }}" method="GET" class="flex gap-3 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / unit..." class="w-full md:w-64 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 shadow-sm">
                <button type="submit" class="bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-5 py-2.5 rounded-xl text-sm font-bold shadow-md hover:bg-slate-800 transition-colors">Cari</button>
            </form>
        </div>

        <!-- SISTEM TABS UI -->
        <div class="flex space-x-1 border-b border-slate-200 dark:border-slate-800 mb-6">
            <button onclick="switchTab('active')" id="btn-tab-active" class="px-6 py-3.5 text-sm font-bold text-brand-600 dark:text-brand-400 border-b-2 border-brand-600 dark:border-brand-400 transition-colors flex items-center gap-2">
                Client Aktif 
                <span class="bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 py-0.5 px-2.5 rounded-full text-[10px]">{{ $activeClients->count() }}</span>
            </button>
            <button onclick="switchTab('terminated')" id="btn-tab-terminated" class="px-6 py-3.5 text-sm font-bold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white border-b-2 border-transparent transition-colors flex items-center gap-2">
                Berhenti Langganan
                <span class="bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 py-0.5 px-2.5 rounded-full text-[10px]">{{ $terminatedClients->count() }}</span>
            </button>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
            
            <!-- TAB 1: CLIENT AKTIF (Termasuk yang pending & menunggak) -->
            <div id="table-active" class="overflow-x-auto block">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50">
                            <th class="p-5 pl-6">DATA CLIENT</th>
                            <th class="p-5">PAKET & KONTAK</th>
                            <th class="p-5">STATUS KONEKSI</th>
                            <th class="p-5">STATUS BAYAR</th>
                            <th class="p-5 text-right pr-6">KONTROL ADMIN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800 text-sm">
                        @forelse($activeClients as $client)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="p-5 pl-6">
                                    <p class="font-extrabold text-slate-900 dark:text-white">{{ $client->name }}</p>
                                    <p class="text-[11px] font-mono font-bold text-slate-500 mt-1 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded w-max">
                                        {{ substr($client->tower, 0, 1) }}/{{ $client->floor }}/{{ $client->unit }}
                                    </p>
                                </td>
                                
                                <td class="p-5">
                                    <p class="font-bold text-slate-700 dark:text-slate-300 text-xs">{{ explode('MBPS', strtoupper($client->package))[0] ?? $client->package }} MBPS</p>
                                    <p class="text-[11px] font-mono text-slate-400 mt-1">{{ $client->phone_1 }}</p>
                                </td>
                                
                                <td class="p-5">
                                    @if($client->status == 'active')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-green-50 dark:bg-green-500/10 text-green-600 border border-green-200 dark:border-green-800 rounded text-[10px] font-black uppercase"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Online</span>
                                    @elseif($client->status == 'isolated')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-red-50 dark:bg-red-500/10 text-red-600 border border-red-200 dark:border-red-800 rounded text-[10px] font-black uppercase"><span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Terisolir</span>
                                    @elseif($client->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-amber-50 dark:bg-amber-500/10 text-amber-600 border border-amber-200 dark:border-amber-800 rounded text-[10px] font-black uppercase"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending Pasang</span>
                                    @endif
                                </td>
                                
                                <td class="p-5">
                                    @if($client->payment_status == 'lunas')
                                        <span class="text-[11px] font-bold text-green-600 dark:text-green-400">Lunas</span>
                                    @elseif($client->payment_status == 'menunggu_verifikasi')
                                        <span class="text-[11px] font-bold text-amber-600 dark:text-amber-400">Proses Cek</span>
                                    @else
                                        <span class="text-[11px] font-bold text-red-600 dark:text-red-400">Belum Bayar</span>
                                    @endif
                                </td>
                                
                                <td class="p-5 text-right pr-6">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- TOMBOL BUAT TAGIHAN -->
                                        <form action="{{ route('admin.invoices.generate', $client->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Buat tagihan baru untuk klien ini?');" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-900/20 rounded-lg transition-colors" title="Buat Tagihan Baru">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            </button>
                                        </form>

                                        <!-- TOMBOL ISOLIR -->
                                        @if($client->status == 'active' && $client->payment_status == 'belum_bayar')
                                        <form action="{{ route('admin.clients.isolate', $client->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Kirim perintah Isolir ke Teknisi untuk mematikan PPPoE klien ini?');" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-[11px] font-bold shadow-sm transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                Isolir Klien
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-12 text-center text-slate-400 text-sm font-medium">Tidak ada data klien aktif.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TAB 2: CLIENT BERHENTI LANGGANAN -->
            <div id="table-terminated" class="overflow-x-auto hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50">
                            <th class="p-5 pl-6">DATA CLIENT</th>
                            <th class="p-5">PAKET AWAL</th>
                            <th class="p-5">STATUS TERMINASI</th>
                            <th class="p-5">TANGGAL UPDATE</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800 text-sm">
                        @forelse($terminatedClients as $client)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors opacity-75">
                                <td class="p-5 pl-6">
                                    <p class="font-extrabold text-slate-700 dark:text-slate-300 line-through decoration-slate-400">{{ $client->name }}</p>
                                    <p class="text-[11px] font-mono font-bold text-slate-400 mt-1">
                                        {{ substr($client->tower, 0, 1) }}/{{ $client->floor }}/{{ $client->unit }}
                                    </p>
                                </td>
                                
                                <td class="p-5 text-slate-500">
                                    <p class="font-bold text-xs">{{ explode('MBPS', strtoupper($client->package))[0] ?? $client->package }} MBPS</p>
                                </td>
                                
                                <td class="p-5">
                                    @if($client->status == 'req_terminate')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-amber-50 dark:bg-amber-500/10 text-amber-600 border border-amber-200 dark:border-amber-800 rounded text-[10px] font-black uppercase"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu Penarikan Router</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-200 dark:border-slate-700 rounded text-[10px] font-black uppercase"><span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Sudah Dibongkar</span>
                                    @endif
                                </td>
                                
                                <td class="p-5 text-slate-500 text-xs font-bold">
                                    {{ \Carbon\Carbon::parse($client->updated_at)->format('d M Y, H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="p-12 text-center text-slate-400 text-sm font-medium">Belum ada klien yang berhenti berlangganan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <script>
        // Logika Pindah Tab
        function switchTab(tabName) {
            const tableActive = document.getElementById('table-active');
            const tableTerminated = document.getElementById('table-terminated');
            const btnActive = document.getElementById('btn-tab-active');
            const btnTerminated = document.getElementById('btn-tab-terminated');

            if (tabName === 'active') {
                tableActive.classList.remove('hidden');
                tableTerminated.classList.add('hidden');
                
                btnActive.className = "px-6 py-3.5 text-sm font-bold text-brand-600 dark:text-brand-400 border-b-2 border-brand-600 dark:border-brand-400 transition-colors flex items-center gap-2";
                btnTerminated.className = "px-6 py-3.5 text-sm font-bold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white border-b-2 border-transparent transition-colors flex items-center gap-2";
            } else {
                tableActive.classList.add('hidden');
                tableTerminated.classList.remove('hidden');
                
                btnTerminated.className = "px-6 py-3.5 text-sm font-bold text-brand-600 dark:text-brand-400 border-b-2 border-brand-600 dark:border-brand-400 transition-colors flex items-center gap-2";
                btnActive.className = "px-6 py-3.5 text-sm font-bold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white border-b-2 border-transparent transition-colors flex items-center gap-2";
            }
        }

        // Animasi Menu Pil Navbar
        const indicator = document.getElementById('nav-indicator'); 
        const navContainer = document.getElementById('nav-container');
        
        function moveIndicatorTo(linkElement) { 
            if (!linkElement || !navContainer) return; 
            const containerRect = navContainer.getBoundingClientRect(); 
            const linkRect = linkElement.getBoundingClientRect(); 
            indicator.style.transform = `translateX(${linkRect.left - containerRect.left}px)`; 
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
            document.getElementById('main-content').classList.remove('opacity-0'); 
        });
        
        window.addEventListener('resize', () => { 
            const activeLink = document.querySelector('.nav-link.active-link'); 
            if(activeLink) moveIndicatorTo(activeLink); 
        });

        // Theme Toggle Dark Mode
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