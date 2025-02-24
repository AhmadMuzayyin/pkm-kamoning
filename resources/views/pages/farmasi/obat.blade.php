<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ __('Data Obat') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container" id="container">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg-main">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                        data-bs-target="#tambahObatModal">
                                        {{ __('Tambah Obat') }}
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive mt-2 text-dark">
                                <table class="table" id="table">
                                    <thead>
                                        <tr class="tr">
                                            <th>NO</th>
                                            <th>Tgl Masuk</th>
                                            <th>Nama Obat</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($obats as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tanggal_masuk }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>Rp. {{ number_format($item->harga) }}</td>
                                                <td>{{ $item->stok }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                        data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                                        data-harga="{{ $item->harga }}"
                                                        data-stok="{{ $item->stok }}"
                                                        data-tanggal="{{ $item->tanggal_masuk }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('farmasi.destroy', $item->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda Yakin?')">Hapus</button>
                                                    </form>
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

    <!-- Modal Tambah Obat -->
    <div class="modal fade" id="tambahObatModal" tabindex="-1" aria-labelledby="tambahObatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahObatModalLabel">Tambah Obat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahObatForm" action="{{ route('farmasi.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required
                                value="{{ date('Y-m-d') }}">
                            <div class="invalid-feedback" id="tanggal_masuk-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                            <div class="invalid-feedback" id="nama-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                            <div class="invalid-feedback" id="harga-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                            <div class="invalid-feedback" id="stok-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="simpanBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Obat -->
    <div class="modal fade" id="editObatModal" tabindex="-1" aria-labelledby="editObatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editObatModalLabel">Edit Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editObatForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="edit_tanggal_masuk" name="tanggal_masuk"
                                required>
                            <div class="invalid-feedback" id="edit_tanggal_masuk-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" required>
                            <div class="invalid-feedback" id="edit_nama-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_harga" class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control" id="edit_harga" name="harga" required>
                            <div class="invalid-feedback" id="edit_harga-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_stok" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="edit_stok" name="stok" required>
                            <div class="invalid-feedback" id="edit_stok-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#table').DataTable();

                // Reset form dan error messages ketika modal dibuka
                $('#tambahObatModal').on('show.bs.modal', function() {
                    resetForm('#tambahObatForm');
                });

                $('#editObatModal').on('show.bs.modal', function() {
                    resetFormErrors('#editObatForm');
                });

                // Menangani klik tombol edit
                $('.edit-btn').on('click', function() {
                    const id = $(this).data('id');
                    const nama = $(this).data('nama');
                    const harga = $(this).data('harga');
                    const stok = $(this).data('stok');
                    const tanggal = $(this).data('tanggal');

                    // Set form action
                    $('#editObatForm').attr('action', `/obat/${id}`);

                    // Isi form dengan data obat
                    $('#edit_nama').val(nama);
                    $('#edit_harga').val(harga);
                    $('#edit_stok').val(stok);
                    $('#edit_tanggal_masuk').val(tanggal);

                    // Tampilkan modal
                    $('#editObatModal').modal('show');
                });

                // Real-time validation for Tambah form
                $('#nama').on('blur', function() {
                    validateField('nama', $(this).val());
                });

                $('#harga').on('blur', function() {
                    validateField('harga', $(this).val());
                });

                $('#stok').on('blur', function() {
                    validateField('stok', $(this).val());
                });

                $('#tanggal_masuk').on('blur', function() {
                    validateField('tanggal_masuk', $(this).val());
                });

                // Real-time validation for Edit form
                $('#edit_nama').on('blur', function() {
                    const obatId = $('#editObatForm').attr('action').split('/').pop();
                    validateField('nama', $(this).val(), obatId, 'edit_');
                });

                $('#edit_harga').on('blur', function() {
                    validateField('harga', $(this).val(), null, 'edit_');
                });

                $('#edit_stok').on('blur', function() {
                    validateField('stok', $(this).val(), null, 'edit_');
                });

                $('#edit_tanggal_masuk').on('blur', function() {
                    validateField('tanggal_masuk', $(this).val(), null, 'edit_');
                });

                // Form tambah obat submission
                $('#tambahObatForm').on('submit', function(e) {
                    e.preventDefault();
                    const form = $(this);

                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        beforeSend: function() {
                            $('#simpanBtn').attr('disabled', true).html(
                                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...'
                            );
                            resetFormErrors('#tambahObatForm');
                        },
                        success: function(response) {
                            $('#tambahObatModal').modal('hide');
                            const successAlert = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data obat berhasil ditambahkan
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                            $('#container').prepend(successAlert);
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        },
                        error: function(xhr) {
                            $('#simpanBtn').attr('disabled', false).text('Simpan');

                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key + '-error').text(value[0]);
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat menyimpan data',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });

                // Form edit obat submission
                $('#editObatForm').on('submit', function(e) {
                    e.preventDefault();
                    const form = $(this);

                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        beforeSend: function() {
                            $('#updateBtn').attr('disabled', true).html(
                                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...'
                            );
                            resetFormErrors('#editObatForm');
                        },
                        success: function(response) {
                            $('#editObatModal').modal('hide');
                            const successAlert = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data obat berhasil diperbarui
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                            $('#container').prepend(successAlert);
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        },
                        error: function(xhr) {
                            $('#updateBtn').attr('disabled', false).text('Update');

                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#edit_' + key).addClass('is-invalid');
                                    $('#edit_' + key + '-error').text(value[0]);
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat memperbarui data',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });

                // Fungsi untuk validasi field
                function validateField(fieldName, value, id = null, prefix = '') {
                    let data = {
                        _token: '{{ csrf_token() }}',
                        _validate_only: true
                    };

                    data[fieldName] = value;

                    if (id) {
                        data['id'] = id;
                    }

                    $.ajax({
                        url: '/validate-obat',
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            $(`#${prefix}${fieldName}`).removeClass('is-invalid');
                            $(`#${prefix}${fieldName}-error`).text('');
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                if (errors && errors[fieldName]) {
                                    $(`#${prefix}${fieldName}`).addClass('is-invalid');
                                    $(`#${prefix}${fieldName}-error`).text(errors[fieldName][0]);
                                }
                            }
                        }
                    });
                }

                // Reset form
                function resetForm(formSelector) {
                    $(formSelector)[0].reset();
                    resetFormErrors(formSelector);
                }

                // Reset form errors
                function resetFormErrors(formSelector) {
                    $(formSelector + ' .is-invalid').removeClass('is-invalid');
                    $(formSelector + ' .invalid-feedback').text('');
                }
            });
        </script>
    @endpush
</x-app-layout>
