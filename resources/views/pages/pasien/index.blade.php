<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ __('Data Pasien') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg-main">
                        <div class="card-body">
                            <div class="table-responsive mt-2 text-dark">
                                <table class="table" id="table">
                                    <thead>
                                        <tr class="tr">
                                            <th>NO</th>
                                            <th>Tgl Periksa</th>
                                            <th>No RM</th>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Kelamin</th>
                                            <th>Jenis Bayar</th>
                                            <th>Status</th>
                                            <th>Pemeriksaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pasiens as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tanggal_periksa }}</td>
                                                <td>{{ $item->kunjungan->no_rekam_medik }}</td>
                                                <td>{{ $item->kunjungan->nama_pasien }}</td>
                                                <td>{{ $item->kunjungan->umur }}</td>
                                                <td>{{ $item->kunjungan->jenis_kelamin }}</td>
                                                <td>{{ $item->jenis_bayar }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    @if ($item->status == 'Selesai')
                                                        <a href="{{ route('pasien.show', $item->id) }}"
                                                            class="btn btn-sm btn-primary">Detail</a>
                                                    @else
                                                        <a href="{{ route('pasien.periksa', $item->id) }}">
                                                            <x-b-primary-button>
                                                                Periksa
                                                            </x-b-primary-button>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#table').DataTable();
            });
        </script>
    @endpush
</x-app-layout>
