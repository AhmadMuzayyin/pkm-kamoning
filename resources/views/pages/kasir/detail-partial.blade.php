<div class="container-fluid px-0">
    <div class="row mb-3">
        <div class="col-md-6">
            <h6 class="mb-2">Informasi Pasien</h6>
            <table class="table table-bordered">
                <tr>
                    <th width="40%">Nama Pasien</th>
                    <td>{{ $pembayaran->pendaftaran->kunjungan->nama_pasien }}</td>
                </tr>
                <tr>
                    <th>No. Rekam Medik</th>
                    <td>{{ $pembayaran->pendaftaran->kunjungan->no_rekam_medik }}</td>
                </tr>
                <tr>
                    <th>Tanggal Periksa</th>
                    <td>{{ $pembayaran->pendaftaran->tanggal_periksa }}</td>
                </tr>
                <tr>
                    <th>Poli</th>
                    <td>{{ $pembayaran->pendaftaran->poli }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h6 class="mb-2">Informasi Pemeriksaan</h6>
            <table class="table table-bordered">
                <tr>
                    <th width="40%">Keluhan</th>
                    <td>{{ $pembayaran->pendaftaran->pemeriksaan->keluhan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Diagnosa</th>
                    <td>{{ $pembayaran->pendaftaran->pemeriksaan->diagnosa ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tindakan</th>
                    <td>{{ $pembayaran->pendaftaran->tindakan->tindakan ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <h6 class="mb-2">Daftar Obat</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $totalObat = 0; @endphp
            @forelse($validResep as $index => $resep)
                @php
                    $subtotal = $resep->jumlah * $resep->obat->harga;
                    $totalObat += $subtotal;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $resep->obat->nama }}</td>
                    <td>{{ $resep->jumlah }}</td>
                    <td>Rp. {{ number_format($resep->obat->harga) }}</td>
                    <td>Rp. {{ number_format($subtotal) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada obat yang diresepkan</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Total</th>
                <th>Rp. {{ number_format($totalObat) }}</th>
            </tr>
        </tfoot>
    </table>

    <h6 class="mb-2">Informasi Pembayaran</h6>
    <table class="table table-bordered">
        <tr>
            <th width="40%">Total Biaya</th>
            <td>Rp. {{ number_format($pembayaran->total_harga) }}</td>
        </tr>
        <tr>
            <th>Jumlah Pembayaran</th>
            <td>Rp. {{ number_format($pembayaran->pembayaran) }}</td>
        </tr>
        <tr>
            <th>Kembalian</th>
            <td>Rp. {{ number_format($pembayaran->kembalian) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="badge {{ $pembayaran->status == 'Lunas' ? 'bg-success' : 'bg-danger' }}">
                    {{ $pembayaran->status }}
                </span>
            </td>
        </tr>
    </table>
</div>
