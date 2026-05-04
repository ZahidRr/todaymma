<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineer Dashboard | ConnectMe OSS</title>
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
                    boxShadow: { 
                        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
                        'glow': '0 0 15px -2px rgba(37, 99, 235, 0.3)' 
                    }
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
        
        #nav-indicator {
            left: 0;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            will-change: transform, width;
        }

        .stat-card { transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease; }
        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-50 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md shadow-brand-500/30">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700 transition-colors">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-brand-600 rounded-full shadow-md z-0"></div>
                
                <a href="{{ route('teknisi.dashboard') }}" id="link-dashboard" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.dashboard') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium' }}">Dashboard</a>
                <a href="{{ route('teknisi.inventory') }}" id="link-inventory" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.inventory') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium' }}">Inventory</a>
                <a href="{{ route('teknisi.ticket') }}" id="link-ticket" class="nav-link relative z-10 px-5 py-2 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-sm font-medium transition-colors duration-300">Ticket</a>
                <a href="{{ route('teknisi.isolir') }}" class="nav-link relative z-10 px-4 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.isolir') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Aktivasi & Isolir</a>
                <a href="{{ route('teknisi.instalasi') }}" id="link-instalasi" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.instalasi') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Instalasi Baru</a>            </div>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors focus:outline-none">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>

            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                @csrf
                <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 font-extrabold flex items-center justify-center uppercase">
                    {{ substr($user->name, 0, 2) }}
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ $user->name }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Engineer</p>
                </div>
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-1 p-8 max-w-[1600px] mx-auto w-full">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Welcome back, {{ explode(' ', $user->name)[0] }}! ☀️</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Berikut ini adalah ringkasan operasional jaringan MMA hari ini.</p>
            </div>
            <div class="hidden sm:flex gap-3">
                <button class="flex items-center gap-2 bg-white dark:bg-slate-800 px-4 py-2 rounded-full border border-slate-200 dark:border-slate-700 text-sm font-semibold text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-50 transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Hari Ini
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div onclick="navigateTo('link-instalasi', '#')" class="stat-card cursor-pointer bg-white dark:bg-slate-900 rounded-[24px] p-6 shadow-card border border-slate-200 dark:border-slate-800 flex flex-col justify-between transition-colors relative group">
                <div class="absolute inset-0 bg-purple-500/0 group-hover:bg-purple-500/5 rounded-[24px] transition-colors"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-purple-50 dark:bg-purple-500/10 rounded-full"><svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        <h3 class="font-semibold text-slate-700 dark:text-slate-300">Instalasi Baru</h3>
                    </div>
                </div>
                <div class="flex items-end justify-between relative z-10">
                    <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $tugasInstalasi->count() }}</span>
                    <span class="text-sm font-bold text-purple-600 dark:text-purple-400 mb-1 bg-purple-50 dark:bg-purple-500/10 px-2 py-0.5 rounded-md flex items-center gap-1">Masuk <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></span>
                </div>
            </div>

            <div onclick="navigateTo('link-dashboard', '{{ route('teknisi.dashboard') }}')" class="stat-card cursor-pointer bg-white dark:bg-slate-900 rounded-[24px] p-6 shadow-card border border-slate-200 dark:border-slate-800 flex flex-col justify-between transition-colors relative group">
                <div class="absolute inset-0 bg-cyan-500/0 group-hover:bg-cyan-500/5 rounded-[24px] transition-colors"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-cyan-50 dark:bg-cyan-500/10 rounded-full"><svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg></div>
                        <h3 class="font-semibold text-slate-700 dark:text-slate-300">Enable & Disable</h3>
                    </div>
                </div>
                <div class="flex items-end justify-between relative z-10">
                    <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $tugasIsolir->count() }}</span>
                    <span class="text-sm font-bold text-cyan-600 dark:text-cyan-400 mb-1">Tugas</span>
                </div>
            </div>

            <div onclick="navigateTo('link-inventory', '{{ route('teknisi.inventory') }}')" class="stat-card cursor-pointer bg-white dark:bg-slate-900 rounded-[24px] p-0 shadow-card border border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden relative group transition-colors">
                <div class="absolute inset-0 bg-brand-500/0 group-hover:bg-brand-500/5 rounded-[24px] transition-colors z-0"></div>
                
                <div id="inv-carousel" class="flex w-[200%] h-full transition-transform duration-500 ease-in-out relative z-10">
                    <div class="w-1/2 p-6 flex flex-col justify-between h-full">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-2">
                                <div class="p-2 bg-brand-50 dark:bg-brand-500/10 rounded-full text-brand-600 dark:text-brand-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg></div>
                                <h3 class="font-semibold text-slate-700 dark:text-slate-300">Stok Router</h3>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <span class="text-5xl font-extrabold text-slate-900 dark:text-white tracking-tighter">
                                {{ $inventories->filter(fn($item) => stripos($item->item_name, 'Router') !== false)->sum('stock_quantity') }}
                            </span>
                            <span class="text-sm font-bold text-brand-600 dark:text-brand-400 mb-1">Unit</span>
                        </div>
                    </div>

                    <div class="w-1/2 p-6 flex flex-col justify-between h-full">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-2">
                                <div class="p-2 bg-brand-50 dark:bg-brand-500/10 rounded-full text-brand-600 dark:text-brand-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg></div>
                                <h3 class="font-semibold text-slate-700 dark:text-slate-300">Stok Kabel</h3>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <span class="text-5xl font-extrabold text-slate-900 dark:text-white tracking-tighter">
                                {{ $inventories->filter(fn($item) => stripos($item->item_name, 'Kabel') !== false)->sum('stock_quantity') }}
                            </span>
                            <span class="text-sm font-bold text-brand-600 dark:text-brand-400 mb-1">Meter</span>
                        </div>
                    </div>
                </div>

                <div class="absolute right-4 top-5 flex gap-1 z-20">
                    <button onclick="event.stopPropagation(); slideInv(0)" class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-400 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button onclick="event.stopPropagation(); slideInv(1)" class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-400 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <div onclick="navigateTo('link-ticket', '#')" class="stat-card cursor-pointer bg-white dark:bg-slate-900 rounded-[24px] p-6 shadow-card border border-slate-200 dark:border-slate-800 flex flex-col justify-between transition-colors relative group">
                <div class="absolute inset-0 bg-red-500/0 group-hover:bg-red-500/5 rounded-[24px] transition-colors"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-red-50 dark:bg-red-500/10 rounded-full"><svg class="w-5 h-5 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
                        <h3 class="font-semibold text-slate-700 dark:text-slate-300">Ticket Troubleshoot</h3>
                    </div>
                </div>
                <div class="flex items-end justify-between relative z-10">
                    <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $tiketGangguan->count() }}</span>
                    <span class="text-sm font-bold text-red-500 dark:text-red-400 mb-1 bg-red-50 dark:bg-red-500/10 px-2 py-0.5 rounded-md flex items-center gap-1">Masuk <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 p-8 transition-colors">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Antrian Tugas Aktif</h3>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 dark:text-slate-500 text-[11px] uppercase tracking-wider font-extrabold border-b border-slate-100 dark:border-slate-800">
                                <th class="pb-3 pl-2">Nama Client</th>
                                <th class="pb-3">Tipe Pekerjaan</th>
                                <th class="pb-3">Format Lokasi</th>
                                <th class="pb-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @php
                                $allPendingTasks = $tugasInstalasi->concat($tugasIsolir)->concat($tiketGangguan);
                            @endphp

                            @forelse($allPendingTasks as $task)
                            <tr class="border-b border-slate-50 dark:border-slate-800/50 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                <td class="py-4 pl-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center font-bold text-xs uppercase">
                                            {{ substr($task->customer->name, 0, 2) }}
                                        </div>
                                        <p class="font-bold text-slate-800 dark:text-slate-200">{{ $task->customer->name }}</p>
                                    </div>
                                </td>
                                <td class="py-4 font-semibold text-slate-600 dark:text-slate-400">
                                    @php
                                        $type = ucwords(str_replace('_', ' ', $task->task_type));
                                        if($task->task_type == 'isolir' || $task->task_type == 'buka_isolir') $type = 'Enable / Disable';
                                        elseif($task->task_type == 'troubleshoot') $type = 'Troubleshoot';
                                    @endphp
                                    {{ $type }}
                                </td>
                                <td class="py-4">
                                    <span class="font-mono font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-md border border-slate-200 dark:border-slate-700">
                                        {{ strtoupper(substr($task->customer->tower, 0, 1)) }}/{{ preg_replace('/[^0-9]/', '', $task->customer->room_number) }}/{{ strtoupper(substr($task->customer->tower, 0, 2)) }}
                                    </span>
                                </td>
                                <td class="py-4 text-right pr-2">
                                    <button onclick="openModal('{{ $task->id }}', '{{ $task->customer->name }}', '{{ $task->task_type }}')" class="bg-brand-50 dark:bg-brand-500/20 text-brand-600 dark:text-brand-300 hover:bg-brand-600 hover:text-white dark:hover:bg-brand-500 dark:hover:text-white px-4 py-2 rounded-full text-xs font-bold transition-all border border-brand-100 dark:border-brand-500/30">
                                        Eksekusi
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="py-8 text-center text-slate-400 font-medium">Belum ada antrian. Jaringan aman!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 p-8 flex flex-col h-full transition-colors">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">History Pengerjaan</h3>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto space-y-3 pr-2">
                    @forelse($riwayatTugas ?? [] as $history)
                    <div class="flex gap-4 items-center p-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-2xl transition-colors border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                        <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0 border border-slate-200 dark:border-slate-700">
                            <svg class="w-5 h-5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ $history->customer->name }}</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 font-bold uppercase">
                                @php
                                    $hType = str_replace('_', ' ', $history->task_type);
                                    if($history->task_type == 'isolir' || $history->task_type == 'buka_isolir') $hType = 'Enable / Disable';
                                    if($history->task_type == 'troubleshoot') $hType = 'Troubleshoot';
                                @endphp
                                {{ $hType }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="font-mono font-bold text-slate-600 dark:text-slate-300 text-xs">
                                {{ strtoupper(substr($history->customer->tower, 0, 1)) }}/{{ preg_replace('/[^0-9]/', '', $history->customer->room_number) }}/{{ strtoupper(substr($history->customer->tower, 0, 2)) }}
                            </p>
                            <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 mt-1">{{ $history->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="h-full flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                        <p class="text-sm font-medium">Belum ada history hari ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    @if(session('success'))
    <div id="success-alert" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-xl z-50 animate-bounce flex items-center gap-3">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <p class="font-bold text-sm">{{ session('success') }}</p>
    </div>
    <script>setTimeout(() => { const el = document.getElementById('success-alert'); if(el) el.remove(); }, 3000);</script>
    @endif

    <div id="executionModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="bg-white dark:bg-slate-900 w-full max-w-md rounded-[32px] p-8 shadow-2xl z-10 border border-slate-200 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="modalCard">
            <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-1">Konfirmasi Eksekusi</h3>
            <p class="text-sm text-slate-500 mb-6" id="modal-client-name">Selesaikan tugas client ini?</p>
            
            <form method="POST" action="{{ route('teknisi.execute') }}">
                @csrf
                <input type="hidden" name="task_id" id="modal-task-id">
                
                <div id="cable-section" class="mb-6 hidden space-y-4">
                    <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Pemakaian Kabel (Meter)</label>
                        <input type="number" name="kabel_terpakai" placeholder="Contoh: 150" class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-brand-500 outline-none text-slate-800 dark:text-white">
                    </div>

                    <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Serial Number (SN) Router</label>
                        <select name="router_sn" class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-brand-500 outline-none text-slate-800 dark:text-white appearance-none cursor-pointer">
                            <option value="">-- Pilih SN Router --</option>
                            <option value="SN-ZTE998273">ZTE F609 - SN-ZTE998273</option>
                            <option value="SN-ZTE112233">ZTE F609 - SN-ZTE112233</option>
                            <option value="SN-HW882910">Huawei HG8245 - SN-HW882910</option>
                        </select>
                        <p class="text-[10px] text-slate-400 mt-2">*Pilih SN perangkat yang dipasang di unit klien.</p>
                    </div>
                </div>

                <div class="flex gap-3 mt-2">
                    <button type="button" onclick="closeModal()" class="flex-1 py-4 font-bold text-slate-400 hover:text-slate-600 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 bg-brand-600 text-white font-bold py-4 rounded-2xl shadow-glow hover:bg-brand-500 transition-colors">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // --- 1. JAVASCRIPT UNTUK NAV INDICATOR ---
        const indicator = document.getElementById('nav-indicator');
        const navContainer = document.getElementById('nav-container');
        const navLinks = document.querySelectorAll('.nav-link');

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
            if(activeLink) moveIndicatorTo(activeLink);
        });
        window.addEventListener('resize', () => {
            const activeLink = document.querySelector('.nav-link.active-link');
            if(activeLink) moveIndicatorTo(activeLink);
        });

        // --- 2. JAVASCRIPT UNTUK CARD CLICK & REDIRECT ---
        function navigateTo(linkId, targetUrl) {
            const targetLink = document.getElementById(linkId);
            
            if (targetLink && targetUrl !== '#') {
                navLinks.forEach(l => {
                    l.classList.remove('active-link', 'text-white', 'font-bold');
                    l.classList.add('text-slate-500', 'dark:text-slate-400', 'font-medium');
                });
                
                targetLink.classList.remove('text-slate-500', 'dark:text-slate-400', 'font-medium');
                targetLink.classList.add('active-link', 'text-white', 'font-bold');
                
                moveIndicatorTo(targetLink);
                setTimeout(() => window.location.href = targetUrl, 350); 
            }
        }

        // --- 3. JAVASCRIPT UNTUK MINI SLIDER INVENTORY ---
        function slideInv(direction) {
            const carousel = document.getElementById('inv-carousel');
            carousel.style.transform = `translateX(-${direction * 50}%)`;
        }

        // --- 4. THEME TOGGLE LOGIC ---
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

        // --- 5. JAVASCRIPT UNTUK MODAL EKSEKUSI TUGAS ---
        function openModal(id, name, type) {
            const modal = document.getElementById('executionModal');
            const card = document.getElementById('modalCard');
            const cableSection = document.getElementById('cable-section');
            
            document.getElementById('modal-task-id').value = id;
            document.getElementById('modal-client-name').innerText = "Klien: " + name;
            
            if (type === 'instalasi_baru') {
                cableSection.classList.remove('hidden');
                cableSection.classList.add('block');
            } else {
                cableSection.classList.add('hidden');
                cableSection.classList.remove('block');
            }
            
            modal.classList.remove('hidden');
            setTimeout(() => { 
                card.classList.remove('scale-95', 'opacity-0'); 
                card.classList.add('scale-100', 'opacity-100'); 
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('executionModal');
            const card = document.getElementById('modalCard');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }
    </script>
</body>
</html>