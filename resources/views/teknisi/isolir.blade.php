<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi & Isolir | Engineer OSS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] }, colors: { brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 900: '#1e3a8a' } } } }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; } ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; } .dark ::-webkit-scrollbar-thumb { background: #334155; }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; } @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        #nav-indicator { left: 0; transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); will-change: transform, width; }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- NAVBAR -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-brand-600 rounded-full shadow-md z-0"></div>
                <a href="{{ route('teknisi.dashboard') }}" class="nav-link relative z-10 px-5 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">Dashboard</a>
                <a href="{{ route('teknisi.inventory') }}" class="nav-link relative z-10 px-5 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">Inventory</a>
                <a href="{{ route('teknisi.ticket') }}" class="nav-link relative z-10 px-5 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">Ticket</a>
                <a href="{{ route('teknisi.isolir') }}" class="nav-link relative z-10 px-4 py-2 text-sm font-bold text-white transition-colors active-link">Aktivasi & Isolir</a>
                <a href="{{ route('teknisi.instalasi') }}" class="nav-link relative z-10 px-5 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">Instalasi Baru</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors focus:outline-none">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
            </button>
            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                @csrf
                <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 font-extrabold flex items-center justify-center uppercase">{{ substr(Auth::user()->name ?? 'TE', 0, 2) }}</div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name ?? 'Teknisi' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Engineer</p>
                </div>
                <!-- Tombol Logout yang ditambahkan -->
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8 max-w-[1400px] mx-auto w-full animate-fade-in opacity-0" id="main-content">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-amber-100 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Tugas Jaringan & Perangkat</h2>
                </div>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium ml-12">Daftar client yang harus di-remote (disable/enable PPPoE).</p>
            </div>
            
            @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl mb-4 w-full md:w-auto" role="alert">
                <span class="block sm:inline font-bold">{{ session('success') }}</span>
            </div>
            @endif

            <div class="relative w-full md:w-80 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" placeholder="Cari unit atau client..." class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-sm font-bold focus:ring-2 focus:ring-amber-500 outline-none transition-all shadow-sm">
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-wider font-extrabold border-b border-slate-100 dark:border-slate-800">
                        <tr>
                            <th class="p-6 pl-6 w-48">ID Tugas & Jadwal</th>
                            <th class="p-6 w-56">Lokasi & Client</th>
                            <th class="p-6 w-48">Jenis Tugas</th>
                            <th class="p-6">Tindakan Teknis (SOP)</th>
                            <th class="p-6 text-right pr-6 w-40">Status & Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        
                        @forelse($tasks ?? [] as $task)
                        <!-- Jika tugas sedang diproses oleh teknisi lain, beri efek redup pada barisnya -->
                        <tr class="transition-colors {{ ($task->status == 'on_progress' && $task->technician_id != Auth::id()) ? 'bg-slate-50 dark:bg-slate-800/20 opacity-60' : 'hover:bg-slate-50/50 dark:hover:bg-slate-800/50' }}">
                            <td class="p-6 pl-6">
                                <p class="font-bold text-slate-800 dark:text-slate-200 text-sm font-mono">#TSK-{{ \Carbon\Carbon::parse($task->created_at)->format('ym') }}-{{ str_pad($task->id, 3, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-[10px] font-bold text-slate-500 mt-1">{{ \Carbon\Carbon::parse($task->created_at)->diffForHumans() }}</p>
                            </td>
                            
                            <td class="p-6">
                                <p class="font-mono text-[11px] font-black text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-2 py-0.5 rounded w-max mb-1">
                                    {{ substr($task->customer->tower ?? '-', 0, 1) }}/{{ $task->customer->floor ?? '-' }}/{{ $task->customer->unit ?? '-' }}
                                </p>
                                <p class="font-bold text-slate-600 dark:text-slate-400 text-xs">{{ $task->customer->name ?? 'Unknown Client' }}</p>
                            </td>
                            
                            <td class="p-6">
                                @if($task->task_type == 'isolir')
                                    <span class="inline-block px-2.5 py-1 bg-red-100 dark:bg-red-500/20 text-red-700 dark:text-red-400 text-[10px] font-black uppercase rounded">Menunggak / Isolir</span>
                                @elseif($task->task_type == 'buka_isolir')
                                    <span class="inline-block px-2.5 py-1 bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-400 text-[10px] font-black uppercase rounded">Lunas / Aktivasi</span>
                                @elseif($task->task_type == 'terminasi')
                                    <span class="inline-block px-2.5 py-1 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-[10px] font-black uppercase rounded">Terminasi (Cabut)</span>
                                @endif
                            </td>
                            
                            <td class="p-6">
                                @if($task->task_type == 'isolir')
                                    <p class="font-black text-slate-800 dark:text-slate-200">ISOLIR (Remote WinBox)</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">1. Buka MikroTik WinBox<br>2. Disable Secret PPPoE atas nama client ini, ATAU<br>3. Masukkan IP client ke Address List.</p>
                                @elseif($task->task_type == 'buka_isolir')
                                    <p class="font-black text-slate-800 dark:text-slate-200">AKTIVASI (Remote WinBox)</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">1. Buka MikroTik WinBox<br>2. Enable kembali Secret PPPoE client, ATAU<br>3. Hapus IP client dari Address List.</p>
                                @elseif($task->task_type == 'terminasi')
                                    <p class="font-black text-slate-800 dark:text-slate-200">BONGKAR PERANGKAT (Visit Lokasi)</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kunjungan fisik: Cabut kabel UTP di unit client dan tarik perangkat Router (SN: <span class="font-mono text-amber-600 font-bold">{{ $task->customer->router_sn ?? 'Tanpa Router' }}</span>) untuk dikembalikan ke Gudang Inventory.</p>
                                @endif
                            </td>
                            
                            <td class="p-6 text-right pr-6">
                                <form action="{{ route('teknisi.execute') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    
                                    @if($task->status == 'on_progress')
                                        <!-- CEK: Apakah ini tugas yang dikerjakan oleh saya (Teknisi Login)? -->
                                        @if($task->technician_id == Auth::id())
                                            <input type="hidden" name="action" value="complete">
                                            <div class="flex flex-col items-end gap-2">
                                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-brand-50 dark:bg-brand-500/20 text-brand-600 dark:text-brand-400 text-[10px] font-black uppercase rounded animate-pulse">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> Sedang Dikerjakan
                                                </span>
                                                <button type="submit" onclick="return confirm('Yakin sudah selesai disetting di WinBox/Lapangan?');" class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-green-500/30 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> 
                                                    Selesaikan Tugas
                                                </button>
                                            </div>
                                        @else
                                            <!-- Jika dikerjakan teknisi lain, tombol hilang / dilock -->
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs font-bold rounded">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                Diproses Teknisi Lain
                                            </span>
                                        @endif

                                    @else
                                        <!-- JIKA STATUS MASIH PENDING (Belum ada yang ambil) -->
                                        <input type="hidden" name="action" value="start">
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-brand-500/30 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Mulai Kerjakan
                                        </button>
                                    @endif

                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-16 text-center">
                                <div class="flex flex-col items-center justify-center animate-fade-in">
                                    <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mb-4 text-slate-400">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="text-xl font-extrabold text-slate-700 dark:text-slate-300">Antrean Bersih! ✨</h3>
                                    <p class="text-sm text-slate-500 font-medium mt-2">Tidak ada client yang perlu di-isolir atau ditarik routernya saat ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // Animasi Indikator Menu
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
            if(activeLink) { moveIndicatorTo(activeLink); }
            document.getElementById('main-content').classList.remove('opacity-0');
        });
        window.addEventListener('resize', () => {
            const activeLink = document.querySelector('.nav-link.active-link');
            if(activeLink) moveIndicatorTo(activeLink);
        });

        // Theme Toggle
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