<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pembayaran | Admin ConnectMe</title>
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
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- NAVBAR (Menu Verifikasi yang menyala / Active) -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200/80 dark:border-slate-800 shadow-sm transition-colors duration-300">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg">+</div>
                <h1 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div class="hidden md:flex items-center bg-slate-50 dark:bg-slate-800 p-1 rounded-full border border-slate-200/60 dark:border-slate-700">
                <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Dashboard</a>
                
                <!-- MENU VERIFIKASI SEKARANG MENYALA -->
                <a href="{{ route('admin.verifikasi') }}" class="px-6 py-2 text-sm font-bold bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 rounded-full shadow-md transition-all">Verifikasi Tagihan</a>
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
    <main class="flex-1 p-8 max-w-[1200px] mx-auto w-full animate-fade-in">
        
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 dark:border-green-900 dark:bg-green-500/10 p-4 rounded-2xl flex items-center gap-3 text-green-700 dark:text-green-400 font-bold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
            <div>
                <h2 class="text-[32px] font-black text-slate-900 dark:text-white tracking-tight">Verifikasi Pembayaran 💳</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1.5 font-medium">Validasi struk yang masuk sebelum tugas dilempar ke tim Teknisi.</p>
            </div>
            
            <!-- Badge Hitung jumlah antrean -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-5 py-2.5 rounded-xl flex items-center gap-3 shadow-sm transition-colors">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500 animate-pulse"></span>
                <span class="text-sm font-bold text-slate-600 dark:text-slate-300">{{ $butuhVerifikasi->count() }} Antrean Aktif</span>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-soft border border-slate-100 dark:border-slate-800 p-8 transition-colors">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                            <th class="pb-4 font-bold pl-2">NAMA CLIENT</th>
                            <th class="pb-4 font-bold">PAKET / KETERANGAN</th>
                            <th class="pb-4 font-bold">NOMINAL</th>
                            <th class="pb-4 font-bold text-right pr-2">AKSI VALIDASI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800 text-sm">
                        @forelse($butuhVerifikasi ?? [] as $inv)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="py-5 pl-2">
                                    <p class="font-extrabold text-slate-900 dark:text-white text-base">{{ $inv->customer->name ?? 'Unknown' }}</p>
                                    <p class="text-[11px] font-mono text-slate-500 mt-1 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded w-max">
                                        {{ substr($inv->customer->tower ?? '', 0, 1) }}/{{ $inv->customer->floor ?? '' }}/{{ $inv->customer->unit ?? '' }}
                                    </p>
                                </td>
                                <td class="py-5">
                                    <p class="font-bold text-slate-700 dark:text-slate-300">{{ $inv->billing_period }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">{{ \Carbon\Carbon::parse($inv->updated_at)->diffForHumans() }}</p>
                                </td>
                                <td class="py-5">
                                    <p class="font-black text-slate-900 dark:text-white text-base">Rp{{ number_format($inv->amount, 0, ',', '.') }}</p>
                                </td>
                                <td class="py-5 text-right flex items-center justify-end gap-3 pr-2">
                                    <!-- Tombol Buka Struk di Tab Baru -->
                                    <a href="{{ asset('storage/' . $inv->payment_proof) }}" target="_blank" class="text-xs font-bold text-purple-600 bg-purple-50 hover:bg-purple-100 dark:text-purple-400 dark:bg-purple-900/20 dark:hover:bg-purple-900/40 px-4 py-2.5 rounded-lg transition-colors flex items-center gap-1.5 border border-purple-100 dark:border-purple-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Buka Struk
                                    </a>
                                    
                                    <!-- Form Validasi Eksekusi -->
                                    <form action="{{ route('admin.invoices.approve', $inv->id) }}" method="POST" onsubmit="return confirm('Yakin dana sudah terkonfirmasi masuk mutasi rekening perusahaan?');">
                                        @csrf
                                        <button type="submit" class="text-xs font-bold text-white bg-slate-900 dark:bg-brand-600 hover:bg-brand-600 dark:hover:bg-brand-500 px-5 py-2.5 rounded-lg transition-colors flex items-center gap-1.5 shadow-md shadow-brand-500/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            Validasi Lunas
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-16 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-800 mb-4">
                                        <svg class="w-8 h-8 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <p class="text-slate-500 dark:text-slate-400 text-sm font-bold">Antrean Kosong.</p>
                                    <p class="text-slate-400 dark:text-slate-500 text-xs mt-1">Belum ada struk baru yang diunggah oleh tim Sales.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
        // LOGIKA THEME TOGGLE (DARK/LIGHT MODE)
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
    </script>
</body>
</html>