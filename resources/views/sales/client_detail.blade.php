<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Client | ConnectMe OSS</title>
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
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen">

    <!-- NAVBAR FULL LENGKAP -->
    <nav class="bg-white dark:bg-slate-900 px-8 py-4 flex justify-between items-center sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-slate-900 dark:bg-white rounded-full flex items-center justify-center text-white dark:text-slate-900 font-bold text-lg">+</div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">ConnectMe</h1>
            </div>
            <div class="hidden md:flex items-center bg-slate-100 dark:bg-slate-800 p-1 rounded-full border border-slate-200 dark:border-slate-700">
                <a href="{{ route('sales.dashboard') }}" class="px-5 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-colors">Dashboard</a>
                <a href="{{ route('sales.clients.index') }}" class="px-5 py-2 text-sm font-bold bg-slate-900 text-white dark:bg-white dark:text-slate-900 rounded-full shadow-md">Daftar Client</a>
                <a href="{{ route('sales.ticket') }}" class="px-5 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-colors">Ticket Troubleshoot</a>
            </div>
        </div>

        <!-- Profil & Logout -->
        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                @csrf
                <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 font-extrabold flex items-center justify-center uppercase">
                    {{ substr(Auth::user()->name ?? 'SL', 0, 2) }}
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name ?? 'Sales' }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Sales Executive</p>
                </div>
                <button type="submit" class="ml-2 text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="p-8 max-w-[800px] mx-auto w-full">
        <!-- Tombol Kembali -->
        <a href="{{ route('sales.clients.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-brand-600 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>

        <!-- Header Info -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $client->name }}</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ $client->tower }} - Lantai {{ $client->floor }} Unit {{ $client->unit }}</p>
            </div>
            <div>
                @if($client->status == 'pending')
                    <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-200">Menunggu Pemasangan</span>
                @elseif($client->status == 'active')
                    <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider bg-green-50 text-green-600 border border-green-200">Aktif</span>
                @elseif(in_array($client->status, ['req_terminate', 'terminated']))
                    <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider bg-red-50 text-red-600 border border-red-200">Berhenti / Terminasi</span>
                @endif
            </div>
        </div>

        <!-- Detail Data -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                <h3 class="text-xs font-black uppercase text-slate-400 mb-4 border-b pb-2">Informasi Layanan</h3>
                <div class="space-y-3 text-sm">
                    <p><span class="text-slate-500">Paket:</span> <br><strong class="text-slate-900 dark:text-white">{{ $client->package }}</strong></p>
                    <p><span class="text-slate-500">Jadwal Pasang:</span> <br><strong class="text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($client->install_date)->format('d M Y') }}</strong></p>
                    <p><span class="text-slate-500">Telepon:</span> <br><strong class="text-slate-900 dark:text-white">{{ $client->phone_1 }}</strong></p>
                    
                    @if($client->router_sn)
                        <p class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800"><span class="text-slate-500">SN Router Terpasang:</span> <br><strong class="text-slate-900 dark:text-white font-mono text-xs bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded">{{ $client->router_sn }}</strong></p>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                <h3 class="text-xs font-black uppercase text-slate-400 mb-4 border-b pb-2">Dokumen Terlampir</h3>
                <div class="space-y-3">
                    @if($client->ktp_file)
                        <a href="{{ asset('storage/' . $client->ktp_file) }}" target="_blank" class="block text-sm font-bold text-brand-600 hover:underline">📷 Lihat Foto KTP</a>
                    @else
                        <p class="text-sm text-slate-500">Tidak ada KTP</p>
                    @endif
                    
                    @if($client->selfie_file)
                        <a href="{{ asset('storage/' . $client->selfie_file) }}" target="_blank" class="block text-sm font-bold text-brand-600 hover:underline">📷 Lihat Foto Selfie</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- SEKSI BARU: TABEL RIWAYAT TAGIHAN & PEMBAYARAN -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 mb-8">
            <div class="flex justify-between items-center mb-4 border-b border-slate-100 dark:border-slate-800 pb-2">
                <h3 class="text-xs font-black uppercase text-slate-400">Riwayat Tagihan & Pembayaran</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="text-slate-500 dark:text-slate-400 text-xs border-b border-slate-100 dark:border-slate-800">
                            <th class="pb-3 font-semibold">Keterangan / Bulan</th>
                            <th class="pb-3 font-semibold">Nominal</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold text-right">Bukti Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($client->invoices as $invoice)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="py-3 text-slate-800 dark:text-slate-200 font-bold">{{ $invoice->billing_period }}</td>
                            <td class="py-3 text-slate-600 dark:text-slate-400 font-mono">Rp{{ number_format($invoice->amount, 0, ',', '.') }}</td>
                            <td class="py-3">
                                @if($invoice->status == 'belum_bayar')
                                    <span class="text-[10px] font-black uppercase text-red-500 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Belum Bayar</span>
                                @elseif($invoice->status == 'menunggu_verifikasi')
                                    <span class="text-[10px] font-black uppercase text-amber-500 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Verifikasi Admin</span>
                                @else
                                    <span class="text-[10px] font-black uppercase text-green-500 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Lunas</span>
                                @endif
                            </td>
                            <td class="py-3 text-right">
                                @if($invoice->payment_proof)
                                    <a href="{{ asset('storage/' . $invoice->payment_proof) }}" target="_blank" class="inline-block px-3 py-1 bg-brand-50 hover:bg-brand-100 dark:bg-brand-900/20 dark:hover:bg-brand-900/40 text-brand-600 dark:text-brand-400 text-xs font-bold rounded border border-brand-200 dark:border-brand-800 transition-colors">
                                        Lihat Struk
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400 dark:text-slate-600 italic">Belum ada struk</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-slate-500 text-xs">Belum ada data tagihan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Berhenti Berlangganan -->
        @if(!in_array($client->status, ['req_terminate', 'terminated']))
        <div class="bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-900/50 p-6 rounded-2xl">
            <h3 class="text-lg font-extrabold text-red-600 dark:text-red-400 mb-2">Berhenti Langganan</h3>
            <p class="text-sm text-red-700/70 dark:text-red-400/70 mb-4">Aksi ini akan menghentikan status langganan client dan mengirim instruksi kepada Teknisi untuk menarik perangkat (Router) dari lokasi.</p>
            
            <form action="{{ route('sales.clients.terminate', $client->id) }}" method="POST" onsubmit="return confirm('Yakin ingin memberhentikan layanan client ini secara permanen?');">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-lg text-sm font-bold shadow-lg shadow-red-500/30 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Putus Langganan (Terminasi)
                </button>
            </form>
        </div>
        @endif

    </main>

</body>
</html>