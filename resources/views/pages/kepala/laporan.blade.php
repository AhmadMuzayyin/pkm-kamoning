<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ __('Laporan ' . Str::ucfirst(request()->get('term', ''))) }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg-main">
                        <div class="card-body">
                            @if (isset($laporan) && count($laporan) > 0)
                                <div class="d-flex justify-content-between mb-3">
                                    <a href="{{ route('kepala.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </a>
                                    <a href="{{ route('kepala.export', request()->all()) }}" class="btn btn-success">
                                        <i class="bi bi-file-excel"></i> Unduh Excel
                                    </a>
                                </div>
                                <div class="table-responsive mt-2 text-dark">
                                    <table class="table" id="table">
                                        <thead>
                                            <tr class="tr">
                                                <th>No</th>
                                                <th>Tgl Periksa</th>
                                                <th>No Rekam Medik</th>
                                                <th>NIK</th>
                                                <th>Nama Pasien</th>
                                                <th>Umur</th>
                                                <th>JK</th>
                                                <th>Jenis Bayar</th>
                                                <th>Diagnosa</th>
                                                <th>Nama Obat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($laporan as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->tanggal_periksa }}</td>
                                                    <td>{{ $item->no_rekam_medik }}</td>
                                                    <td>{{ $item->nik }}</td>
                                                    <td>{{ $item->nama_pasien }}</td>
                                                    <td>{{ $item->umur }}</td>
                                                    <td>{{ $item->jenis_kelamin }}</td>
                                                    <td>{{ $item->jenis_bayar }}</td>
                                                    <td>{{ $item->diagnosa ?? '-' }}</td>
                                                    <td>{{ $item->nama_obat ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Tidak ada data yang tersedia untuk periode yang dipilih.
                                    <a href="{{ route('kepala.index') }}" class="alert-link">Kembali</a> untuk
                                    memilih periode lain.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    responsive: true,
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "search": "Cari:",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    },
                    // "dom": 'Bfrtip',
                    // "buttons": [
                    //     'copy', 'csv', 'excel', 'pdf', 'print'
                    // ]
                });
            });
        </script>
    @endpush
</x-app-layout>
