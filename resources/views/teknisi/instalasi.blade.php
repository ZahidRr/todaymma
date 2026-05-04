<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalasi Baru | Engineer OSS</title>
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
                        'glow': '0 0 15px -2px rgba(168, 85, 247, 0.4)'
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
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>

            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                @csrf
                <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 font-extrabold flex items-center justify-center uppercase">
                    {{ substr(Auth::user()->name ?? 'TE', 0, 2) }}
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name ?? 'Teknisi' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Engineer</p>
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
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-purple-100 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Daftar Instalasi Baru 🚀</h2>
                </div>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium ml-12">Clint baru yang menunggu penarikan kabel dan pemasangan perangkat.</p>
            </div>
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl mb-4" role="alert">
                <span class="block sm:inline font-bold">{{ session('success') }}</span>
            </div>
            @endif

            <div class="relative w-full md:w-96 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-purple-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" placeholder="Cari unit atau client..." class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-sm font-bold focus:ring-2 focus:ring-purple-500 outline-none transition-all shadow-sm">
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-400 dark:text-slate-500 text-[11px] uppercase tracking-wider font-extrabold border-b border-slate-100 dark:border-slate-800">
                        <tr>
                            <th class="p-6 pl-6">ID & Waktu Daftar</th>
                            <th class="p-6">Lokasi & Client</th>
                            <th class="p-6">Sales / Pendaftar</th>
                            <th class="p-6">Paket Layanan</th>
                            <th class="p-6 text-center">Status</th>
                            <th class="p-6 text-right pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        
                        <!-- LOOPING DATA ASLI DARI DATABASE -->
                        @forelse($pendingInstalls as $install)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors {{ $loop->first ? 'bg-purple-50/20 dark:bg-purple-900/5' : '' }}">
                            <td class="p-6 {{ $loop->first ? 'border-l-4 border-purple-500' : '' }}">
                                <p class="font-bold text-slate-800 dark:text-slate-200 text-sm font-mono">#INS-{{ \Carbon\Carbon::parse($install->created_at)->format('ym') }}-{{ str_pad($install->id, 3, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-[10px] font-bold text-slate-500 mt-1">{{ \Carbon\Carbon::parse($install->created_at)->diffForHumans() }}</p>
                            </td>
                            <td class="p-6">
                                <p class="font-mono text-[11px] font-black text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-2 py-0.5 rounded w-max mb-1">
                                    {{ substr($install->tower, 0, 1) }}/{{ $install->floor }}/{{ $install->unit }}
                                </p>
                                <p class="font-bold text-slate-600 dark:text-slate-400 text-xs">{{ $install->name }}</p>
                            </td>
                            <td class="p-6">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-[9px]">
                                        {{ strtoupper(substr($install->sales->name ?? 'SL', 0, 2)) }}
                                    </div>
                                    <p class="text-xs font-bold text-slate-600 dark:text-slate-400">{{ $install->sales->name ?? '-' }}</p>
                                </div>
                            </td>
                            <td class="p-6">
                                <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">{{ explode(' ', $install->package)[0] ?? $install->package }}</p>
                                <span class="inline-block mt-1 px-2 py-0.5 bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[9px] font-black uppercase rounded">
                                    {{ $install->package }}
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <span class="inline-flex items-center gap-1.5 text-amber-600 dark:text-amber-400 text-xs font-bold bg-amber-50 dark:bg-amber-900/20 px-3 py-1 rounded-full border border-amber-200 dark:border-amber-800/50">
                                    Menunggu Instalasi
                                </span>
                            </td>
                            <td class="p-6 text-right pr-6">
                                <button onclick="openModal('{{ $install->id }}', '{{ addslashes($install->name) }}', '{{ $install->tower }} / Lt.{{ $install->floor }} / Unit {{ $install->unit }}', '{{ addslashes($install->sales->name ?? 'Unknown') }}')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-bold text-xs shadow-glow transition-all hover:-translate-y-0.5 focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 
                                    Selesaikan
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center">
                                <div class="flex flex-col items-center justify-center animate-fade-in">
                                    <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mb-4 text-slate-400">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="text-xl font-extrabold text-slate-700 dark:text-slate-300">Antrean Bersih! ✨</h3>
                                    <p class="text-sm text-slate-500 font-medium mt-2">Belum ada client baru yang menunggu instalasi saat ini. Saatnya ngopi dulu!</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- MODAL POPUP -->
    <div id="actionModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <!-- Modal Card diperlebar sedikit agar input sejajar -->
        <div class="bg-white dark:bg-slate-900 w-full max-w-2xl rounded-[32px] p-8 shadow-2xl z-10 border border-slate-200 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="modalCard">
            
            <div class="flex justify-between items-start mb-6">
                <div>
                    <div id="modal-icon-container" class="w-12 h-12 rounded-full mb-4 flex items-center justify-center bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Selesaikan Instalasi</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Masukkan detail material yang terpakai di lapangan.</p>
                </div>
            </div>
            
            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50 mb-6 flex justify-between items-center">
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Target Lokasi</p>
                    <p class="text-lg font-mono font-black text-slate-800 dark:text-white" id="modal-target-unit"></p>
                    <p class="text-sm font-bold text-slate-500 mt-1" id="modal-target-name"></p>
                </div>
                <div class="text-right border-l border-slate-200 dark:border-slate-700 pl-4">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Sales Minta</p>
                    <p class="text-sm font-black text-brand-600 dark:text-brand-400" id="modal-sales-name"></p>
                </div>
            </div>
            
            <!-- FORM SUBMIT KE CONTROLLER -->
            <form method="POST" action="{{ route('teknisi.execute') }}">
                @csrf
                <input type="hidden" name="customer_id" id="modal-ticket-id">
                
                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <!-- INPUT KABEL UTP & SUMBER BOX (Kolom Kiri) -->
                    <div class="bg-purple-50 dark:bg-purple-900/10 p-5 rounded-2xl border border-purple-100 dark:border-purple-800/50 flex flex-col gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-600 dark:text-purple-400 mb-2">Pilih Sumber Box Kabel</label>
                            <select name="cable_sn" class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-purple-500 outline-none text-slate-800 dark:text-white appearance-none cursor-pointer">
                                <option value="" disabled selected>-- Pilih Box/Gudang --</option>
                                <!-- Looping data Box Kabel -->
                                @foreach($cables as $cable)
                                    <option value="{{ $cable->serial_number }}">
                                        {{ $cable->serial_number ?? 'Utama' }} (Sisa: {{ $cable->stock_quantity }}M)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-600 dark:text-purple-400 mb-2">Pemakaian Kabel (Meter)</label>
                            <input type="number" name="kabel_terpakai" placeholder="Cth: 45" required class="w-full font-mono bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-purple-500 outline-none text-slate-800 dark:text-white">
                        </div>
                    </div>

                    <!-- DROPDOWN DINAMIS ROUTER (Kolom Kanan) -->
                    <div class="bg-purple-50 dark:bg-purple-900/10 p-5 rounded-2xl border border-purple-100 dark:border-purple-800/50">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-purple-600 dark:text-purple-400 mb-2">Pilih Router (Serial Number)</label>
                        <select name="router_sn" required class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-purple-500 outline-none text-slate-800 dark:text-white appearance-none cursor-pointer h-[104px]" size="4">
                            <!-- Looping data router (Tersedia) -->
                            @forelse($routers as $router)
                                <option value="{{ $router->serial_number }}" class="p-2 mb-1 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/30 font-mono text-sm border border-transparent hover:border-purple-200 dark:hover:border-purple-800 transition-colors cursor-pointer">
                                    {{ $router->serial_number }}
                                </option>
                            @empty
                                <option disabled class="text-slate-400 p-2 italic text-center">-- Stok Router Kosong --</option>
                            @endforelse
                        </select>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-3 text-center">Klik pada Serial Number yang tertera di kardus perangkat.</p>
                    </div>

                </div>
                
                <div class="flex gap-3 mt-8">
                    <button type="button" onclick="closeModal()" class="flex-1 py-4 font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 text-white bg-green-500 hover:bg-green-600 shadow-lg shadow-green-500/30 font-bold py-4 rounded-xl transition-colors">Simpan & Aktifkan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function openModal(ticketId, clientName, unit, salesName) {
            const modal = document.getElementById('actionModal');
            const card = document.getElementById('modalCard');
            
            document.getElementById('modal-ticket-id').value = ticketId;
            document.getElementById('modal-target-name').innerText = clientName;
            document.getElementById('modal-target-unit').innerText = unit;
            document.getElementById('modal-sales-name').innerText = salesName;
            
            modal.classList.remove('hidden');
            setTimeout(() => { 
                card.classList.remove('scale-95', 'opacity-0'); 
                card.classList.add('scale-100', 'opacity-100'); 
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('actionModal');
            const card = document.getElementById('modalCard');
            card.classList.remove('scale-100', 'opacity-100'); 
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

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