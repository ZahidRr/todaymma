<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Troubleshoot | ConnectMe OSS</title>
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
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
        
        #nav-indicator { left: 0; will-change: transform, width; }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300 overflow-x-hidden">

    <!-- NAVBAR SALES -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-slate-900 dark:bg-white rounded-full flex items-center justify-center text-white dark:text-slate-900 font-bold text-lg shadow-md">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700 transition-colors">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-white rounded-full shadow-md z-0 transition-all duration-300"></div>
                <a href="{{ route('sales.dashboard') }}" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('sales.dashboard') ? 'active-link font-bold text-white dark:text-slate-900' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Dashboard</a>
                <a href="{{ route('sales.clients.index') }}" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('sales.clients.index') ? 'active-link font-bold text-white dark:text-slate-900' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Daftar Client</a>
                <a href="{{ route('sales.ticket') }}" class="nav-link active-link relative z-10 px-5 py-2 text-sm font-bold text-white dark:text-slate-900 transition-colors duration-300">Ticket Troubleshoot</a>
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
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name ?? 'Sales Team' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Account Executive</p>
                </div>
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <main id="main-content" class="flex-1 p-8 max-w-[1600px] mx-auto w-full animate-fade-in opacity-0">
        
        <!-- Alerts -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 dark:border-green-900 dark:bg-green-500/10 p-4 rounded-2xl flex items-center gap-3 text-green-700 dark:text-green-400 font-bold text-sm shadow-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM BUAT TIKET -->
        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors mb-10">
            <div class="p-8 border-b border-slate-100 dark:border-slate-800 bg-red-50/50 dark:bg-red-900/10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Buat Tiket Gangguan</h2>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 font-medium text-sm ml-11">Teruskan keluhan pelanggan langsung ke antrean tugas (Tasks) Teknisi.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('sales.ticket.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Informasi Pelapor (Client)</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Pilih Client Anda</label>
                                <!-- Diubah jadi Dropdown agar tidak typo dan terkoneksi ke Database -->
                                <select name="customer_id" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-red-500 transition-shadow cursor-pointer appearance-none">
                                    <option value="" disabled selected>-- Cari dan Pilih Client --</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }} (Unit: {{ substr($client->tower, 0, 1) }}/{{ $client->floor }}/{{ $client->unit }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Upload Foto (Opsional)</label>
                                <!-- File Upload Foto -->
                                <input type="file" name="attachment" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-sm rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-red-500 transition-shadow file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-600 hover:file:bg-red-100 dark:file:bg-red-900/20 dark:file:text-red-400">
                                <p class="text-[10px] text-slate-400 mt-1.5">*Maksimal 2MB. Bisa diisi foto indikator lampu Router yang merah/mati.</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Detail Kendala</h3>
                        <div class="space-y-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kategori Gangguan</label>
                                    <select name="category" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-red-500 transition-shadow cursor-pointer appearance-none">
                                        <option value="" disabled selected>Pilih kendala...</option>
                                        <option value="LOS Merah">Internet Mati Total (LOS Merah)</option>
                                        <option value="Lambat">Koneksi Sangat Lambat / Putus</option>
                                        <option value="Router Blank">Router Error / Blank</option>
                                        <option value="Lupa Password">Lupa Password / Setting WiFi</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tingkat Prioritas</label>
                                    <select name="priority" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-red-500 transition-shadow cursor-pointer appearance-none">
                                        <option value="Normal">Normal</option>
                                        <option value="High" class="text-amber-600 font-bold">Tinggi (Urgent)</option>
                                        <option value="Darurat" class="text-red-600 font-bold">Darurat (Mati massal)</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Deskripsi Keluhan</label>
                                <textarea name="description" rows="2" required placeholder="Tulis keluhan spesifik di sini..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-red-500 transition-shadow resize-none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 border-t border-slate-100 dark:border-slate-800 pt-6">
                    <button type="submit" class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg shadow-red-500/30 transition-all hover:-translate-y-0.5 focus:ring-4 focus:ring-red-500/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Kirim Tiket ke Teknisi
                    </button>
                </div>
            </form>
        </div>

        <!-- TABEL HISTORY -->
        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-8 border-b border-slate-100 dark:border-slate-800">
                <div>
                    <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">Status & Riwayat Tiket Anda</h3>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mt-1">Pantau progres perbaikan yang sedang dikerjakan oleh tim Teknisi.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/20 text-slate-400 dark:text-slate-500 text-[11px] uppercase tracking-wider font-extrabold border-b border-slate-100 dark:border-slate-800">
                            <th class="py-4 px-6">ID Tiket / Waktu</th>
                            <th class="py-4 px-6">Pelapor & Unit</th>
                            <th class="py-4 px-6">Kategori Kendala</th>
                            <th class="py-4 px-6">Teknisi Bertugas</th>
                            <th class="py-4 px-6 text-right">Status Penanganan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        
                        @forelse($tickets ?? [] as $ticket)
                            @php
                                $isDarurat = str_contains(strtolower($ticket->notes), 'darurat');
                                $unitFormat = substr($ticket->customer->tower ?? '-', 0, 1) . '/' . ($ticket->customer->floor ?? '-') . '/' . ($ticket->customer->unit ?? '-');
                                $techName = $ticket->technician->name ?? 'Belum Ada';
                                $techInitial = strtoupper(substr($techName, 0, 2));
                            @endphp

                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors {{ $isDarurat && $ticket->status == 'pending' ? 'bg-red-50/20 dark:bg-red-900/10' : '' }}">
                                <td class="p-6 {{ $isDarurat && $ticket->status == 'pending' ? 'border-l-4 border-red-500' : '' }}">
                                    <p class="font-bold text-slate-800 dark:text-slate-200 text-sm font-mono">#TK-{{ \Carbon\Carbon::parse($ticket->created_at)->format('ymd') }}-{{ str_pad($ticket->id, 2, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-[10px] font-bold text-slate-500 mt-1">{{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y, H:i') }}</p>
                                </td>
                                
                                <td class="p-6">
                                    <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">{{ $ticket->customer->name }}</p>
                                    <p class="font-mono text-[10px] font-black text-slate-500 mt-1 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded w-max">{{ $unitFormat }}</p>
                                </td>
                                
                                <td class="p-6">
                                    <p class="font-bold text-slate-700 dark:text-slate-300 line-clamp-1">{{ $ticket->notes }}</p>
                                    @if($ticket->attachment)
                                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="inline-flex items-center gap-1 mt-1 text-[10px] font-bold text-blue-600 hover:underline">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg> Lihat Foto
                                        </a>
                                    @endif
                                </td>
                                
                                <td class="p-6">
                                    @if($ticket->status == 'pending')
                                        <span class="text-xs font-semibold text-slate-400 italic">Belum diambil</span>
                                    @else
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center font-bold text-[10px]">{{ $techInitial }}</div>
                                            <p class="font-bold text-sm text-slate-700 dark:text-slate-300">{{ $techName }}</p>
                                        </div>
                                    @endif
                                </td>
                                
                                <td class="p-6 text-right">
                                    @if($ticket->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 bg-amber-50 dark:bg-amber-500/10 text-amber-600 border border-amber-200 dark:border-amber-900/50 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                            <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menunggu
                                        </span>
                                    @elseif($ticket->status == 'on_progress')
                                        <span class="inline-flex items-center gap-1.5 bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400 border border-brand-200 dark:border-brand-800 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                            <svg class="w-3 h-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Diproses
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 dark:bg-green-500/10 text-green-600 border border-green-200 dark:border-green-900/50 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-slate-400 text-sm font-medium">Belum ada riwayat tiket yang Anda buat.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // Animasi Menu Pil & Theme Toggle
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
                setTimeout(() => { indicator.style.transition = 'transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)'; }, 50);
            }
            document.getElementById('main-content').classList.remove('opacity-0');
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