<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | ConnectMe OSS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] }, colors: { brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 900: '#1e3a8a' } }, boxShadow: { 'card': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)' } } } }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; } ::-webkit-scrollbar-track { background: transparent; } ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; } .dark ::-webkit-scrollbar-thumb { background: #334155; }
        #nav-indicator { left: 0; transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); will-change: transform, width; }
        .tab-content { display: none; animation: fadeIn 0.4s ease; } .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-50 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md shadow-brand-500/30">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-brand-600 rounded-full shadow-md z-0"></div>
                <a href="{{ route('teknisi.dashboard') }}" id="link-dashboard" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 text-slate-500 dark:text-slate-400 font-medium">Dashboard</a>
                <a href="{{ route('teknisi.inventory') }}" id="link-inventory" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 active-link font-bold text-white">Inventory</a>
                <a href="{{ route('teknisi.ticket') }}" id="link-ticket" class="nav-link relative z-10 px-5 py-2 text-slate-500 dark:text-slate-400 font-medium">Ticket</a>
                <a href="{{ route('teknisi.isolir') }}" class="nav-link relative z-10 px-4 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.isolir') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Aktivasi & Isolir</a>
                <a href="{{ route('teknisi.instalasi') }}" id="link-instalasi" class="nav-link relative z-10 px-5 py-2 text-sm transition-colors duration-300 {{ request()->routeIs('teknisi.instalasi') ? 'active-link font-bold text-white' : 'text-slate-500 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white' }}">Instalasi Baru</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors focus:outline-none">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>
            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                @csrf
                <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 font-extrabold flex items-center justify-center uppercase">{{ substr(Auth::user()->name ?? 'User', 0, 2) }}</div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name ?? 'Teknisi' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Engineer</p>
                </div>
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-1 p-8 max-w-[1600px] mx-auto w-full">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Gudang Inventory 📦</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Kelola pendataan Serial Number Router dan Material Kabel.</p>
            </div>
            <button onclick="openAddModal()" class="bg-slate-900 dark:bg-brand-600 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-brand-500/20 hover:bg-slate-800 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Barang
            </button>
        </div>

        <div class="flex gap-2 mb-6 p-1 bg-slate-200/50 dark:bg-slate-800/50 w-max rounded-xl border border-slate-200 dark:border-slate-800">
            <button onclick="switchTab('tab-perangkat')" id="btn-tab-perangkat" class="tab-btn px-6 py-2.5 rounded-lg text-sm font-bold bg-white dark:bg-slate-900 text-slate-800 dark:text-white shadow-sm transition-all">Daftar Router (SN)</button>
            <button onclick="switchTab('tab-material')" id="btn-tab-material" class="tab-btn px-6 py-2.5 rounded-lg text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white transition-all">Material Kabel & Alat</button>
        </div>

        <!-- ======================= TAB 1: PERANGKAT ROUTER ======================= -->
        <div id="tab-perangkat" class="tab-content active">
            <!-- ROUTER GUDANG -->
            <div class="mb-8">
                <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-green-500 shadow-sm"></span> Stok Tersedia (Siap Pasang)</h3>
                <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 text-[11px] tracking-wider uppercase font-extrabold border-b border-slate-100 dark:border-slate-800">
                            <tr><th class="p-5 pl-6">Model Perangkat</th><th class="p-5">Serial Number (SN)</th><th class="p-5 text-right pr-6">Aksi</th></tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                            @php $countTersedia = 0; @endphp
                            @forelse($perangkat ?? [] as $item)
                                @if($item->status == 'Tersedia')
                                    @php $countTersedia++; @endphp
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="p-5 pl-6 font-bold text-slate-800 dark:text-slate-200">{{ $item->item_name }}</td>
                                        <td class="p-5 font-mono text-brand-600 dark:text-brand-400 font-bold tracking-wide">{{ $item->serial_number ?? '-' }}</td>
                                        <td class="p-5 text-right pr-6 space-x-2">
                                            <button onclick="openEditModal('{{ $item->id }}', '{{ $item->item_name }}', '{{ $item->category }}', '{{ $item->serial_number }}', '{{ $item->stock_quantity }}', '{{ $item->unit }}')" class="p-2 text-slate-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 rounded-lg transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                            <button onclick="openDeleteModal('{{ $item->id }}', '{{ $item->item_name }}')" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                            @endforelse
                            @if($countTersedia == 0) <tr><td colspan="3" class="p-8 text-center text-slate-400 text-sm">Tidak ada router yang tersedia di gudang.</td></tr> @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ROUTER TERPASANG -->
            <div>
                <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-sm"></span> Telah Terpasang (Data Klien)</h3>
                <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 text-[11px] tracking-wider uppercase font-extrabold border-b border-slate-100 dark:border-slate-800">
                            <tr><th class="p-5 pl-6">Serial Number (SN)</th><th class="p-5">Nama Client</th><th class="p-5">Alamat Unit</th><th class="p-5 text-right pr-6">Pemakaian Kabel</th></tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                            @forelse($routerTerpasang ?? [] as $client)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="p-5 pl-6"><span class="font-mono text-brand-600 dark:text-brand-400 font-bold bg-brand-50 dark:bg-brand-500/10 px-2.5 py-1 rounded-md">{{ $client->router_sn }}</span></td>
                                    <td class="p-5 font-bold text-slate-800 dark:text-slate-200">{{ $client->name }}</td>
                                    <td class="p-5 text-slate-500 dark:text-slate-400 font-bold tracking-wide">{{ substr($client->tower ?? '', 0, 1) }}/{{ $client->floor ?? '' }}/{{ $client->unit ?? '' }}</td>
                                    <td class="p-5 text-right pr-6"><span class="font-mono font-bold text-slate-700 dark:text-slate-300">{{ $client->cable_length ?? '0' }} Meter</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="p-8 text-center text-slate-400 text-sm">Belum ada data router yang dipasang pada Klien.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ======================= TAB 2: MATERIAL & ALAT ======================= -->
        <div id="tab-material" class="tab-content">
            
            <!-- STOK MATERIAL (GUDANG) -->
            <div class="mb-8">
                <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-sm"></span> Stok Material & Box Kabel</h3>
                <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 text-[11px] tracking-wider uppercase font-extrabold border-b border-slate-100 dark:border-slate-800">
                            <tr><th class="p-6 pl-8">Kode Box / SN</th><th class="p-6">Nama Material / Alat</th><th class="p-6">Sisa Stok Meteran / Qty</th><th class="p-6 text-right">Aksi</th></tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                            @forelse($material ?? [] as $item)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="p-6 pl-8 font-mono text-slate-500 dark:text-slate-400 font-bold">{{ $item->serial_number ?? '-' }}</td>
                                <td class="p-6 font-bold text-slate-800 dark:text-slate-200">{{ $item->item_name }}</td>
                                <td class="p-6 font-mono text-2xl text-slate-900 dark:text-white font-black"><span class="{{ $item->stock_quantity <= 10 ? 'text-red-500' : '' }}">{{ $item->stock_quantity }}</span> <span class="text-xs text-slate-400 font-bold uppercase tracking-wide ml-1">{{ $item->unit }}</span></td>
                                <td class="p-6 text-right space-x-2">
                                    <button onclick="openEditModal('{{ $item->id }}', '{{ $item->item_name }}', '{{ $item->category }}', '{{ $item->serial_number }}', '{{ $item->stock_quantity }}', '{{ $item->unit }}')" class="p-2 text-slate-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 rounded-lg transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                    <button onclick="openDeleteModal('{{ $item->id }}', '{{ $item->item_name }}')" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="p-8 text-center text-slate-400">Tidak ada data material.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- RIWAYAT PEMAKAIAN KABEL -->
            <div>
                <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-sm"></span> Riwayat Pemakaian Kabel (Klien)</h3>
                <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 text-[11px] tracking-wider uppercase font-extrabold border-b border-slate-100 dark:border-slate-800">
                            <tr><th class="p-5 pl-6">Kode Box</th><th class="p-5">Nama Client</th><th class="p-5">Alamat Unit</th><th class="p-5 text-right pr-6">Kabel Terpakai</th></tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                            @forelse($kabelTerpasang ?? [] as $client)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="p-5 pl-6"><span class="font-mono text-brand-600 dark:text-brand-400 font-bold bg-brand-50 dark:bg-brand-500/10 px-2.5 py-1 rounded-md">{{ $client->cable_sn ?? 'Tanpa Box' }}</span></td>
                                    <td class="p-5 font-bold text-slate-800 dark:text-slate-200">{{ $client->name }}</td>
                                    <td class="p-5 text-slate-500 dark:text-slate-400 font-bold tracking-wide">{{ substr($client->tower ?? '', 0, 1) }}/{{ $client->floor ?? '' }}/{{ $client->unit ?? '' }}</td>
                                    <td class="p-5 text-right pr-6"><span class="font-mono font-bold text-slate-700 dark:text-slate-300">{{ $client->cable_length }} Meter</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="p-8 text-center text-slate-400 text-sm">Belum ada history pemakaian kabel.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    @if(session('success'))
    <div id="success-alert" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-xl z-50 animate-bounce flex items-center gap-3"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><p class="font-bold text-sm">{{ session('success') }}</p></div>
    <script>setTimeout(() => { const alert = document.getElementById('success-alert'); if(alert) alert.remove(); }, 3000);</script>
    @endif

    <!-- MODAL TAMBAH/EDIT -->
    <div id="inventoryModal" class="fixed inset-0 z-[100] hidden overflow-y-auto flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-sm transition-opacity" onclick="closeInvModal()"></div>
        <div class="relative w-full max-w-md transform overflow-hidden rounded-[32px] bg-white dark:bg-slate-900 p-8 shadow-2xl border border-slate-200 dark:border-slate-800 transition-all scale-95 opacity-0" id="invModalCard">
            <div class="flex justify-between items-center mb-6">
                <h3 id="modal-title" class="text-xl font-bold text-slate-900 dark:text-white">Tambah Barang</h3>
                <button type="button" onclick="closeInvModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <form id="inventoryForm" method="POST" action="{{ route('teknisi.inventory.store') }}" class="space-y-5">
                @csrf
                <div id="method-put"></div> 
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori Input</label>
                    <select id="input-category" name="category" onchange="toggleFormFields()" required class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-brand-500 outline-none text-slate-800 dark:text-white appearance-none cursor-pointer">
                        <option value="perangkat">Router / Perangkat (1 Baris = 1 SN)</option>
                        <option value="material">Material Kabel / Alat Kerja</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Model / Material</label>
                    <input type="text" id="input-name" name="item_name" required placeholder="Contoh: Ruijie RG-EW300N" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-brand-500 outline-none text-slate-800 dark:text-white">
                </div>
                <!-- SN SEKARANG MUNCUL UNTUK KABEL JUGA (UNTUK KODE BOX) -->
                <div id="sn-section" class="block">
                    <label class="block text-[10px] font-black text-brand-500 uppercase tracking-widest mb-2">Input Serial Number / Kode Box</label>
                    <input type="text" id="input-sn" name="serial_number" placeholder="Contoh: Box-004" class="w-full bg-brand-50 dark:bg-brand-900/20 border border-brand-200 dark:border-brand-700/50 rounded-xl px-4 py-3 text-sm font-mono font-bold focus:ring-2 focus:ring-brand-500 outline-none text-brand-700 dark:text-brand-300 placeholder-brand-300">
                </div>
                <div id="qty-section" class="hidden grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jumlah Stok</label>
                        <input type="number" id="input-qty" name="stock_quantity" placeholder="0" class="w-full font-mono bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 outline-none text-slate-800 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Satuan</label>
                        <select id="input-unit" name="unit" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-brand-500 outline-none text-slate-800 dark:text-white appearance-none cursor-pointer">
                            <option value="Meter">Meter</option> <option value="Roll">Roll</option> <option value="Box">Box</option> <option value="Pcs">Pcs / Buah</option>
                        </select>
                    </div>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="closeInvModal()" class="flex-1 py-3 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Batal</button>
                    <button type="submit" id="modal-submit-btn" class="flex-1 bg-brand-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-500/30 hover:bg-brand-500 transition-all">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE -->
    <div id="deleteModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
        <div class="bg-white dark:bg-slate-900 w-full max-w-sm rounded-[32px] p-8 shadow-2xl z-10 border border-slate-200 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="deleteCard">
            <div class="w-16 h-16 bg-red-100 dark:bg-red-500/20 text-red-600 rounded-full flex items-center justify-center mb-6 mx-auto"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
            <h3 class="text-xl font-black text-slate-900 dark:text-white text-center mb-2">Hapus Data?</h3>
            <p class="text-sm text-slate-500 text-center mb-6" id="delete-item-name">Data akan dihapus permanen.</p>
            <form id="deleteForm" method="POST" action="">
                @csrf @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 py-3 font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 bg-red-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-red-500/30 hover:bg-red-500 transition-colors">Ya, Hapus!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        function toggleFormFields() {
            const category = document.getElementById('input-category').value;
            const snSection = document.getElementById('sn-section');
            const qtySection = document.getElementById('qty-section');
            const inputName = document.getElementById('input-name');

            // DI SINI KUNCI NYA: SN SELALU DIBUKA (BLOCK) APAPUN KATEGORINYA
            snSection.classList.remove('hidden');
            snSection.classList.add('block');

            if (category === 'perangkat') {
                qtySection.classList.remove('grid');
                qtySection.classList.add('hidden');
                if(inputName.value === '') inputName.value = 'Ruijie RG-EW300N';
            } else {
                qtySection.classList.remove('hidden');
                qtySection.classList.add('grid');
                if(inputName.value === 'Ruijie RG-EW300N') inputName.value = '';
            }
        }

        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => { btn.className = 'tab-btn px-6 py-2.5 rounded-lg text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white transition-all'; });
            document.getElementById(tabId).classList.add('active');
            document.getElementById('btn-' + tabId).className = 'tab-btn px-6 py-2.5 rounded-lg text-sm font-bold bg-white dark:bg-slate-900 text-slate-800 dark:text-white shadow-sm transition-all';
        }

        function openAddModal() {
            document.getElementById('modal-title').innerText = "Tambah Barang";
            document.getElementById('inventoryForm').action = "{{ route('teknisi.inventory.store') }}";
            document.getElementById('method-put').innerHTML = ""; 
            document.getElementById('input-name').value = "Ruijie RG-EW300N";
            document.getElementById('input-category').value = "perangkat";
            document.getElementById('input-sn').value = "";
            document.getElementById('input-qty').value = "";
            toggleFormFields();
            showModal('inventoryModal', 'invModalCard');
        }

        function openEditModal(id, name, category, sn, qty, unit) {
            document.getElementById('modal-title').innerText = "Edit Barang";
            document.getElementById('inventoryForm').action = `/teknisi/inventory/${id}`; 
            document.getElementById('method-put').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('input-name').value = name;
            document.getElementById('input-category').value = category;
            document.getElementById('input-sn').value = sn;
            document.getElementById('input-qty').value = qty;
            const unitSelect = document.getElementById('input-unit');
            for(let i=0; i<unitSelect.options.length; i++) { if(unitSelect.options[i].value === unit) unitSelect.selectedIndex = i; }
            toggleFormFields();
            showModal('inventoryModal', 'invModalCard');
        }

        function closeInvModal() { hideModal('inventoryModal', 'invModalCard'); }
        function openDeleteModal(id, name) { document.getElementById('delete-item-name').innerHTML = `Data <strong>${name}</strong> akan dihapus permanen.`; document.getElementById('deleteForm').action = `/teknisi/inventory/${id}`; showModal('deleteModal', 'deleteCard'); }
        function closeDeleteModal() { hideModal('deleteModal', 'deleteCard'); }
        function showModal(modalId, cardId) { const modal = document.getElementById(modalId); const card = document.getElementById(cardId); modal.classList.remove('hidden'); setTimeout(() => { card.classList.remove('scale-95', 'opacity-0'); }, 10); }
        function hideModal(modalId, cardId) { const modal = document.getElementById(modalId); const card = document.getElementById(cardId); card.classList.add('scale-95', 'opacity-0'); setTimeout(() => { modal.classList.add('hidden'); }, 300); }

        const indicator = document.getElementById('nav-indicator'); const navContainer = document.getElementById('nav-container'); const navLinks = document.querySelectorAll('.nav-link');
        function moveIndicatorTo(linkElement) { if (!linkElement || !navContainer) return; const containerRect = navContainer.getBoundingClientRect(); const linkRect = linkElement.getBoundingClientRect(); indicator.style.transform = `translateX(${linkRect.left - containerRect.left}px)`; indicator.style.width = `${linkRect.width}px`; }
        window.addEventListener('load', () => { const activeLink = document.querySelector('.nav-link.active-link'); if(activeLink) moveIndicatorTo(activeLink); }); window.addEventListener('resize', () => { const activeLink = document.querySelector('.nav-link.active-link'); if(activeLink) moveIndicatorTo(activeLink); });
        navLinks.forEach(link => { link.addEventListener('click', function(e) { const targetUrl = this.getAttribute('href'); if (targetUrl && targetUrl !== '#') { e.preventDefault(); navLinks.forEach(l => { l.classList.remove('active-link', 'text-white', 'font-bold'); l.classList.add('text-slate-500', 'dark:text-slate-400', 'font-medium'); }); this.classList.remove('text-slate-500', 'dark:text-slate-400', 'font-medium'); this.classList.add('active-link', 'text-white', 'font-bold'); moveIndicatorTo(this); setTimeout(() => window.location.href = targetUrl, 350); } }); });

        const themeToggleBtn = document.getElementById('theme-toggle'); const darkIcon = document.getElementById('theme-toggle-dark-icon'); const lightIcon = document.getElementById('theme-toggle-light-icon');
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) { document.documentElement.classList.add('dark'); lightIcon.classList.remove('hidden'); darkIcon.classList.add('hidden'); } else { document.documentElement.classList.remove('dark'); darkIcon.classList.remove('hidden'); lightIcon.classList.add('hidden'); }
        themeToggleBtn.addEventListener('click', function() { darkIcon.classList.toggle('hidden'); lightIcon.classList.toggle('hidden'); if (document.documentElement.classList.contains('dark')) { document.documentElement.classList.remove('dark'); localStorage.setItem('color-theme', 'light'); } else { document.documentElement.classList.add('dark'); localStorage.setItem('color-theme', 'dark'); } });
    </script>
</body>
</html>