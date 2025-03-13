<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            @php
                if (request()->get('poli') == 'Umum') {
                    echo 'Pasien Umum';
                } elseif (request()->get('poli') == 'Gigi') {
                    echo 'Pasien Gigi';
                } elseif (request()->get('poli') == 'KIA') {
                    echo 'Pasien KIA';
                } else {
                    echo 'Semua Pasien';
                }
            @endphp
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
                                                        @if (Auth::user()->role == 'Dokter')
                                                            <a href="{{ route('pasien.periksa', $item->id) }}">
                                                                <button class="btn btn-link p-0">
                                                                    <img src="{{ url('assets/stethoscope.png') }}"
                                                                        alt="stethoscope">
                                                                </button>
                                                            </a>
                                                        @elseif(Auth::user()->role == 'Petugas Loket')
                                                            <x-b-secondary-button
                                                                onclick="editPendaftaran('{{ $item->id }}', '{{ $item->jenis_bayar }}', '{{ $item->tanggal_periksa }}', '{{ $item->poli }}')">
                                                                {{ __('Edit') }}
                                                            </x-b-secondary-button>
                                                            <form
                                                                action="{{ route('loket.destroyPendaftaran', $item->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    {{ __('Hapus') }}
                                                                </button>
                                                            </form>
                                                        @endif
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
    <!-- Modal Edit Pendaftaran -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-end">
                            <x-b-secondary-button id="modal_bpjs">
                                {{ __('BPJS') }}
                            </x-b-secondary-button>
                            <x-b-primary-button id="modal_umum">
                                {{ __('Non BPJS') }}
                            </x-b-primary-button>
                        </div>
                    </div>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="modal_jenis_bayar">Jenis Bayar</label>
                                <input type="text" class="form-control" id="modal_jenis_bayar" name="jenis_bayar"
                                    readonly>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="modal_tgl_periksa">Tgl Pemeriksaan</label>
                                <input type="date" class="form-control" id="modal_tgl_periksa"
                                    name="tanggal_periksa">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="modal_poli">Ke Poli</label>
                                <select class="form-control" id="modal_poli" name="poli">
                                    <option value="" selected disabled>Pilih Poli Tujuan</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Gigi">Gigi</option>
                                    <option value="KIA">KIA</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#table').DataTable();

                // Modal BPJS/Umum button handlers
                $('#modal_umum').click(function() {
                    $('#modal_jenis_bayar').val('Umum');
                });
                $('#modal_bpjs').click(function() {
                    $('#modal_jenis_bayar').val('BPJS');
                });

                // Save changes handler
                $('#saveChanges').click(function() {
                    $('#editForm').submit();
                });
            });

            function editPendaftaran(id, jenisBayar, tanggalPeriksa, poli) {
                // Set form action
                $('#editForm').attr('action', `/loket/pendaftaran/${id}`);

                // Set form values
                $('#modal_jenis_bayar').val(jenisBayar);
                $('#modal_tgl_periksa').val(tanggalPeriksa);
                $('#modal_poli').val(poli);

                // Show modal
                $('#editModal').modal('show');
            }
        </script>
    @endpush
</x-app-layout>
