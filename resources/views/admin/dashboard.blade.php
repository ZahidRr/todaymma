<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Workspace | ConnectMe OSS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        .dark body { background-color: #0f172a; } /* Slate 900 untuk dark mode */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        /* Hilangkan scrollbar di slider agar rapi */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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

            <div class="hidden md:flex items-center bg-slate-50 dark:bg-slate-800 p-1 rounded-full border border-slate-200/60 dark:border-slate-700">
                <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 text-sm font-bold bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 rounded-full shadow-md transition-all">Dashboard</a>
                <a href="{{ route('admin.verifikasi') }}" class="px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Verifikasi Tagihan</a>
                <a href="{{ route('admin.clients') }}" class="px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Database Client</a>
                <a href="{{ route('admin.invoices') }}" class="px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Invoice</a>
                <a href="{{ route('admin.inventory') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all duration-300">Inventory</a>
            </div>
        </div>

        <div class="flex items-center gap-5">
            <!-- Theme Toggle Moon/Sun -->
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-50 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
            </button>

            <div class="h-8 w-px bg-slate-200 dark:bg-slate-700"></div>

            <!-- User Avatar -->
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

    <main class="flex-1 p-8 max-w-[1400px] mx-auto w-full animate-fade-in">
        
        <!-- Notifikasi -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-900 p-4 rounded-2xl flex items-center gap-3 text-green-700 dark:text-green-400 font-bold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-[32px] font-black text-slate-900 dark:text-white tracking-tight">Welcome back, {{ explode(' ', Auth::user()->name ?? 'Admin')[0] }}! 🌻</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1.5 font-medium">Berikut ini adalah ringkasan tagihan dan operasional jaringan hari ini.</p>
            </div>
            <button class="hidden md:flex items-center gap-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2.5 rounded-xl text-sm font-bold text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Hari Ini
            </button>
        </div>

        <!-- STAT CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- Card 1: Verifikasi -->
            <div class="bg-white dark:bg-slate-900 rounded-[24px] p-7 shadow-soft border border-slate-100 dark:border-slate-800 flex flex-col justify-between min-h-[140px] transition-colors">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <h3 class="font-medium text-slate-700 dark:text-slate-300 text-sm">Verifikasi Bukti Bayar</h3>
                </div>
                <div class="flex justify-between items-end">
                    <span class="text-[54px] font-black text-slate-900 dark:text-white leading-none tracking-tighter">{{ $jumlahVerifikasi ?? 0 }}</span>
                    <a href="#verifikasi-table" class="text-xs font-bold text-purple-600 bg-purple-50 hover:bg-purple-100 dark:bg-purple-900/20 dark:hover:bg-purple-900/40 px-3 py-1.5 rounded-lg transition-colors">Cek Mutasi ></a>
                </div>
            </div>

            <!-- Card 2: Isolir -->
            <div class="bg-white dark:bg-slate-900 rounded-[24px] p-7 shadow-soft border border-slate-100 dark:border-slate-800 flex flex-col justify-between min-h-[140px] transition-colors">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <h3 class="font-medium text-slate-700 dark:text-slate-300 text-sm">Client Belum Bayar</h3>
                </div>
                <div class="flex justify-between items-end">
                    <span class="text-[54px] font-black text-slate-900 dark:text-white leading-none tracking-tighter">{{ $klienMenunggak ?? 0 }}</span>
                    <span class="text-xs font-bold text-teal-600 dark:text-teal-400">Unit</span>
                </div>
            </div>

            <!-- Card 3: Terminate -->
            <div class="bg-white dark:bg-slate-900 rounded-[24px] p-7 shadow-soft border border-slate-100 dark:border-slate-800 flex flex-col justify-between min-h-[140px] transition-colors">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <h3 class="font-medium text-slate-700 dark:text-slate-300 text-sm">Permintaan Berhenti</h3>
                </div>
                <div class="flex justify-between items-end">
                    <span class="text-[54px] font-black text-slate-900 dark:text-white leading-none tracking-tighter">{{ $klienBerhenti ?? 0 }}</span>
                    <!-- HANYA BARIS INI YANG DIUBAH -->
                    <a href="{{ route('admin.clients') }}" class="text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 px-3 py-1.5 rounded-lg transition-colors">Proses ></a>
                </div>
            </div>

            <!-- Card 4: Stok Slider -->
            <div class="bg-white dark:bg-slate-900 rounded-[24px] p-7 shadow-soft border border-slate-100 dark:border-slate-800 flex flex-col justify-between min-h-[140px] transition-colors overflow-hidden relative group">
                <div class="flex justify-between items-start mb-2 z-10">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <h3 class="font-medium text-slate-700 dark:text-slate-300 text-sm" id="slider-title">Stok Router</h3>
                    </div>
                    <!-- Navigation Buttons -->
                    <div class="flex items-center gap-1">
                        <button onclick="slideStock('left')" class="w-6 h-6 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-slate-800 dark:hover:text-white border border-slate-200 dark:border-slate-700"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                        <button onclick="slideStock('right')" class="w-6 h-6 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-slate-800 dark:hover:text-white border border-slate-200 dark:border-slate-700"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
                    </div>
                </div>

                <!-- Slider Container -->
                <div class="w-full overflow-hidden no-scrollbar z-10" id="stock-container">
                    <div class="flex transition-transform duration-500 ease-in-out w-[200%]" id="stock-slider">
                        
                        <!-- Slide 1: Router -->
                        <div class="w-1/2 flex justify-between items-end flex-shrink-0">
                            <span class="text-[54px] font-black text-slate-900 dark:text-white leading-none tracking-tighter">
                                <!-- Asumsi di backend sudah difilter: $stokRouter -->
                                {{ $stokRouter ?? 12 }}
                            </span>
                            <span class="text-xs font-bold text-blue-600 dark:text-blue-400 mb-1">Unit</span>
                        </div>

                        <!-- Slide 2: Kabel UTP -->
                        <div class="w-1/2 flex justify-between items-end flex-shrink-0">
                            <span class="text-[54px] font-black text-slate-900 dark:text-white leading-none tracking-tighter">
                                <!-- Asumsi di backend: $stokKabel -->
                                {{ $stokKabel ?? 3 }}
                            </span>
                            <span class="text-xs font-bold text-blue-600 dark:text-blue-400 mb-1">Roll / Box</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- TABLES SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Table Kiri (Verifikasi) -->
            <div id="verifikasi-table" class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-[24px] shadow-soft border border-slate-100 dark:border-slate-800 p-8 transition-colors">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 dark:text-white text-[18px]">Antrean Verifikasi Struk</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                                <th class="pb-4 font-bold">NAMA CLIENT</th>
                                <th class="pb-4 font-bold">KETERANGAN</th>
                                <th class="pb-4 font-bold">NOMINAL</th>
                                <th class="pb-4 font-bold text-right">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800 text-sm">
                            @forelse($butuhVerifikasi ?? [] as $inv)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="py-5">
                                        <p class="font-extrabold text-slate-900 dark:text-white">{{ $inv->customer->name ?? 'Unknown' }}</p>
                                        <p class="text-xs text-slate-500 font-medium mt-0.5">Unit: {{ substr($inv->customer->tower ?? '', 0, 1) }}/{{ $inv->customer->floor ?? '' }}/{{ $inv->customer->unit ?? '' }}</p>
                                    </td>
                                    <td class="py-5">
                                        <p class="font-bold text-slate-700 dark:text-slate-300">{{ $inv->billing_period }}</p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase mt-0.5">{{ \Carbon\Carbon::parse($inv->updated_at)->diffForHumans() }}</p>
                                    </td>
                                    <td class="py-5">
                                        <p class="font-extrabold text-slate-900 dark:text-white">Rp{{ number_format($inv->amount, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="py-5 text-right flex items-center justify-end gap-2">
                                        <a href="{{ asset('storage/' . $inv->payment_proof) }}" target="_blank" class="text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-brand-600 bg-slate-50 dark:bg-slate-800 px-3 py-2 rounded-lg transition-colors border border-slate-200 dark:border-slate-700">
                                            Cek Bukti
                                        </a>
                                        <form action="{{ route('admin.invoices.approve', $inv->id) }}" method="POST" onsubmit="return confirm('Dana sudah masuk mutasi?');">
                                            @csrf
                                            <button type="submit" class="text-xs font-bold text-white bg-slate-900 dark:bg-brand-600 hover:bg-brand-600 px-4 py-2 rounded-lg transition-colors">
                                                Validasi
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-slate-400 text-sm font-medium">
                                        Belum ada antrian verifikasi. Tagihan aman!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table Kanan - Tunggakan -->
            <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-soft border border-slate-100 dark:border-slate-800 p-8 flex flex-col transition-colors">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 dark:text-white text-[18px]">History Client Isolir</h3>
                </div>

                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($tabelTunggakan ?? [] as $tunggak)
                                @php
                                    $waNumber = preg_replace('/[^0-9]/', '', $tunggak->phone_1);
                                    if (substr($waNumber, 0, 1) === '0') $waNumber = '62' . substr($waNumber, 1);
                                    $waPesan = "Halo Kak " . $tunggak->name . ", kami dari admin ConnectMe menginformasikan bahwa tagihan internet bulan ini belum terbayarkan...";
                                @endphp
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="py-4">
                                        <p class="font-extrabold text-slate-900 dark:text-white">{{ $tunggak->name }}</p>
                                        <p class="text-xs text-slate-500 font-medium mt-0.5">Unit: {{ substr($tunggak->tower ?? '', 0, 1) }}/{{ $tunggak->floor }}/{{ $tunggak->unit }}</p>
                                    </td>
                                    <td class="py-4 text-right">
                                        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waPesan) }}" target="_blank" class="text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 hover:text-green-600 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-1.5 rounded-lg transition-colors">
                                            Chat WA
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-12 text-center text-slate-400 text-sm font-medium">
                                        Belum ada history hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- KUMPULAN JAVASCRIPT: THEME & SLIDER -->
    <script>
        // 1. LOGIKA THEME TOGGLE (DARK/LIGHT MODE)
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Cek LocalStorage atau Preferensi Sistem
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            lightIcon.classList.remove('hidden');
            darkIcon.classList.add('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        }

        // Event Klik Tombol Bulan/Matahari
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

        // 2. LOGIKA SLIDER STOK GUDANG
        let currentSlide = 0;
        const totalSlides = 2; // Router dan Kabel
        const slider = document.getElementById('stock-slider');
        const sliderTitle = document.getElementById('slider-title');

        function slideStock(direction) {
            if (direction === 'right') {
                currentSlide = (currentSlide + 1) % totalSlides;
            } else {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            }
            
            // Geser elemen berdasarkan currentSlide (0 = 0%, 1 = -50% dari width 200%)
            slider.style.transform = `translateX(-${currentSlide * 50}%)`;

            // Ganti Judul
            if (currentSlide === 0) {
                sliderTitle.innerText = "Stok Router";
            } else {
                sliderTitle.innerText = "Kabel & Aksesoris";
            }
        }
    </script>
</body>
</html>