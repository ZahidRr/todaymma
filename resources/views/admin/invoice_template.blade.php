<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $invoice->customer->name }}</title>
    <style>
        /* DOMPDF CSS Reset & Setup */
        @page { margin: 0px; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; margin: 0; padding: 0; color: #2A2A2A; font-size: 13px; }
        
        /* Layout Pembungkus Utama */
        .container { padding: 40px 50px; }
        
        /* Utility Classes */
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        
        /* Header & Warna */
        .text-purple { color: #3b1c4a; }
        .text-pink { color: #f055a4; }
        .bg-gray { background-color: #e5e7eb; }
        
        /* Desain Tabel Item */
        .table-items { width: 100%; margin-top: 20px; }
        .table-items th {
            /* Fallback warna mirip gradien di gambar */
            background-color: #c04eb5; 
            color: #ffffff;
            padding: 12px;
            font-weight: bold;
            border: none;
        }
        .table-items td {
            padding: 15px 12px;
            border-bottom: 1px solid #cbd5e1;
        }

        /* Footer Bawah Sendiri */
        .bottom-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background-color: #cc55aa; /* Warna pink bawah */
            color: white;
            text-align: center;
            line-height: 40px;
            font-size: 14px;
            font-weight: bold;
        }

        /* Kotak Total & Payment */
        .box-total {
            background-color: #e2e8f0;
            padding: 15px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- HEADER: LOGO & JUDUL -->
        <table>
            <tr>
                <!-- Area Judul Invoice -->
                <td style="width: 50%;">
                    <!-- (Opsional) Titik-titik orange di atas kiri bisa pakai gambar logo nantinya -->
                    <h1 class="text-purple font-bold" style="font-size: 42px; margin: 0;">Invoice</h1>
                    <h2 class="text-pink" style="font-size: 24px; margin: 0; font-weight: normal;">MMA Connect Me</h2>
                </td>
                
                <!-- Area Nomor Invoice -->
                <td class="text-right" style="width: 50%; padding-top: 15px;">
                    <!-- LOGO PERUSAHAAN BISA TARUH DISINI MENGGUNAKAN TAG <img src="..."> -->
                    
                    <table style="width: 100%; margin-top: 20px;">
                        <tr>
                            <td class="font-bold text-purple" style="width: 50%; text-align: right; padding-right: 15px;">Invoice No:</td>
                            <!-- Auto Generate No Invoice (TahunBulan + ID Tagihan) -->
                            <td class="font-bold" style="width: 50%; text-align: right;">{{ \Carbon\Carbon::parse($invoice->created_at)->format('ym') }}{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold text-purple" style="text-align: right; padding-right: 15px;">Invoice Date:</td>
                            <td class="font-bold" style="text-align: right;">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold text-purple" style="text-align: right; padding-right: 15px;">Due Date:</td>
                            <td class="font-bold" style="text-align: right;">{{ \Carbon\Carbon::parse($invoice->created_at)->addDays(7)->format('d M, Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <hr style="border: 0; border-top: 1px solid #fff; margin: 20px 0;"> <!-- Spasi -->

        <!-- INFO CLIENT & ALAMAT -->
        <table>
            <tr>
                <td style="width: 50%; line-height: 1.6;">
                    <span class="font-bold text-purple">To : {{ $invoice->customer->name }}</span><br>
                    <span class="font-bold text-purple">ID : {{ $invoice->customer->nik }}</span><br>
                    <span class="font-bold text-purple">Mobile: {{ $invoice->customer->phone_1 }}</span>
                </td>
                <td class="text-right" style="width: 50%; line-height: 1.6;">
                    <span class="font-bold text-purple">Alamat: Apartemen {{ $invoice->customer->residence }}</span><br>
                    <span class="font-bold text-purple">Tower {{ $invoice->customer->tower }} Lantai {{ $invoice->customer->floor }} Nomor {{ $invoice->customer->unit }}</span><br>
                    <span class="font-bold text-purple">Jakarta</span>
                </td>
            </tr>
        </table>

        <!-- TABEL RINCIAN TAGIHAN -->
        <table class="table-items">
            <tr>
                <th style="width: 10%; text-align: center; background-color: #6b46c1;">No.</th>
                <th style="width: 60%; text-align: left; padding-left: 20px;">Description</th>
                <th style="width: 30%; text-align: right; background-color: #ec4899; padding-right: 20px;">Amount</th>
            </tr>
            
            <!-- ITEM 1: PAKET INTERNET -->
            <tr>
                <td class="text-center font-bold">1</td>
                <td style="padding-left: 20px;">
                    <span class="font-bold text-purple">Pembayaran Internet Basic Up to {{ explode('MBPS', strtoupper($invoice->customer->package))[0] ?? $invoice->customer->package }} MBPS</span><br>
                    <span style="color: #475569; font-size: 12px;">Periode {{ $invoice->billing_period }}</span>
                </td>
                <td class="text-right font-bold">Rp. {{ number_format($invoice->amount, 0, ',', '.') }},-</td>
            </tr>

            <!-- ITEM 2: PAJAK 12% (Menyesuaikan gambar terbaru) -->
            @php 
                $taxAmount = $invoice->amount * 0.12; 
                $grandTotal = $invoice->amount + $taxAmount;
            @endphp
            <tr>
                <td class="text-center font-bold">2</td>
                <td style="padding-left: 20px;" class="font-bold text-purple">Tax 12%</td>
                <td class="text-right font-bold">Rp. {{ number_format($taxAmount, 0, ',', '.') }},-</td>
            </tr>
        </table>

        <div style="height: 30px;"></div> <!-- Spasi -->

        <!-- FOOTER: INFO PEMBAYARAN & KONTAK -->
        <table>
            <tr>
                <!-- Kiri: Kontak & TTD -->
                <td style="width: 50%;">
                    <p class="font-bold text-purple" style="margin-bottom: 5px;">Sincerely,</p>
                    <h3 class="text-purple" style="font-style: italic; margin: 0;">ConnectMe</h3>
                    <p class="text-pink font-bold" style="margin: 0; margin-bottom: 20px;">powered by MMA</p>

                    <p class="font-bold" style="font-size: 16px; margin: 0;">Dapatkan promo menarik<br>Member Get Member!!</p>
                    <p class="font-bold" style="font-size: 14px; margin: 5px 0;">Free 1 bulan berlangganan</p>
                    <p style="font-size: 10px; font-style: italic; color: #64748b; margin-top: 0;">*syarat dan ketentuan berlaku</p>

                    <div style="margin-top: 20px;">
                        <p class="font-bold text-purple" style="margin-bottom: 5px;">HUBUNGI:</p>
                        <p style="margin: 0; font-size: 12px;"><strong>Instagram</strong> @connectmemma</p>
                        <p style="margin: 0; font-size: 12px; margin-top: 5px;"><strong>Whatsapp Connect me</strong><br>Support Official (0851-8667-1177)</p>
                    </div>
                </td>

                <!-- Kanan: Total & Rekening Bank -->
                <td style="width: 50%; padding-left: 30px;">
                    <!-- Kotak Total -->
                    <div class="box-total font-bold text-purple">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 40%;">Total IDR</td>
                                <td style="width: 10%; text-align: center;">|</td>
                                <td style="width: 50%; text-align: right;">{{ number_format($grandTotal, 0, ',', '.') }},-</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Info Bank -->
                    <div class="text-center" style="margin-top: 30px;">
                        <h2 class="text-purple font-bold" style="font-size: 20px; margin-bottom: 10px;">Payment to:</h2>
                        <p class="font-bold" style="margin: 5px 0; font-size: 16px;">PT Multi Media Access</p>
                        <p style="margin: 5px 0;">Bank Mandiri<br>No. Rekening: 1090009791393</p>
                        
                        <p style="margin-top: 15px; margin-bottom: 5px;">Atas Nama:</p>
                        <p class="font-bold" style="margin: 0; font-size: 16px;">MULTI MEDIA ACCESS</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- PITA BAWAH (WEBSITE) -->
    <div class="bottom-bar">
        www.connectme-mma.com
    </div>

</body>
</html>