<!DOCTYPE html>
<html>

<head>
    <title>Nota Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 80mm;
            margin: 0;
            padding: 5mm;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .bold {
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        hr {
            border-top: 1px dashed #000;
        }

        h3,
        h4,
        p {
            margin: 5px 0;
        }

        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="text-center mb-2">
        <h3>PKM KAMONING</h3>
        <p>Jl. Jaksa Agung Suprapto No.7A, Sampang</p>
        <p>Telp: (0323) 323538</p>
        <hr>
        <h4>BUKTI PEMBAYARAN</h4>
        <hr>
    </div>

    <div class="mb-2">
        <table>
            <tr>
                <td style="width: 40%;">No. Transaksi</td>
                <td>: {{ sprintf('%06d', $pembayaran->id) }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ now()->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td>: {{ $pembayaran->pendaftaran->kunjungan->nama_pasien }}</td>
            </tr>
            <tr>
                <td>No. Rekam Medik</td>
                <td>: {{ $pembayaran->pendaftaran->kunjungan->no_rekam_medik }}</td>
            </tr>
            <tr>
                <td>Tgl Periksa</td>
                <td>: {{ $pembayaran->pendaftaran->tanggal_periksa }}</td>
            </tr>
            <tr>
                <td>Poli</td>
                <td>: {{ $pembayaran->pendaftaran->poli }}</td>
            </tr>
        </table>
    </div>

    <div class="mb-2">
        <table>
            <tr>
                <td style="width: 40%;">Tinggi Badan</td>
                <td>: {{ $pembayaran->pendaftaran->fisik->tinggi_badan ?? '-' }} cm</td>
            </tr>
            <tr>
                <td>Berat Badan</td>
                <td>: {{ $pembayaran->pendaftaran->fisik->berat_badan ?? '-' }} kg</td>
            </tr>
            <tr>
                <td>Suhu Tubuh</td>
                <td>: {{ $pembayaran->pendaftaran->fisik->suhu_tubuh ?? '-' }} °C</td>
            </tr>
            <tr>
                <td>Keluhan</td>
                <td>: {{ $pembayaran->pendaftaran->pemeriksaan->keluhan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Diagnosa</td>
                <td>: {{ $pembayaran->pendaftaran->pemeriksaan->diagnosa ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="mb-2">
        <p class="bold">Pengambilan Obat Farmasi</p>
        <hr>
        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">Obat</th>
                    <th style="text-align: right;">Jumlah</th>
                    <th style="text-align: right;">Harga</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $totalObat = 0; @endphp
                @if (isset($pembayaran->pendaftaran->resep) && is_iterable($pembayaran->pendaftaran->resep))
                    @foreach ($pembayaran->pendaftaran->resep as $resep)
                        @if (is_object($resep) && isset($resep->obat) && is_object($resep->obat))
                            @php
                                $subtotal = $resep->jumlah * $resep->obat->harga;
                                $totalObat += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $resep->obat->nama }}</td>
                                <td style="text-align: right;">{{ $resep->jumlah }}</td>
                                <td style="text-align: right;">{{ number_format($resep->obat->harga) }}</td>
                                <td style="text-align: right;">{{ number_format($subtotal) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="text-align: center;">Tidak ada obat yang diresepkan</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr>
        <table>
            <tr>
                <td style="text-align: right; font-weight: bold;">Total:</td>
                <td style="text-align: right; width: 30%; font-weight: bold;">Rp.
                    {{ number_format($pembayaran->total_harga) }}</td>
            </tr>
            <tr>
                <td style="text-align: right;">Pembayaran:</td>
                <td style="text-align: right;">Rp. {{ number_format($pembayaran->pembayaran) }}</td>
            </tr>
            <tr>
                <td style="text-align: right;">Kembalian:</td>
                <td style="text-align: right;">Rp. {{ number_format($pembayaran->kembalian) }}</td>
            </tr>
        </table>
        <hr>
    </div>

    <div class="text-center mt-2">
        <p>Terima kasih atas kunjungan Anda</p>
        <p>Semoga lekas sembuh</p>
    </div>

    <script>
        // Auto-print ketika halaman dimuat
        window.onload = function() {
            window.print();
            // Opsional: Tutup jendela setelah print (jika di tab baru)
            // setTimeout(function() { window.close(); }, 500);
        }
    </script>
</body>

</html>
