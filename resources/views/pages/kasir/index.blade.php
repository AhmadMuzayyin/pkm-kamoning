<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ __('Data Pembayaran') }}
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
                                            <th>Poli</th>
                                            <th>Tgl Periksa</th>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Kelamin</th>
                                            <th>Jenis Bayar</th>
                                            <th>Biaya</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembayarans as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->pendaftaran->poli }}</td>
                                                <td>{{ $item->pendaftaran->tanggal_periksa }}</td>
                                                <td>{{ $item->pendaftaran->kunjungan->nama_pasien }}</td>
                                                <td>{{ $item->pendaftaran->kunjungan->umur }}</td>
                                                <td>{{ $item->pendaftaran->kunjungan->jenis_kelamin }}</td>
                                                <td>{{ $item->pendaftaran->kunjungan->jenis_pelayanan }}</td>
                                                <td>{{ 'Rp.' . number_format($item->total_harga) }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $item->status == 'Lunas' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $item->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($item->status == 'Belum Lunas')
                                                        <button type="button" class="btn btn-sm btn-primary bayar-btn"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->pendaftaran->kunjungan->nama_pasien }}"
                                                            data-total="{{ $item->total_harga }}">
                                                            <i class="bi bi-cash-coin"></i> Bayar
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success print-btn"
                                                            data-id="{{ $item->id }}">
                                                            <i class="bi bi-printer"></i> Cetak
                                                        </button>
                                                    @endif

                                                    <button type="button" class="btn btn-sm btn-info detail-btn"
                                                        data-id="{{ $item->id }}">
                                                        <i class="bi bi-eye"></i> Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pembayaran -->
    <div class="modal fade" id="pembayaranModal" tabindex="-1" aria-labelledby="pembayaranModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pembayaranModalLabel">Form Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="pembayaranForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama_pasien" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Biaya</label>
                            <input type="text" class="form-control" id="total_biaya" readonly>
                            <input type="hidden" id="total_biaya_nilai" name="total_harga">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Pembayaran</label>
                            <input type="number" class="form-control" id="pembayaran" name="pembayaran" required>
                            <div class="invalid-feedback" id="pembayaran_error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kembalian</label>
                            <input type="text" class="form-control" id="kembalian" name="kembalian" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailContent">
                    <!-- Konten detail akan dimasukkan di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#table').DataTable();

                // Menangani klik tombol bayar
                $('.bayar-btn').on('click', function() {
                    const id = $(this).data('id');
                    const nama = $(this).data('nama');
                    const total = $(this).data('total');

                    $('#pembayaranForm').attr('action', `/kasir/pembayaran/${id}`);
                    $('#nama_pasien').val(nama);
                    $('#total_biaya').val('Rp. ' + total.toLocaleString('id-ID'));
                    $('#total_biaya_nilai').val(total);
                    $('#pembayaran').val('');
                    $('#kembalian').val('');

                    $('#pembayaranModal').modal('show');
                });

                // Menghitung kembalian secara otomatis
                $('#pembayaran').on('input', function() {
                    const totalBiaya = parseInt($('#total_biaya_nilai').val()) || 0;
                    const pembayaran = parseInt($(this).val()) || 0;
                    let kembalian = 0;

                    if (pembayaran >= totalBiaya) {
                        kembalian = pembayaran - totalBiaya;
                        $('#pembayaran_error').text('');
                        $('#pembayaran').removeClass('is-invalid');
                    } else {
                        $('#pembayaran_error').text('Pembayaran kurang dari total biaya');
                        $('#pembayaran').addClass('is-invalid');
                    }

                    $('#kembalian').val('Rp. ' + kembalian.toLocaleString('id-ID'));
                });

                // Validasi form sebelum submit
                $('#pembayaranForm').on('submit', function(e) {
                    const totalBiaya = parseInt($('#total_biaya_nilai').val()) || 0;
                    const pembayaran = parseInt($('#pembayaran').val()) || 0;

                    if (pembayaran < totalBiaya) {
                        e.preventDefault();
                        $('#pembayaran_error').text('Pembayaran kurang dari total biaya');
                        $('#pembayaran').addClass('is-invalid');
                        return false;
                    }

                    // Ajax untuk proses pembayaran
                    e.preventDefault();
                    const form = $(this);

                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#pembayaranModal').modal('hide');
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat memproses pembayaran',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });

                // Menangani klik tombol detail
                $('.detail-btn').on('click', function() {
                    const id = $(this).data('id');

                    // Ajax untuk mendapatkan detail pembayaran
                    $.ajax({
                        url: `/kasir/detail/${id}`,
                        method: 'GET',
                        success: function(response) {
                            $('#detailContent').html(response);
                            $('#detailModal').modal('show');
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal memuat detail pembayaran',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });

                $('.print-btn').on('click', function() {
                    const id = $(this).data('id');
                    window.open(`/kasir/print-preview/${id}`, '_blank', 'width=800,height=600');
                });
            });
        </script>
    @endpush
</x-app-layout>
