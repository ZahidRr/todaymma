<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Troubleshoot | Engineer OSS</title>
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

        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .animate-fade-out { opacity: 0; transform: translateY(-10px); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300 overflow-x-hidden">

    <!-- NAVBAR -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md shadow-brand-500/30">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700 transition-colors">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-brand-600 rounded-full shadow-md z-0"></div>
                
                <a href="{{ route('teknisi.dashboard') }}" id="link-dashboard" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.dashboard') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Dashboard</a>
                <a href="{{ route('teknisi.inventory') }}" id="link-inventory" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.inventory') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Inventory</a>
                <a href="{{ route('teknisi.ticket') }}" id="link-ticket" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.ticket') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Ticket</a>
                <a href="{{ route('teknisi.isolir') }}" class="nav-link relative z-10 px-4 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.isolir') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Aktivasi & Isolir</a>
                <a href="{{ route('teknisi.instalasi') }}" id="link-instalasi" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.instalasi') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Instalasi Baru</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors focus:outline-none">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>

            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                @csrf
                <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 font-extrabold flex items-center justify-center uppercase">
                    {{ substr($user->name ?? 'TE', 0, 2) }}
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ $user->name ?? 'Teknisi' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Engineer</p>
                </div>
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors" title="Logout">
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
        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 dark:border-red-900 dark:bg-red-500/10 p-4 rounded-2xl flex items-center gap-3 text-red-700 dark:text-red-400 font-bold text-sm shadow-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-6">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Daftar Ticket Troubleshoot 🛠️</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Kelola dan selesaikan kendala jaringan dari laporan pelanggan.</p>
            </div>
            
            <div class="relative w-full md:w-96 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" placeholder="Cari unit atau masalah..." class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-sm font-bold focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm">
            </div>
        </div>

        <div class="flex flex-wrap gap-2 mb-6">
            <button class="px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm bg-slate-900 text-white dark:bg-white dark:text-slate-900">Semua Tiket</button>
            <button class="px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50 text-slate-600 dark:text-slate-300">
                <span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-1"></span> Darurat
            </button>
            <button class="px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50 text-slate-600 dark:text-slate-300">
                <span class="inline-block w-2 h-2 rounded-full bg-amber-500 mr-1"></span> Tinggi
            </button>
            <button class="px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50 text-slate-600 dark:text-slate-300">
                <span class="inline-block w-2 h-2 rounded-full bg-slate-400 mr-1"></span> Normal
            </button>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 dark:text-slate-500 text-[11px] uppercase tracking-wider font-extrabold border-b border-slate-100 dark:border-slate-800">
                        <tr>
                            <th class="p-6 pl-6">ID & Waktu Lapor</th>
                            <th class="p-6">Lokasi & Klien</th>
                            <th class="p-6">Sales Pelapor</th>
                            <th class="p-6">Kendala & Prioritas</th>
                            <th class="p-6 text-center">Status</th>
                            <th class="p-6 text-right pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        
                        <!-- LOOPING DATABASE ASLI -->
                        @forelse($tickets ?? [] as $ticket)
                            @php
                                // Logika Prioritas sederhana
                                $notes = strtolower($ticket->notes ?? '');
                                $isDarurat = str_contains($notes, 'los') || str_contains($notes, 'mati') || str_contains($notes, 'putus');
                                
                                // Format Variabel
                                $salesName = $ticket->customer->sales->name ?? 'Admin/CS';
                                $salesInitial = strtoupper(substr($salesName, 0, 2));
                                $unitFormat = substr($ticket->customer->tower ?? '-', 0, 1) . '/' . ($ticket->customer->floor ?? '-') . '/' . ($ticket->customer->unit ?? '-');
                                
                                // Styling Baris (Jika diproses orang lain, jadi redup)
                                $rowBg = ($ticket->status == 'on_progress' && $ticket->technician_id != Auth::id()) ? 'bg-slate-50 dark:bg-slate-800/20 opacity-60' : 'hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors';
                                // Jika Darurat & belum diambil, beri efek merah tipis
                                if ($isDarurat && $ticket->status == 'pending') {
                                    $rowBg .= ' bg-red-50/20 dark:bg-red-900/10';
                                }
                            @endphp

                            <tr class="{{ $rowBg }}">
                                <td class="p-6 {{ ($isDarurat && $ticket->status == 'pending') ? 'border-l-4 border-red-500' : '' }}">
                                    <p class="font-bold text-slate-800 dark:text-slate-200 text-sm font-mono">#TK-{{ \Carbon\Carbon::parse($ticket->created_at)->format('ymd') }}-{{ str_pad($ticket->id, 2, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-[10px] font-bold text-slate-500 mt-1">{{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}</p>
                                </td>
                                
                                <td class="p-6">
                                    <p class="font-mono text-[11px] font-black text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-2 py-0.5 rounded w-max mb-1">{{ $unitFormat }}</p>
                                    <p class="font-bold text-slate-600 dark:text-slate-400 text-xs">{{ $ticket->customer->name }}</p>
                                </td>
                                
                                <td class="p-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-[9px]">{{ $salesInitial }}</div>
                                        <p class="text-xs font-bold text-slate-600 dark:text-slate-400">{{ $salesName }}</p>
                                    </div>
                                </td>
                                
                                <td class="p-6">
                                    <p class="font-bold text-slate-800 dark:text-slate-200 text-sm line-clamp-1">{{ $ticket->notes ?? 'Pengecekan Jaringan' }}</p>
                                    
                                    @if($isDarurat)
                                        <span class="inline-block mt-1 px-2 py-0.5 bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 text-[9px] font-black uppercase rounded">Prioritas: Darurat</span>
                                    @else
                                        <span class="inline-block mt-1 px-2 py-0.5 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[9px] font-black uppercase rounded">Prioritas: Normal</span>
                                    @endif
                                </td>
                                
                                <td class="p-6 text-center">
                                    @if($ticket->status == 'pending')
                                        <span class="inline-flex items-center gap-1 text-slate-500 dark:text-slate-400 text-xs font-bold bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-full">Menunggu</span>
                                    @elseif($ticket->status == 'on_progress')
                                        <span class="inline-flex items-center gap-1.5 text-brand-600 dark:text-brand-400 text-xs font-bold bg-brand-50 dark:bg-brand-900/20 border border-brand-200 dark:border-brand-800 px-3 py-1 rounded-full">
                                            <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg Diproses
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="p-6 text-right pr-6">
                                    @if($ticket->status == 'on_progress')
                                        @if($ticket->technician_id == Auth::id())
                                            <!-- Tombol Selesai (Jika ini tugas saya) -->
                                            <button onclick="openModal('{{ $ticket->id }}', '{{ addslashes($ticket->customer->name) }}', '{{ $unitFormat }}', '{{ addslashes($salesName) }}', 'complete')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 hover:border-green-400 hover:bg-green-50 text-slate-600 hover:text-green-600 dark:text-slate-400 dark:hover:text-green-400 dark:hover:bg-green-900/20 dark:hover:border-green-500/50 rounded-xl font-bold text-xs transition-all shadow-sm focus:outline-none">
                                                Selesaikan
                                            </button>
                                        @else
                                            <!-- Tombol Gembok (Jika teknisi lain yang proses) -->
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs font-bold rounded">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                Dikunci
                                            </span>
                                        @endif
                                    @else
                                        <!-- Tombol Ambil (Jika pending) -->
                                        <button onclick="openModal('{{ $ticket->id }}', '{{ addslashes($ticket->customer->name) }}', '{{ $unitFormat }}', '{{ addslashes($salesName) }}', 'start')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-xl font-bold text-xs shadow-glow transition-all hover:-translate-y-0.5 focus:outline-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 
                                            Ambil Tugas
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-16 text-center">
                                    <div class="flex flex-col items-center justify-center animate-fade-in">
                                        <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mb-4 text-slate-400">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <h3 class="text-xl font-extrabold text-slate-700 dark:text-slate-300">Antrian Bersih! ✨</h3>
                                        <p class="text-sm text-slate-500 font-medium mt-2">Belum ada laporan kendala internet dari klien.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- MODAL EKSEKUSI (SUDAH DIUPDATE DENGAN ENCTYPE & FORM LAPORAN) -->
    <div id="actionModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-[32px] p-8 shadow-2xl z-10 border border-slate-200 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="modalCard">
            
            <div id="modal-icon-container" class="w-12 h-12 rounded-full mb-4 flex items-center justify-center"></div>

            <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2" id="modal-title">Konfirmasi</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6" id="modal-desc"></p>
            
            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50 mb-6 flex justify-between items-center">
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Target Lokasi</p>
                    <p class="text-lg font-mono font-black text-slate-800 dark:text-white" id="modal-target-unit"></p>
                    <p class="text-sm font-bold text-slate-500 mt-1" id="modal-target-name"></p>
                </div>
                <div class="text-right border-l border-slate-200 dark:border-slate-700 pl-4">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Sales Pelapor</p>
                    <p class="text-sm font-black text-brand-600 dark:text-brand-400" id="modal-sales-name"></p>
                </div>
            </div>
            
            <!-- FORM dengan ENCTYPE Wajib untuk Upload File -->
            <form method="POST" action="{{ route('teknisi.execute') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="task_id" id="modal-task-id">
                <input type="hidden" name="action" id="modal-action-type">
                
                <!-- FORM LAPORAN (Hanya muncul saat actionType === 'complete') -->
                <div id="report-form" class="hidden space-y-4 mb-6 text-left">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Kendala Sebenarnya di Lapangan</label>
                        <textarea name="root_cause" id="input-root-cause" rows="2" placeholder="Contoh: Kabel FO putus digigit tikus di plafon..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-500 resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tindakan Perbaikan yang Dilakukan</label>
                        <textarea name="action_taken" id="input-action-taken" rows="2" placeholder="Contoh: Menarik ulang kabel baru sepanjang 15 meter & setting ulang router..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-500 resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Foto Bukti Pengerjaan (Wajib)</label>
                        <input type="file" name="proof_image" id="input-proof-image" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-sm rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-green-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-green-50 file:text-green-600 hover:file:bg-green-100 transition-colors">
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeModal()" class="flex-1 py-4 font-bold text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">Batal</button>
                    <button type="submit" id="modal-btn-submit" class="flex-1 text-white font-bold py-4 rounded-2xl transition-colors shadow-lg">Eksekusi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // FUNGSI MODAL DINAMIS UNTUK TEKNISI
        function openModal(taskId, clientName, unit, salesName, actionType) {
            const modal = document.getElementById('actionModal');
            const card = document.getElementById('modalCard');
            const title = document.getElementById('modal-title');
            const desc = document.getElementById('modal-desc');
            const iconContainer = document.getElementById('modal-icon-container');
            const btnSubmit = document.getElementById('modal-btn-submit');
            
            // Ambil elemen form laporan
            const reportForm = document.getElementById('report-form');
            const inputRoot = document.getElementById('input-root-cause');
            const inputAction = document.getElementById('input-action-taken');
            const inputProof = document.getElementById('input-proof-image');
            
            document.getElementById('modal-task-id').value = taskId;
            document.getElementById('modal-action-type').value = actionType;
            document.getElementById('modal-target-name').innerText = clientName;
            document.getElementById('modal-target-unit').innerText = unit;
            document.getElementById('modal-sales-name').innerText = salesName;
            
            if(actionType === 'start') {
                title.innerText = "Ambil Tiket Ini?";
                desc.innerText = "Tiket akan ditandai 'Sedang Diproses' atas nama Anda.";
                iconContainer.className = "w-12 h-12 rounded-full mb-4 flex items-center justify-center bg-brand-100 text-brand-600 dark:bg-brand-900/30 dark:text-brand-400";
                iconContainer.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>';
                
                btnSubmit.className = "flex-1 bg-brand-600 hover:bg-brand-700 text-white font-bold py-4 rounded-2xl transition-colors shadow-glow";
                btnSubmit.innerText = "Ya, Ambil Tugas";
                
                // Sembunyikan Form Laporan & lepaskan status required
                reportForm.classList.add('hidden');
                inputRoot.required = false; inputAction.required = false; inputProof.required = false;
            } else {
                title.innerText = "Laporan Selesai Tugas";
                desc.innerText = "Wajib mengisi laporan perbaikan sebelum menutup tiket.";
                iconContainer.className = "w-12 h-12 rounded-full mb-4 flex items-center justify-center bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400";
                iconContainer.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>';
                
                btnSubmit.className = "flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-2xl transition-colors shadow-lg";
                btnSubmit.innerText = "Simpan Laporan & Selesai";
                
                // Tampilkan Form Laporan & pasang status required
                reportForm.classList.remove('hidden');
                inputRoot.required = true; inputAction.required = true; inputProof.required = true;
            }
            
            modal.classList.remove('hidden');
            setTimeout(() => { card.classList.remove('scale-95', 'opacity-0'); card.classList.add('scale-100', 'opacity-100'); }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('actionModal');
            const card = document.getElementById('modalCard');
            card.classList.remove('scale-100', 'opacity-100'); card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        // FUNGSI NAVBAR (Menu Pil Animasi)
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
            document.getElementById('main-content').classList.remove('opacity-0');
        });

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetUrl = this.getAttribute('href');
                if (targetUrl && targetUrl !== '#') {
                    e.preventDefault();
                    navLinks.forEach(l => {
                        l.classList.remove('active-link', 'text-white', 'font-bold');
                        l.classList.add('text-slate-500', 'dark:text-slate-400', 'font-medium');
                    });
                    this.classList.add('active-link', 'text-white', 'font-bold');
                    moveIndicatorTo(this);
                    if(mainContent) {
                        mainContent.classList.remove('animate-fade-in');
                        mainContent.classList.add('animate-fade-out');
                    }
                    setTimeout(() => window.location.href = targetUrl, 250); 
                }
            });
        });

        // FUNGSI THEME (Dark/Light Mode)
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