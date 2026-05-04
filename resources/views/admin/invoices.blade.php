<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Client | Admin ConnectMe</title>
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
        /* Animasi indikator menu */
        #nav-indicator { left: 0; will-change: transform, width; }
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

            <!-- Menu Pil dengan Kapsul Animasi -->
            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-50 dark:bg-slate-800 p-1 rounded-full border border-slate-200/60 dark:border-slate-700 transition-colors">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-white rounded-full shadow-md z-0 transition-all duration-300"></div>
                
                <a href="{{ route('admin.dashboard') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all duration-300">Dashboard</a>
                <a href="{{ route('admin.verifikasi') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all duration-300">Verifikasi Tagihan</a>
                <a href="{{ route('admin.clients') }}" class="px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all">Database Client</a>
                
                <!-- MENU INVOICE ACTIVE -->
                <a href="{{ route('admin.invoices') }}" class="nav-link active-link relative z-10 px-6 py-2 text-sm font-bold text-white dark:text-slate-900 transition-colors duration-300">Invoice</a>
                <a href="{{ route('admin.inventory') }}" class="nav-link relative z-10 px-6 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-all duration-300">Inventory</a>
            </div>
        </div>

        <div class="flex items-center gap-5">
            <!-- Theme Toggle -->
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
        
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 dark:border-green-900 dark:bg-green-500/10 p-4 rounded-2xl flex items-center gap-3 text-green-700 dark:text-green-400 font-bold text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
            <div>
                <h2 class="text-[32px] font-black text-slate-900 dark:text-white tracking-tight">Data Invoice 📑</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1.5 font-medium">Riwayat seluruh tagihan client. Anda dapat mengunduh ulang PDF dari sini.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-soft border border-slate-100 dark:border-slate-800 p-8 transition-colors">
            
            <!-- Pencarian (UI Saja) -->
            <div class="mb-6 flex gap-3">
                <input type="text" placeholder="Cari nama client atau unit..." class="w-full md:w-1/3 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                <button class="bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-5 py-2.5 rounded-xl text-sm font-bold shadow-md hover:bg-slate-800 transition-colors">Cari</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <!-- Header 7 Kolom -->
                        <tr class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                            <th class="pb-4 pl-2">NO. INVOICE</th>
                            <th class="pb-4">NAMA CLIENT</th>
                            <th class="pb-4">KONTAK</th>
                            <th class="pb-4">KETERANGAN</th>
                            <th class="pb-4">STATUS</th>
                            <th class="pb-4">NOMINAL</th>
                            <th class="pb-4 text-right pr-2">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800 text-sm">
                        @forelse($invoices ?? [] as $inv)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <!-- KOLOM 1: No Invoice -->
                                <td class="py-5 pl-2">
                                    <p class="font-mono font-bold text-slate-600 dark:text-slate-400 text-xs">
                                        #{{ \Carbon\Carbon::parse($inv->created_at)->format('ym') }}{{ str_pad($inv->id, 5, '0', STR_PAD_LEFT) }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">{{ \Carbon\Carbon::parse($inv->created_at)->format('d M Y') }}</p>
                                </td>

                                <!-- KOLOM 2: Nama Client -->
                                <td class="py-5">
                                    <p class="font-extrabold text-slate-900 dark:text-white">{{ $inv->customer->name ?? 'Unknown' }}</p>
                                    <p class="text-xs text-slate-500 font-medium mt-0.5">Unit: {{ substr($inv->customer->tower ?? '', 0, 1) }}/{{ $inv->customer->floor ?? '' }}/{{ $inv->customer->unit ?? '' }}</p>
                                </td>

                                <!-- KOLOM 3: Kontak WhatsApp -->
                                <td class="py-5">
                                    @php
                                        $waNumber = preg_replace('/[^0-9]/', '', $inv->customer->phone_1 ?? '');
                                        if (substr($waNumber, 0, 1) === '0') $waNumber = '62' . substr($waNumber, 1);
                                        
                                        // Auto-generate teks penagihan
                                        $pesanWA = "Halo Kak " . ($inv->customer->name ?? 'Pelanggan') . ",\n\nIni dari Admin *ConnectMe*. Menginformasikan bahwa tagihan internet Anda untuk *" . $inv->billing_period . "* sebesar *Rp" . number_format($inv->amount, 0, ',', '.') . "* sudah terbit.\n\nMohon bantuannya untuk melakukan pembayaran ya Kak. Jangan lupa sertakan bukti transfernya. Terima kasih! 🌻";
                                    @endphp
                                    
                                    @if(!empty($inv->customer->phone_1))
                                        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($pesanWA) }}" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 rounded-md hover:bg-green-100 dark:hover:bg-green-500/20 transition-colors w-max border border-green-100 dark:border-green-800" title="Kirim Tagihan via WA">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                                            </svg>
                                            <span class="text-[11px] font-mono font-bold tracking-tight">{{ $inv->customer->phone_1 }}</span>
                                        </a>
                                    @else
                                        <span class="text-[10px] text-slate-400 italic">Tidak ada No HP</span>
                                    @endif
                                </td>

                                <!-- KOLOM 4: Keterangan / Periode -->
                                <td class="py-5">
                                    <p class="font-bold text-slate-700 dark:text-slate-300 text-xs">{{ $inv->billing_period }}</p>
                                </td>

                                <!-- KOLOM 5: Status Badge -->
                                <td class="py-5">
                                    @if($inv->status == 'lunas')
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Lunas
                                        </span>
                                    @elseif($inv->status == 'menunggu_verifikasi')
                                        <span class="inline-flex items-center gap-1.5 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Verifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Belum Bayar
                                        </span>
                                    @endif
                                </td>

                                <!-- KOLOM 6: Nominal Rupiah -->
                                <td class="py-5">
                                    <p class="font-black text-slate-900 dark:text-white">Rp{{ number_format($inv->amount, 0, ',', '.') }}</p>
                                </td>

                                <!-- KOLOM 7: Tombol Download & Lihat Bukti -->
                                <td class="py-5 text-right pr-2">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Tombol Lihat Bukti (Hanya muncul jika payment_proof tidak kosong) -->
                                        @if($inv->payment_proof)
                                            <a href="{{ asset('storage/' . $inv->payment_proof) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-purple-600 bg-purple-50 hover:bg-purple-100 dark:text-purple-400 dark:bg-purple-900/20 dark:hover:bg-purple-900/40 px-3 py-2 rounded-lg transition-colors border border-purple-100 dark:border-purple-800" title="Lihat Bukti Transfer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Bukti
                                            </a>
                                        @endif
                                        
                                        <!-- Tombol Download PDF Lama -->
                                        <a href="{{ route('admin.invoices.download', $inv->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-slate-900 dark:bg-brand-600 hover:bg-brand-600 dark:hover:bg-brand-500 px-4 py-2 rounded-lg transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Tabel Kosong: Colspan 7 -->
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400 text-sm font-medium">Belum ada data tagihan di database.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- FULL JAVASCRIPT: THEME & MICRO-ANIMATION -->
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

        // 2. MICRO-ANIMATION MENU KAPSUL MELUNCUR
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