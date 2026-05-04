<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Client | ConnectMe OSS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        input[type="file"]::file-selector-button {
            border: none; background: #eff6ff; color: #2563eb; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 0.75rem; cursor: pointer; transition: background 0.2s; margin-right: 16px;
        }
        .dark input[type="file"]::file-selector-button { background: rgba(59, 130, 246, 0.2); color: #60a5fa; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- NAVBAR -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-slate-900 dark:bg-white rounded-full flex items-center justify-center text-white dark:text-slate-900 font-bold text-lg shadow-md">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div class="hidden md:flex items-center bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700">
                <a href="{{ route('sales.dashboard') }}" class="px-5 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300">Dashboard</a>
                <a href="{{ route('sales.clients.index') }}" class="px-5 py-2 text-sm font-bold bg-slate-900 text-white dark:bg-white dark:text-slate-900 rounded-full shadow-md transition-colors duration-300">Daftar Client</a>
                <a href="{{ route('sales.ticket') }}" class="px-5 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300">Ticket Troubleshoot</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors focus:outline-none">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
            </button>
            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                @csrf
                <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 font-extrabold flex items-center justify-center uppercase">
                    {{ substr(Auth::user()->name ?? 'SL', 0, 2) }}
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name ?? 'Sales' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Account Executive</p>
                </div>
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-1 p-8 max-w-[1400px] mx-auto w-full animate-fade-in">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-2">
                    Daftar Client 👥
                </h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Pantau status pemasangan, pembayaran, dan data client.</p>
            </div>
            
            <div class="flex gap-4 w-full md:w-auto">
                <div class="relative w-full md:w-64 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="searchInput" placeholder="Cari nama / unit..." class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm">
                </div>
                <a href="{{ route('sales.clients.create') }}" class="flex-shrink-0 flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-brand-500/30 transition-all hover:-translate-y-0.5 focus:ring-4 focus:ring-brand-500/50">
                    + Client Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl mb-6 font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl mb-6 font-bold text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- 3 TABS NAVIGATION -->
        <div class="flex items-center gap-4 mb-6 border-b border-slate-200 dark:border-slate-800 overflow-x-auto pb-1">
            <button onclick="switchTab('pending')" id="tab-pending" class="tab-btn pb-3 px-2 text-sm font-bold border-b-2 border-brand-600 text-brand-600 dark:text-brand-400 transition-colors whitespace-nowrap">
                Pemasangan Baru
            </button>
            <button onclick="switchTab('active')" id="tab-active" class="tab-btn pb-3 px-2 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 transition-colors whitespace-nowrap">
                Client Aktif
            </button>
            <button onclick="switchTab('terminated')" id="tab-terminated" class="tab-btn pb-3 px-2 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 transition-colors whitespace-nowrap">
                Riwayat Berhenti
            </button>
        </div>

        <div class="flex flex-wrap gap-2 mb-6" id="towerFilters">
            <button data-filter="all" class="filter-btn px-4 py-2 bg-slate-800 text-white dark:bg-white dark:text-slate-900 text-xs font-bold rounded-lg shadow-sm transition-colors">Semua Tower</button>
            <button data-filter="a" class="filter-btn px-4 py-2 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-800 text-xs font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Alamanda</button>
            <button data-filter="b" class="filter-btn px-4 py-2 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-800 text-xs font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Bougenville</button>
            <button data-filter="c" class="filter-btn px-4 py-2 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-800 text-xs font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Chrysant</button>
            <button data-filter="d" class="filter-btn px-4 py-2 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-800 text-xs font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Dahlia</button>
            <button data-filter="e" class="filter-btn px-4 py-2 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-800 text-xs font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Emerald</button>
        </div>

        <!-- TABEL DATA -->
        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-wider font-extrabold border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900">
                            <th class="p-5 pl-6">Profil Client & Lokasi</th>
                            <th class="p-5">Kontak & Paket</th>
                            <th class="p-5">Tanggal Registrasi</th>
                            <th class="p-5">Status Layanan & Bayar</th>
                            <th class="p-5 text-right pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-800" id="clientTableBody">
                        
                        @forelse($clients ?? [] as $client)
                            @php
                                $tabGroup = 'active'; 
                                if($client->status == 'pending') $tabGroup = 'pending';
                                if(in_array($client->status, ['req_terminate', 'terminated'])) $tabGroup = 'terminated';

                                // AMBIL STATUS BAYAR DARI TABEL INVOICES, BUKAN CUSTOMERS
                                $unpaidInvoice = $client->invoices->where('status', 'belum_bayar')->first();
                                $verifyingInvoice = $client->invoices->where('status', 'menunggu_verifikasi')->first();
                            @endphp

                            <tr class="client-row hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors" 
                                data-tower="{{ strtolower(substr($client->tower, 0, 1)) }}"
                                data-tab="{{ $tabGroup }}">
                                
                                <td class="p-5 pl-6 flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold flex items-center justify-center text-xs shrink-0">
                                        {{ strtoupper(substr($client->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white client-name">{{ $client->name }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="font-mono text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded border border-slate-200 dark:border-slate-700 client-unit">
                                                {{ substr($client->tower, 0, 1) }}/{{ $client->floor }}/{{ $client->unit }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="p-5">
                                    <p class="font-bold text-slate-700 dark:text-slate-300 font-mono text-xs">{{ $client->phone_1 }}</p>
                                    <span class="inline-block mt-1 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 px-2 py-0.5 rounded text-[10px] font-bold border border-slate-200 dark:border-slate-700">
                                        {{ explode('MBPS', strtoupper($client->package))[0] ?? $client->package }} MBPS
                                    </span>
                                </td>
                                
                                <td class="p-5">
                                    <p class="font-bold text-slate-700 dark:text-slate-300">{{ \Carbon\Carbon::parse($client->created_at)->format('d M Y') }}</p>
                                </td>
                                
                                <td class="p-5">
                                    <div class="flex flex-col gap-1.5 items-start">
                                        <!-- Status Operasional -->
                                        @if($client->status == 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-amber-50 dark:bg-amber-500/10 text-amber-600 border border-amber-200">
                                                Menunggu Teknisi
                                            </span>
                                        @elseif($client->status == 'active')
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-green-50 dark:bg-green-500/10 text-green-600 border border-green-200">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-200">
                                                Berhenti
                                            </span>
                                        @endif

                                        <!-- Status Pembayaran -->
                                        @if($unpaidInvoice)
                                            <span class="text-[9px] font-black uppercase text-red-500 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Belum Bayar</span>
                                        @elseif($verifyingInvoice)
                                            <span class="text-[9px] font-black uppercase text-brand-500 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> Verifikasi Admin</span>
                                        @else
                                            <span class="text-[9px] font-black uppercase text-green-500 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Pembayaran Lunas</span>
                                        @endif
                                    </div>
                                </td>
                                
                                <td class="p-5 text-right pr-6 flex justify-end gap-2">
                                    
                                    <!-- Tombol Reschedule (Hanya muncul jika status pending) -->
                                    @if($client->status == 'pending')
                                        <button onclick="openRescheduleModal('{{ $client->id }}', '{{ addslashes($client->name) }}', '{{ \Carbon\Carbon::parse($client->install_date)->format('Y-m-d') }}')" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors" title="Ubah Jadwal Pasang">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </button>
                                    @endif

                                    <!-- Jika ada tagihan belum dibayar, lemparkan ID INVOICE ke Modal -->
                                    @if($unpaidInvoice)
                                        <button onclick="openUploadModal('{{ $unpaidInvoice->id }}', '{{ addslashes($client->name) }}')" class="inline-flex items-center gap-1.5 text-white font-bold text-xs border border-red-500 bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-lg transition-colors shadow-sm shadow-red-500/30">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            Susulkan Struk
                                        </button>
                                    @endif

                                    <a href="{{ route('sales.clients.show', $client->id) }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-brand-600 dark:text-slate-400 dark:hover:text-brand-400 font-bold text-xs border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 hover:bg-brand-50 px-3 py-1.5 rounded-lg transition-colors">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyStateRow">
                                <td colspan="5" class="p-8 text-center text-slate-500 dark:text-slate-400 font-medium text-sm">
                                    Belum ada data client yang didaftarkan.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- MODAL UPLOAD BUKTI BAYAR SUSULAN -->
    <div id="uploadModal" class="fixed inset-0 bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-sm z-[100] hidden flex items-center justify-center transition-opacity opacity-0 duration-300">
        <div class="bg-white dark:bg-slate-900 w-full max-w-md p-6 rounded-[24px] shadow-2xl border border-slate-200 dark:border-slate-800 transform scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">Upload Struk Pembayaran</h3>
                <button onclick="closeUploadModal()" class="text-slate-400 hover:text-slate-700 dark:hover:text-white focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Susulkan bukti transfer untuk client <strong id="modalClientName" class="text-slate-800 dark:text-slate-200">Client</strong>.</p>
            
            <!-- FORM UPLOAD -->
            <form id="uploadForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-brand-50 dark:bg-brand-900/10 border border-brand-100 dark:border-brand-900/50 p-4 rounded-xl mb-6">
                    <label class="block text-xs font-black text-brand-600 dark:text-brand-400 uppercase tracking-widest mb-2">Pilih File Struk *</label>
                    <input type="file" name="payment_proof" accept="image/*,.pdf" required class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-brand-700 hover:file:bg-brand-100 transition-colors cursor-pointer">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeUploadModal()" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 shadow-lg shadow-brand-500/30 transition-all">Upload Struk</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL RESCHEDULE PEMASANGAN -->
    <div id="rescheduleModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm transition-opacity" onclick="closeRescheduleModal()"></div>
        <div class="bg-white dark:bg-slate-900 w-full max-w-md rounded-[32px] p-8 shadow-2xl z-10 border border-slate-200 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="rescheduleCard">
            
            <div class="w-12 h-12 rounded-full mb-4 flex items-center justify-center bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>

            <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Ubah Jadwal Pasang</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Atur ulang tanggal instalasi teknisi untuk klien <strong id="res-client-name" class="text-slate-700 dark:text-slate-300"></strong>.</p>
            
            <form method="POST" action="" id="rescheduleForm">
                @csrf
                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wider">Pilih Tanggal Baru</label>
                    <input type="date" name="install_date" id="res-install-date" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-amber-500 transition-shadow cursor-pointer">
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeRescheduleModal()" class="flex-1 py-4 font-bold text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 text-white bg-amber-500 hover:bg-amber-600 font-bold py-4 rounded-2xl transition-colors shadow-lg">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
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

        const filterBtns = document.querySelectorAll('.filter-btn');
        const rows = document.querySelectorAll('.client-row');
        const searchInput = document.getElementById('searchInput');
        let currentTab = 'pending'; 

        function filterTable() {
            const activeBtn = document.querySelector('.filter-btn.bg-slate-800') || document.querySelector('.filter-btn[data-filter="all"]');
            const towerFilter = activeBtn.getAttribute('data-filter');
            const searchQuery = searchInput.value.toLowerCase();

            rows.forEach(row => {
                const rowTower = row.getAttribute('data-tower');
                const rowTab = row.getAttribute('data-tab');
                const rowName = row.querySelector('.client-name').innerText.toLowerCase();
                const rowUnit = row.querySelector('.client-unit').innerText.toLowerCase();
                
                const matchesTower = (towerFilter === 'all' || rowTower === towerFilter);
                const matchesSearch = (rowName.includes(searchQuery) || rowUnit.includes(searchQuery));
                const matchesTab = (rowTab === currentTab);

                if (matchesTower && matchesSearch && matchesTab) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function switchTab(tabName) {
            currentTab = tabName;
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-brand-600', 'text-brand-600', 'dark:text-brand-400');
                btn.classList.add('border-transparent', 'text-slate-500');
            });
            const activeTabBtn = document.getElementById('tab-' + tabName);
            activeTabBtn.classList.remove('border-transparent', 'text-slate-500');
            activeTabBtn.classList.add('border-brand-600', 'text-brand-600', 'dark:text-brand-400');
            filterTable();
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('bg-slate-800', 'text-white', 'dark:bg-white', 'dark:text-slate-900');
                    b.classList.add('bg-white', 'text-slate-600', 'dark:bg-slate-900', 'dark:text-slate-400');
                });
                btn.classList.add('bg-slate-800', 'text-white', 'dark:bg-white', 'dark:text-slate-900');
                btn.classList.remove('bg-white', 'text-slate-600', 'dark:bg-slate-900', 'dark:text-slate-400');
                filterTable();
            });
        });

        searchInput.addEventListener('input', filterTable);
        window.addEventListener('DOMContentLoaded', filterTable);

        // MODAL UPLOAD STRUK
        const modal = document.getElementById('uploadModal');
        const modalContent = modal.querySelector('div');
        
        function openUploadModal(invoiceId, clientName) {
            document.getElementById('modalClientName').innerText = clientName;
            document.getElementById('uploadForm').action = `/sales/invoices/${invoiceId}/upload`; 

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeUploadModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }

        // MODAL RESCHEDULE JADWAL
        function openRescheduleModal(clientId, clientName, currentDate) {
            const rModal = document.getElementById('rescheduleModal');
            const rCard = document.getElementById('rescheduleCard');
            const rForm = document.getElementById('rescheduleForm');
            
            document.getElementById('res-client-name').innerText = clientName;
            document.getElementById('res-install-date').value = currentDate;
            rForm.action = `/sales/clients/${clientId}/reschedule`;
            
            rModal.classList.remove('hidden');
            setTimeout(() => { rCard.classList.remove('scale-95', 'opacity-0'); rCard.classList.add('scale-100', 'opacity-100'); }, 10);
        }

        function closeRescheduleModal() {
            const rModal = document.getElementById('rescheduleModal');
            const rCard = document.getElementById('rescheduleCard');
            rCard.classList.remove('scale-100', 'opacity-100'); rCard.classList.add('scale-95', 'opacity-0');
            setTimeout(() => rModal.classList.add('hidden'), 300);
        }
    </script>
</body>
</html>