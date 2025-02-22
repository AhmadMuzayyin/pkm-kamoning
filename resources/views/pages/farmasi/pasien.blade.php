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
                                            <th>Nama</th>
                                            <th>Poli</th>
                                            <th>Umur</th>
                                            <th>Kelamin</th>
                                            <th>Jenis Bayar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pasiens as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tanggal_periksa }}</td>
                                                <td>{{ $item->kunjungan->nama_pasien }}</td>
                                                <td>{{ $item->poli }}</td>
                                                <td>{{ $item->kunjungan->umur }}</td>
                                                <td>{{ $item->kunjungan->jenis_kelamin }}</td>
                                                <td>{{ $item->jenis_bayar }}</td>
                                                <td>{{ $item->status }}</td>
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
