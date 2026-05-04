<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Client Baru | ConnectMe OSS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Styling untuk input file */
        input[type="file"]::file-selector-button {
            border: none;
            background: #eff6ff;
            color: #2563eb;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            cursor: pointer;
            transition: background 0.2s;
            margin-right: 16px;
        }
        .dark input[type="file"]::file-selector-button {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }
        /* Custom slide animation for payment proof */
        .slide-down { animation: slideDown 0.3s ease-out forwards; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); height: 0; overflow: hidden;} to { opacity: 1; transform: translateY(0); height: auto; overflow: visible;} }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300 overflow-x-hidden">

    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-slate-900 dark:bg-white rounded-full flex items-center justify-center text-white dark:text-slate-900 font-bold text-lg shadow-md">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>

            <div id="nav-container" class="hidden md:flex items-center relative bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700 transition-colors">
                <div id="nav-indicator" class="absolute top-1 bottom-1 bg-slate-900 dark:bg-white rounded-full shadow-md z-0"></div>
                <a href="{{ route('sales.dashboard') }}" class="nav-link relative z-10 px-5 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300">Dashboard</a>
                <a href="#" class="nav-link active-link relative z-10 px-5 py-2 text-sm font-bold text-white dark:text-slate-900 transition-colors duration-300">Daftar Client</a>
                <a href="{{ route('sales.ticket') }}" class="nav-link relative z-10 px-5 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300">Ticket Troubleshoot</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors focus:outline-none">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-1.32 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.32a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm1.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path></svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>
            <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-extrabold flex items-center justify-center uppercase">
                {{ substr(Auth::user()->name ?? 'SL', 0, 2) }}
            </div>
        </div>
    </nav>

    <main class="flex-1 p-8 max-w-[1000px] mx-auto w-full animate-fade-in">
        
        <a href="{{ route('sales.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-brand-600 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>

        <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-card border border-slate-200 dark:border-slate-800 overflow-hidden">
            
            <div class="p-8 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Formulir Registrasi Klien</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm">Lengkapi data pribadi dan informasi lokasi pemasangan.</p>
            </div>

            <form action="{{ route('sales.clients.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                
                <!-- BAGIAN 1: DATA PRIBADI -->
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-brand-600 dark:text-brand-400 mb-4 pb-2 border-b border-slate-100 dark:border-slate-800">1. Data Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">No. KTP / NIK <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" required pattern="[0-9]{16}" placeholder="16 Digit NIK" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Kewarganegaraan <span class="text-red-500">*</span></label>
                            <select name="nationality" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500 cursor-pointer">
                                <option value="WNI">WNI (Warga Negara Indonesia)</option>
                                <option value="WNA">WNA (Warga Negara Asing)</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap (Sesuai KTP) <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required placeholder="Nama lengkap..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="birth_place" required placeholder="Kab/Kota" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="birth_date" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="gender" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500 cursor-pointer">
                                <option value="" disabled selected>Pilih...</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Pekerjaan <span class="text-red-500">*</span></label>
                            <input type="text" name="occupation" required placeholder="Pekerjaan saat ini" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: KONTAK -->
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-brand-600 dark:text-brand-400 mb-4 pb-2 border-b border-slate-100 dark:border-slate-800">2. Informasi Kontak</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">No. HP 1 (WhatsApp) <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 bg-slate-100 dark:bg-slate-800 border border-r-0 border-slate-200 dark:border-slate-700 rounded-l-lg text-slate-500 dark:text-slate-400 text-sm font-bold">+62</span>
                                <input type="tel" name="phone_1" required placeholder="81234567890" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-r-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Email Aktif <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required placeholder="example@mail.com" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">No. HP 2 (Alternatif)</label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 bg-slate-100 dark:bg-slate-800 border border-r-0 border-slate-200 dark:border-slate-700 rounded-l-lg text-slate-500 dark:text-slate-400 text-sm font-bold">+62</span>
                                <input type="tel" name="phone_2" placeholder="Opsional" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-r-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 3: LOKASI PASANG -->
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-brand-600 dark:text-brand-400 mb-4 pb-2 border-b border-slate-100 dark:border-slate-800">3. Alamat Pemasangan</h3>
                    
                    <div class="mb-5">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Residence <span class="text-red-500">*</span></label>
                        <select name="residence" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500 cursor-pointer">
                            <option value="Gading Nias Residence">Gading Nias Residence</option>
                            <option value="MT Haryono">MT Haryono</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tower<span class="text-red-500">*</span></label>
                            <select name="tower" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500 cursor-pointer">
                                <option value="" disabled selected>Pilih...</option>
                                <option value="Alamanda">Alamanda</option>
                                <option value="Bougenville">Bougenville</option>
                                <option value="Chrysant">Chrysant</option>
                                <option value="Dahlia">Dahlia</option>
                                <option value="Emerald">Emerald</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Lantai <span class="text-red-500">*</span></label>
                            <input type="text" name="floor" required placeholder="Lantai" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">No Unit <span class="text-red-500">*</span></label>
                            <input type="text" name="unit" required placeholder="No Unit" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Status Unit <span class="text-red-500">*</span></label>
                        <div class="flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer text-sm">
                                <input type="radio" name="unit_status" value="Milik Sendiri" required class="text-brand-600 focus:ring-brand-500 w-4 h-4">
                                Milik Sendiri
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer text-sm">
                                <input type="radio" name="unit_status" value="Sewa" required class="text-brand-600 focus:ring-brand-500 w-4 h-4">
                                Sewa
                            </label>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 4: LAYANAN & JADWAL -->
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-brand-600 dark:text-brand-400 mb-4 pb-2 border-b border-slate-100 dark:border-slate-800">4. Layanan & Penjadwalan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Pilih Paket <span class="text-red-500">*</span></label>
                            <select name="package" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-[11px] font-medium rounded-lg px-3 py-2.5 outline-none focus:ring-2 focus:ring-brand-500 cursor-pointer">
                                <option value="" disabled selected>Pilih Paket Internet...</option>
                                <option value="promo_30_1m">Promo Awal Tahun 30 MBPS 1 Bulan (Rp100.000/bln) Diskon Biaya Instalasi 50% (Rp150.000) = Rp250.000</option>
                                <option value="promo_30_3m">Promo Awal Tahun 30 MBPS 3 Bulan (Rp100.000/bln) + Gratis Biaya Pendaftaran Dan Gratis Biaya Instalasi (Rp0) = Rp276.000</option>
                                <option value="promo_30_6m">Promo Awal Tahun 30 MBPS 6 Bulan (Rp100.000/bln) + Gratis Biaya Pendaftaran Dan Gratis Biaya Instalasi (Rp0) = Rp516.000</option>
                                <option value="promo_50_1y">Promo Awal Tahun 50 MBPS 1 Tahun (Rp140.000/bln) + Gratis Biaya Pendaftaran Dan Gratis Biaya Instalasi (Rp0) = Rp1.344.000</option>
                                <option value="promo_50_3m">Promo Awal Tahun 50 MBPS 3 Bulan (Rp140.000/bln) + Gratis Biaya Pendaftaran Dan Gratis Biaya Instalasi (Rp0) = Rp386.400</option>
                                <option value="promo_50_6m">Promo Awal Tahun 50 MBPS 6 Bulan (Rp140.000/bln) + Gratis Biaya Pendaftaran Dan Gratis Biaya Instalasi (Rp0) = Rp722.400</option>
                                <option value="promo_spesial_50_1m">Promo Spesial 50 MBPS 1 Bulan (Rp140.000/bln) Diskon Biaya Instalasi 50% (Rp150.000) = Rp290.000</option>
                            </select>
                            
                            <p class="text-[10px] text-brand-600 dark:text-brand-400 mt-1.5 font-bold flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Nominal di atas belum termasuk PPN 11% (akan otomatis ditambahkan di Billing).
                            </p>
                        </div>
                        
                        <div class="relative">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 flex justify-between">
                                <span>Tanggal Pemasangan <span class="text-red-500">*</span></span>
                                <span id="quota-msg" class="text-[10px] text-amber-500 hidden font-black">Kuota harian tercapai!</span>
                            </label>
                            <input type="text" id="install-date" name="install_date" required placeholder="Pilih tanggal..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-brand-500 cursor-pointer">
                            <p class="text-[10px] text-slate-500 mt-1">Hanya Senin-Jumat. Dianjurkan maks 2 pasang/hari.</p>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 5: UPLOAD DOKUMEN -->
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-brand-600 dark:text-brand-400 mb-4 pb-2 border-b border-slate-100 dark:border-slate-800">5. Unggah Dokumen</h3>
                    <div class="space-y-5">
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Upload Kartu Identitas (KTP) <span class="text-red-500">*</span></label>
                            <input type="file" name="ktp_file" accept="image/*,.pdf" required class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 border border-slate-200 dark:border-slate-700 rounded-lg p-1.5 bg-slate-50 dark:bg-slate-950">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center gap-2">
                                Upload Foto Selfie + Kartu Identitas
                                <span class="text-[9px] px-1.5 py-0.5 bg-slate-200 dark:bg-slate-700 text-slate-500 rounded uppercase">Optional</span>
                            </label>
                            <input type="file" name="selfie_file" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 border border-slate-200 dark:border-slate-700 rounded-lg p-1.5 bg-slate-50 dark:bg-slate-950">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center gap-2">
                                Dokumen Pendukung (Tagihan Listrik / Air)
                                <span class="text-[9px] px-1.5 py-0.5 bg-slate-200 dark:bg-slate-700 text-slate-500 rounded uppercase">Optional</span>
                            </label>
                            <input type="file" name="support_doc" accept="image/*,.pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 border border-slate-200 dark:border-slate-700 rounded-lg p-1.5 bg-slate-50 dark:bg-slate-950">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                                <span class="flex items-center gap-2">Surat Kuasa (Tenant) <span class="text-[9px] px-1.5 py-0.5 bg-slate-200 dark:bg-slate-700 text-slate-500 rounded uppercase">Optional</span></span>
                                <a href="#" class="text-brand-600 hover:underline">Download Contoh</a>
                            </label>
                            <input type="file" name="power_of_attorney" accept="image/*,.pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 border border-slate-200 dark:border-slate-700 rounded-lg p-1.5 bg-slate-50 dark:bg-slate-950">
                        </div>

                    </div>
                </div>

                <!-- BAGIAN 6: STATUS PEMBAYARAN -->
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-amber-600 dark:text-amber-500 mb-4 pb-2 border-b border-slate-100 dark:border-slate-800">6. Status Pembayaran</h3>
                    
                    <div class="mb-4">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <!-- Opsi Belum Bayar -->
                            <label class="flex items-center gap-3 cursor-pointer bg-slate-50 dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-brand-300 transition-colors w-full">
                                <input type="radio" name="payment_status" value="belum_bayar" class="w-5 h-5 text-brand-600 focus:ring-brand-500" checked onchange="togglePaymentProof()">
                                <div>
                                    <span class="block text-sm font-bold text-slate-800 dark:text-slate-200">Client Belum Bayar</span>
                                    <span class="block text-xs text-slate-500 mt-0.5">Lanjut instalasi, tagihan bisa disusulkan.</span>
                                </div>
                            </label>
                            
                            <!-- Opsi Sudah Transfer -->
                            <label class="flex items-center gap-3 cursor-pointer bg-slate-50 dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-brand-300 transition-colors w-full">
                                <input type="radio" name="payment_status" value="menunggu_verifikasi" class="w-5 h-5 text-brand-600 focus:ring-brand-500" onchange="togglePaymentProof()">
                                <div>
                                    <span class="block text-sm font-bold text-slate-800 dark:text-slate-200">Client Sudah Transfer</span>
                                    <span class="block text-xs text-slate-500 mt-0.5">Upload struk untuk diverifikasi Admin.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Kotak Upload Struk (Hidden by default) -->
                    <div id="payment-proof-container" class="hidden slide-down bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-900/50 p-5 rounded-xl">
                        <label class="block text-xs font-bold text-amber-700 dark:text-amber-500 mb-2">Upload Bukti Transfer <span class="text-red-500">*</span></label>
                        <input type="file" name="payment_proof" id="payment_proof_input" accept="image/*,.pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-white file:text-amber-700 hover:file:bg-amber-100 border border-amber-200/50 dark:border-amber-700/50 rounded-lg p-1 bg-white/50 dark:bg-slate-900">
                    </div>
                </div>

                <!-- TOMBOL SUBMIT -->
                <div class="flex items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-800 pt-6">
                    <button type="submit" id="btn-submit" class="bg-brand-600 hover:bg-brand-700 text-white px-8 py-3 rounded-lg text-sm font-bold shadow-lg transition-all focus:ring-4 focus:ring-brand-500/50">
                        Add Client
                    </button>
                </div>

            </form>
        </div>
    </main>

    <script>
        // --- LOGIKA TOGGLE BUKTI BAYAR ---
        function togglePaymentProof() {
            const status = document.querySelector('input[name="payment_status"]:checked').value;
            const container = document.getElementById('payment-proof-container');
            const fileInput = document.getElementById('payment_proof_input');

            if (status === 'menunggu_verifikasi') {
                container.classList.remove('hidden');
                fileInput.required = true;
            } else {
                container.classList.add('hidden');
                fileInput.required = false;
                fileInput.value = ''; // Reset file input
            }
        }

        // Data Jadwal Dummy (Nanti diganti dengan data dari backend/database)
        const bookedDates = {
            '2026-05-04': 2,
            '2026-05-05': 1,
            '2026-05-06': 3
        };

        const today = new Date();

        // Inisialisasi Flatpickr
        flatpickr("#install-date", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: [
                function(date) {
                    return (date.getDay() === 0 || date.getDay() === 6);
                }
            ],
            onChange: function(selectedDates, dateStr, instance) {
                const msgEl = document.getElementById('quota-msg');
                const btnSubmit = document.getElementById('btn-submit');
                
                if (bookedDates[dateStr] && bookedDates[dateStr] >= 2) {
                    msgEl.classList.remove('hidden');
                    msgEl.textContent = "Peringatan: Jadwal padat (" + bookedDates[dateStr] + " pasang).";
                } else {
                    msgEl.classList.add('hidden');
                }
            }
        });

        // --- ANIMASI NAVIGASI YANG DIPERBAIKI ---
        const indicator = document.getElementById('nav-indicator');
        const navContainer = document.getElementById('nav-container');

        function moveIndicatorTo(linkElement) {
            if (!linkElement || !navContainer || !indicator) return;
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
        });

        window.addEventListener('resize', () => {
            const activeLink = document.querySelector('.nav-link.active-link');
            if(activeLink) moveIndicatorTo(activeLink);
        });

        // Theme Toggle Logic
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