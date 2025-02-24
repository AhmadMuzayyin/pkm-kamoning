<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ __('Daftar Akun') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg-main">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                        data-bs-target="#tambahUserModal">
                                        {{ __('Tambah Pengguna') }}
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive mt-2 text-dark">
                                <table class="table" id="table">
                                    <thead>
                                        <tr class="tr">
                                            <th>#</th>
                                            <th>NAMA</th>
                                            <th>JABATAN</th>
                                            <th>USERNAME</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->role }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning edit-btn"
                                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                        data-username="{{ $item->username }}"
                                                        data-role="{{ $item->role }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('user.destroy', $item->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                            Hapus
                                                        </button>
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

    <!-- Modal Tambah User -->
    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahUserModalLabel">Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Jabatan</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role"
                                name="role" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="Kepala Rekam Medik"
                                    {{ old('role') == 'Kepala Rekam Medik' ? 'selected' : '' }}>Kepala Rekam Medik
                                </option>
                                <option value="Farmasi" {{ old('role') == 'Farmasi' ? 'selected' : '' }}>Farmasi
                                </option>
                                <option value="Kasir" {{ old('role') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="Dokter" {{ old('role') == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                                <option value="Petugas Loket" {{ old('role') == 'Petugas Loket' ? 'selected' : '' }}>
                                    Petugas Loket</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="edit_name" name="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Jabatan</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="edit_role"
                                name="role" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="Kepala Rekam Medik">Kepala Rekam Medik</option>
                                <option value="Farmasi">Farmasi</option>
                                <option value="Kasir">Kasir</option>
                                <option value="Dokter">Dokter</option>
                                <option value="Petugas Loket">Petugas Loket</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="edit_username" name="username" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password <small
                                    class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="edit_password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="edit_password_confirmation"
                                name="password_confirmation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#table').DataTable();

                // Menangani klik tombol edit
                $('.edit-btn').on('click', function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const username = $(this).data('username');
                    const role = $(this).data('role');

                    // Set action form
                    $('#editUserForm').attr('action', `/user/update/${id}`);

                    // Isi form dengan data user
                    $('#edit_name').val(name);
                    $('#edit_username').val(username);
                    $('#edit_role').val(role);

                    // Reset password fields
                    $('#edit_password').val('');
                    $('#edit_password_confirmation').val('');

                    // Tampilkan modal
                    $('#editUserModal').modal('show');
                });

                // Validasi form tambah
                $('#tambahUserModal form').on('submit', function(e) {
                    const password = $('#password').val();
                    const confirmation = $('#password_confirmation').val();

                    if (password !== confirmation) {
                        e.preventDefault();
                        alert('Password dan konfirmasi password tidak cocok!');
                    }
                });

                // Validasi form edit
                $('#editUserForm').on('submit', function(e) {
                    const password = $('#edit_password').val();
                    const confirmation = $('#edit_password_confirmation').val();

                    if (password && password !== confirmation) {
                        e.preventDefault();
                        alert('Password dan konfirmasi password tidak cocok!');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
