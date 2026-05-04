<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client & Billing | ConnectMe OSS</title>
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
        .dark ::-webkit-scrollbar-thumb:hover { background: #475569; }
        
        #nav-indicator { left: 0; will-change: transform, width; }
        .tower-btn.active { background-color: #1e293b; color: white; }
        .dark .tower-btn.active { background-color: white; color: #0f172a; }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .animate-fade-out { opacity: 0; transform: translateY(-10px); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300 overflow-x-hidden">

    <!-- NAVBAR MANAJEMEN -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-slate-900 dark:bg-white rounded-full flex items-center justify-center text-white dark:text-slate-900 font-bold text-lg shadow-md">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700 transition-colors">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-white rounded-full shadow-md z-0"></div>
                <a href="{{ route('manager.dashboard') }}" id="link-dashboard" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('manager.dashboard') ? 'active-link font-bold text-white dark:text-slate-900' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Analytics</a>
                <a href="{{ route('manager.clients') }}" id="link-clients" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('manager.clients') ? 'active-link font-bold text-white dark:text-slate-900' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Client & Billing</a>
                <a href="{{ route('manager.inventory') }}" id="link-inventory" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('manager.inventory') ? 'active-link font-bold text-white dark:text-slate-900' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Inventory</a>
                <a href="#" id="link-reports" class="nav-link relative z-10 px-5 py-2 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-sm font-medium transition-colors duration-300">Laporan Keuangan</a>
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
                    {{ substr(Auth::user()->name ?? 'MA', 0, 2) }}
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name ?? 'Manajemen' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Manager</p>
                </div>
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main id="main-content" class="flex-1 p-8 max-w-[1600px] mx-auto w-full animate-fade-in opacity-0">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-6">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Manajemen Client 👥</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Pantau rekam jejak pembayaran, paket langganan, dan masa aktif seluruh client.</p>
            </div>
            
            <!-- WRAPPER UNTUK SEARCH BAR DAN ICON FILTER MINI -->
            <div class="flex items-center gap-3 w-full md:w-auto relative">
                
                <!-- Search Bar -->
                <div class="relative w-full md:w-80 group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="search-client" placeholder="Cari nama / unit..." class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm">
                </div>

                <!-- DROPDOWN FILTER MENU -->
                <div class="relative">
                    <!-- Icon Button -->
                    <button onclick="toggleFilterDropdown()" class="flex items-center justify-center w-12 h-12 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-slate-500 hover:text-brand-600 hover:border-brand-300 transition-colors shadow-sm focus:outline-none" title="Filter Lanjutan">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </button>

                    <!-- Menu Dropdown Mini -->
                    <div id="filter-dropdown" class="hidden absolute right-0 top-full mt-2 w-64 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl z-50 p-4 transform opacity-0 scale-95 transition-all origin-top-right">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Paket Bandwidth</label>
                                <select id="filter-bandwidth" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 outline-none focus:border-brand-500 cursor-pointer">
                                    <option value="all">Semua Paket</option>
                                    <option value="30">30 Mbps</option>
                                    <option value="50">50 Mbps</option>
                                    <option value="100">100 Mbps</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Status Billing</label>
                                <select id="filter-billing" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 outline-none focus:border-brand-500 cursor-pointer">
                                    <option value="all">Semua Status</option>
                                    <option value="lunas">Lunas / Aktif</option>
                                    <option value="terisolir">Terisolir</option>
                                    <option value="belum aktif">Belum Aktif</option>
                                    <option value="berhenti">Berhenti</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Urutkan Client</label>
                                <select id="filter-sort" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 outline-none focus:border-brand-500 cursor-pointer">
                                    <option value="newest">Paling Baru</option>
                                    <option value="oldest">Paling Lama</option>
                                </select>
                            </div>
                            <div class="pt-2 border-t border-slate-100 dark:border-slate-800/50">
                                <button onclick="resetFilters()" class="w-full flex items-center justify-center gap-1.5 px-4 py-2 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/50 hover:bg-red-100 dark:hover:bg-red-500/20 rounded-lg text-sm font-bold transition-colors focus:outline-none" title="Reset filter">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Clear Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOMBOL TOWER -->
        <div class="flex flex-wrap gap-2 mb-8">
            <button onclick="filterTower('All', this)" class="tower-btn active px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900">Semua Tower</button>
            <button onclick="filterTower('Alamanda', this)" class="tower-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50">Alamanda</button>
            <button onclick="filterTower('Bougenville', this)" class="tower-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50">Bougenville</button>
            <button onclick="filterTower('Chrysant', this)" class="tower-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50">Chrysant</button>
            <button onclick="filterTower('Dahlia', this)" class="tower-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50">Dahlia</button>
            <button onclick="filterTower('Emerald', this)" class="tower-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50">Emerald</button>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 dark:text-slate-500 text-[11px] uppercase tracking-wider font-extrabold border-b border-slate-100 dark:border-slate-800">
                            <th class="p-6 pl-6">Profil Client & Lokasi</th>
                            <th class="p-6">Kontak (HP)</th>
                            <th class="p-6">Paket Langganan</th>
                            <th class="p-6">Tgl Mulai Aktif</th>
                            <th class="p-6">Masa Aktif / Due Date</th>
                            <th class="p-6">Status Billing</th>
                            <th class="p-6 text-center">Troubleshoot</th>
                            <th class="p-6 text-right pr-6">Aksi</th>
                        </tr>
                    </thead>
                    
                    <!-- INILAH BAGIAN YANG 100% REAL-TIME DARI DATABASE -->
                    <tbody id="client-table-body" class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        @forelse($clients ?? [] as $client)
                            @php
                                $installDate = $client->installed_at ? \Carbon\Carbon::parse($client->installed_at) : \Carbon\Carbon::parse($client->created_at);
                                $dueDate = $installDate->copy()->addDays(30);
                                
                                $statusLabel = 'Menunggu Pemasangan';
                                $statusClass = 'bg-amber-50 text-amber-600 border-amber-200 dark:bg-amber-500/10 dark:border-amber-900/50';
                                $billingStatusText = 'Belum Aktif';
                                
                                if($client->status == 'active') {
                                    $statusLabel = 'Lunas / Aktif';
                                    $statusClass = 'bg-green-50 text-green-600 border-green-200 dark:bg-green-500/10 dark:border-green-900/50';
                                    $billingStatusText = 'Lunas';
                                } elseif($client->status == 'isolated') {
                                    $statusLabel = 'Terisolir (Menunggak)';
                                    $statusClass = 'bg-slate-200 text-slate-600 border-slate-300 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400';
                                    $billingStatusText = 'Terisolir';
                                } elseif($client->status == 'terminated') {
                                    $statusLabel = 'Berhenti / Terminasi';
                                    $statusClass = 'bg-red-50 text-red-600 border-red-200 dark:bg-red-500/10 dark:border-red-900/50';
                                    $billingStatusText = 'Berhenti';
                                }
                                $unitCode = substr($client->tower, 0, 1) . '/' . $client->floor . '/' . $client->unit;

                                $waNumber = preg_replace('/[^0-9]/', '', $client->phone_1);
                                if (substr($waNumber, 0, 1) === '0') {
                                    $waNumber = '62' . substr($waNumber, 1);
                                }
                            @endphp

                            <!-- DATA-ATTRIBUTES UNTUK JAVASCRIPT FILTERING & SORTING -->
                            <tr class="client-row hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors {{ $client->status == 'isolated' ? 'opacity-75 hover:opacity-100' : '' }}"
                                data-paket="{{ strtolower($client->package) }}"
                                data-status="{{ strtolower($billingStatusText) }}"
                                data-date="{{ $installDate->timestamp }}">
                                
                                <td class="p-6 pl-6 {{ $client->status == 'terminated' ? 'border-l-4 border-red-500' : '' }}">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-brand-50 dark:bg-brand-500/10 text-brand-600 flex items-center justify-center font-bold text-xs uppercase shrink-0">
                                            {{ substr($client->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 dark:text-slate-200 text-base leading-none">{{ $client->name }}</p>
                                            <p class="unit-badge font-mono text-[10px] font-black text-slate-500 mt-2 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded w-max">{{ $unitCode }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="p-6">
                                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="inline-flex items-center gap-1.5 font-semibold text-slate-600 dark:text-slate-400 font-mono tracking-wide hover:text-green-500 transition-colors group" title="Chat via WhatsApp">
                                        <svg class="w-4 h-4 text-green-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                        {{ $client->phone_1 }}
                                    </a>
                                </td>
                                
                                <td class="p-6">
                                    <span class="inline-flex items-center bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-3 py-1 rounded-lg font-bold text-xs shadow-sm">
                                        {{ $client->package }}
                                    </span>
                                </td>
                                
                                <td class="p-6 font-semibold text-slate-600 dark:text-slate-400">
                                    {{ $client->status == 'pending' ? 'Belum Aktif' : $installDate->format('d M Y') }}
                                </td>
                                
                                <td class="p-6 font-semibold text-slate-600 dark:text-slate-400">
                                    {{ $client->status == 'pending' ? 'Belum Aktif' : $dueDate->format('d M Y') }}
                                </td>
                                
                                <td class="p-6">
                                    <span class="inline-flex items-center gap-1.5 {{ $statusClass }} px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border">
                                        @if($client->status == 'active') <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> @endif
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                
                                <td class="p-6 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full font-black text-xs">0</span>
                                </td>
                                
                                <td class="p-6 text-right pr-6">
                                    <button onclick="openDetail(
                                        '{{ $client->name }}', 
                                        '{{ $unitCode }}', 
                                        '{{ $client->phone_1 }}', 
                                        '{{ $client->package }}', 
                                        '{{ $billingStatusText }}', 
                                        0, 
                                        '{{ \Carbon\Carbon::parse($client->created_at)->format('d M Y') }}', 
                                        '{{ $client->status == 'pending' ? '-' : $dueDate->format('d M Y') }}', 
                                        'Transfer Mandiri PT Multi Media Access',
                                        '{{ $client->router_sn ?? 'Belum Terpasang' }}'
                                    )" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 hover:border-brand-300 dark:hover:border-brand-700 hover:bg-brand-50 dark:hover:bg-brand-900/20 text-slate-600 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 rounded-xl font-bold text-xs transition-all shadow-sm focus:outline-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr id="empty-state-row"><td colspan="8" class="p-8 text-center text-slate-500 font-medium">Belum ada data klien.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal Detail Offcanvas -->
    <div id="detail-backdrop" class="fixed inset-0 bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-sm z-[100] hidden transition-opacity opacity-0 duration-300" onclick="closeDetail()"></div>
    <div id="detail-panel" class="fixed inset-y-0 right-0 w-full max-w-[480px] bg-slate-50 dark:bg-slate-950 shadow-2xl z-[110] transform translate-x-full transition-transform duration-500 ease-in-out flex flex-col border-l border-slate-200 dark:border-slate-800">
        <div class="px-8 py-6 border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 flex justify-between items-start shrink-0">
            <div class="flex gap-4 items-center">
                <div id="detail-avatar" class="w-14 h-14 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-600 dark:text-brand-400 flex items-center justify-center font-black text-xl shadow-inner border border-brand-200 dark:border-brand-800">C</div>
                <div>
                    <h3 id="detail-name" class="text-xl font-extrabold text-slate-900 dark:text-white leading-tight">Nama Klien</h3>
                    <div class="flex items-center gap-2 mt-1.5">
                        <span id="detail-status" class="inline-flex items-center gap-1.5 bg-slate-200 text-slate-600 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Status</span>
                        <span id="detail-unit" class="text-xs font-mono font-bold text-slate-500">Unit</span>
                    </div>
                </div>
            </div>
            <button onclick="closeDetail()" class="p-2 bg-slate-100 dark:bg-slate-800 rounded-full text-slate-400 hover:text-slate-700 dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-8 space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Paket Internet</p>
                    <p id="detail-paket" class="text-sm font-extrabold text-brand-600 dark:text-brand-400">-</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Masa Aktif (Due)</p>
                    <p id="detail-due" class="text-sm font-bold text-slate-800 dark:text-slate-200">-</p>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Detail Tambahan</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800/50 pb-3">
                        <span class="text-sm font-medium text-slate-500">Kontak (HP)</span>
                        <span id="detail-phone" class="text-sm font-bold text-slate-800 dark:text-slate-200 font-mono">-</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800/50 pb-3">
                        <span class="text-sm font-medium text-slate-500">Tgl Registrasi</span>
                        <span id="detail-join" class="text-sm font-bold text-slate-800 dark:text-slate-200">-</span>
                    </div>
                    <div class="flex flex-col border-b border-slate-100 dark:border-slate-800/50 pb-3">
                        <span class="text-sm font-medium text-slate-500 mb-1">Metode Bayar</span>
                        <span id="detail-pay" class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase text-right">-</span>
                    </div>
                    <div class="flex items-center justify-between pb-1">
                        <span class="text-sm font-medium text-slate-500">SN Router</span>
                        <span id="detail-router-sn" class="text-sm font-bold text-slate-800 dark:text-slate-200 font-mono">-</span>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                <div class="flex justify-between items-center mb-5">
                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-400">Riwayat Teknis</h4>
                    <span id="detail-ticket-count" class="bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 px-2 py-1 rounded font-bold text-[10px]">0 Tiket</span>
                </div>
                <div id="detail-tickets" class="mt-2"></div>
            </div>
        </div>
    </div>

    <script>
        // --- 1. SLIDE-OVER MODAL LOGIC ---
        const backdrop = document.getElementById('detail-backdrop');
        const panel = document.getElementById('detail-panel');

        function openDetail(name, unit, phone, paket, status, tiket, joinDate, dueDate, payMethod, routerSN) {
            document.getElementById('detail-name').innerText = name;
            document.getElementById('detail-avatar').innerText = name.substring(0, 2).toUpperCase();
            document.getElementById('detail-unit').innerText = unit;
            document.getElementById('detail-paket').innerText = paket;
            document.getElementById('detail-due').innerText = dueDate;
            document.getElementById('detail-phone').innerText = phone;
            document.getElementById('detail-join').innerText = joinDate;
            document.getElementById('detail-pay').innerText = payMethod;
            document.getElementById('detail-router-sn').innerText = routerSN;
            document.getElementById('detail-ticket-count').innerText = tiket + " Tiket";

            const statusBadge = document.getElementById('detail-status');
            if(status === 'Lunas') {
                statusBadge.className = "inline-flex items-center gap-1.5 bg-green-50 dark:bg-green-500/10 text-green-600 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider border border-green-200 dark:border-green-900/50";
                statusBadge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Lunas';
            } else if(status === 'Terisolir') {
                statusBadge.className = "inline-flex items-center gap-1.5 bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider border border-slate-300 dark:border-slate-700";
                statusBadge.innerHTML = 'Terisolir';
            } else if(status === 'Berhenti') {
                statusBadge.className = "inline-flex items-center gap-1.5 bg-red-50 dark:bg-red-500/10 text-red-600 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider border border-red-200 dark:border-red-900/50";
                statusBadge.innerHTML = 'Terminasi';
            } else {
                statusBadge.className = "inline-flex items-center gap-1.5 bg-amber-50 dark:bg-amber-500/10 text-amber-600 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider border border-amber-200 dark:border-amber-900/50";
                statusBadge.innerHTML = 'Belum Aktif';
            }

            const ticketContainer = document.getElementById('detail-tickets');
            if(tiket == 0) {
                ticketContainer.innerHTML = '<p class="text-sm text-slate-400 dark:text-slate-500 font-medium py-2">Tidak ada riwayat kendala teknis.</p>';
            }

            backdrop.classList.remove('hidden');
            setTimeout(() => { backdrop.classList.remove('opacity-0'); panel.classList.remove('translate-x-full'); }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeDetail() {
            backdrop.classList.add('opacity-0');
            panel.classList.add('translate-x-full');
            setTimeout(() => { backdrop.classList.add('hidden'); document.body.style.overflow = 'auto'; }, 300); 
        }

        // --- 2. LOGIKA DROPDOWN FILTER & SORTING ---
        const towerMapping = {
            'Alamanda': ['A'], 'Bougenville': ['B'], 'Chrysant': ['C'], 'Dahlia': ['D'], 'Emerald': ['E']
        };

        let currentTower = 'All'; 
        let currentSearch = '';
        let currentBandwidth = 'all'; 
        let currentBilling = 'all';   
        let currentSort = 'newest';

        function toggleFilterDropdown() {
            const dropdown = document.getElementById('filter-dropdown');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                setTimeout(() => {
                    dropdown.classList.remove('opacity-0', 'scale-95');
                    dropdown.classList.add('opacity-100', 'scale-100');
                }, 10);
            } else {
                dropdown.classList.remove('opacity-100', 'scale-100');
                dropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => dropdown.classList.add('hidden'), 200);
            }
        }

        // Tutup dropdown jika klik area luar
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('filter-dropdown');
            if (!dropdown) return;
            const filterBtn = dropdown.previousElementSibling;
            if (!dropdown.contains(e.target) && !filterBtn.contains(e.target)) {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('opacity-100', 'scale-100');
                    dropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => dropdown.classList.add('hidden'), 200);
                }
            }
        });

        function resetFilters() {
            document.getElementById('search-client').value = '';
            document.getElementById('filter-bandwidth').value = 'all';
            document.getElementById('filter-billing').value = 'all';
            document.getElementById('filter-sort').value = 'newest';
            
            currentSearch = ''; currentBandwidth = 'all'; currentBilling = 'all'; currentSort = 'newest';

            const btnAll = document.querySelector('.tower-btn[onclick*="All"]');
            if (btnAll) filterTower('All', btnAll, true);
            else applyFilters();

            const dropdown = document.getElementById('filter-dropdown');
            dropdown.classList.remove('opacity-100', 'scale-100');
            dropdown.classList.add('opacity-0', 'scale-95');
            setTimeout(() => dropdown.classList.add('hidden'), 200);
        }

        function applyFilters() {
            const tbody = document.getElementById('client-table-body');
            const rows = Array.from(tbody.querySelectorAll('.client-row'));

            rows.forEach(row => {
                const unitEl = row.querySelector('.unit-badge');
                if(!unitEl) return;
                
                const textContent = row.innerText.toLowerCase();
                const firstLetter = unitEl.innerText.trim().charAt(0).toUpperCase();
                
                const dataPaket = row.getAttribute('data-paket') || '';
                const dataStatus = row.getAttribute('data-status') || '';
                
                const matchesSearch = textContent.includes(currentSearch);
                const matchesTower = currentTower === 'All' ? true : (towerMapping[currentTower] && towerMapping[currentTower].includes(firstLetter));
                
                // MENCARI ANGKA (MISAL: "30" DI DALAM "promo_30_1m")
                const matchesBandwidth = currentBandwidth === 'all' ? true : dataPaket.includes(currentBandwidth);
                const matchesBilling = currentBilling === 'all' ? true : dataStatus.includes(currentBilling);
                
                if(matchesSearch && matchesTower && matchesBandwidth && matchesBilling) { 
                    row.style.display = ''; 
                } else { 
                    row.style.display = 'none'; 
                }
            });

            // Sorting Baris (Hanya sort row yang bukan empty state)
            if (rows.length > 0) {
                rows.sort((a, b) => {
                    const dateA = parseInt(a.getAttribute('data-date'));
                    const dateB = parseInt(b.getAttribute('data-date'));
                    if (currentSort === 'newest') return dateB - dateA;
                    if (currentSort === 'oldest') return dateA - dateB;
                    return 0;
                });
                
                rows.forEach(row => tbody.appendChild(row));
            }
        }

        document.getElementById('filter-bandwidth').addEventListener('change', (e) => { currentBandwidth = e.target.value; applyFilters(); });
        document.getElementById('filter-billing').addEventListener('change', (e) => { currentBilling = e.target.value.toLowerCase(); applyFilters(); });
        document.getElementById('filter-sort').addEventListener('change', (e) => { currentSort = e.target.value; applyFilters(); });
        document.getElementById('search-client').addEventListener('input', (e) => { currentSearch = e.target.value.toLowerCase(); applyFilters(); });

        function filterTower(towerName, btnElement, isFromReset = false) {
            if (currentTower === towerName && towerName !== 'All' && !isFromReset) {
                towerName = 'All';
                btnElement = document.querySelector('.tower-btn[onclick*="All"]');
            }

            document.querySelectorAll('.tower-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-slate-900', 'text-white', 'dark:bg-white', 'dark:text-slate-900');
                btn.classList.add('bg-white', 'dark:bg-slate-900', 'text-slate-800', 'dark:text-slate-200');
            });
            btnElement.classList.remove('bg-white', 'dark:bg-slate-900', 'text-slate-800', 'dark:text-slate-200');
            btnElement.classList.add('active', 'bg-slate-900', 'text-white', 'dark:bg-white', 'dark:text-slate-900');
            
            currentTower = towerName; 
            applyFilters();
        }

        // --- 3. ANIMASI NAV & THEME TOGGLE ---
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
                        mainContent.classList.remove('animate-fade-in'); mainContent.classList.add('animate-fade-out');
                    }
                    setTimeout(() => window.location.href = targetUrl, 250); 
                }
            });
        });

        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden'); document.documentElement.classList.add('dark');
        } else {
            themeToggleDarkIcon.classList.remove('hidden'); document.documentElement.classList.remove('dark');
        }

        document.getElementById('theme-toggle').addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden'); themeToggleLightIcon.classList.toggle('hidden');
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('color-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });
    </script>
</body>
</html>