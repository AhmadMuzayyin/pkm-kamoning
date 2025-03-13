<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ $kunjungan->exists ? 'Edit Data' : 'Tambah Data' }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg-main">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="text-dark"
                                action="{{ $kunjungan->exists ? route('loket.update', $kunjungan->id) : route('loket.store') }}"
                                method="POST">
                                @csrf
                                @if ($kunjungan->exists)
                                    @method('PATCH')
                                @endif
                                <div class="mb-3">
                                    <label for="nama_pasien"
                                        class="form-label @error('nama_pasien') is-invalid @enderror">Nama
                                        Pasien</label>
                                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien"
                                        value="{{ old('nama_pasien', $kunjungan->nama_pasien) }}">
                                    @error('nama_pasien')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat"
                                        class="form-label @error('alamat') is-invalid @enderror">Alamat</label>
                                    <input type="text" class="form-control" id="alamat"
                                        name="alamat"value="{{ old('alamat', $kunjungan->alamat) }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="telpon"
                                        class="form-label @error('telpon') is-invalid @enderror">Telepon</label>
                                    <input type="text" class="form-control" id="telpon" name="telpon"
                                        value="{{ old('telpon', $kunjungan->telpon) }}">
                                    @error('telpon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_lahir"
                                        class="form-label @error('tempat_lahir') is-invalid @enderror">Tempat
                                        Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir"
                                        name="tempat_lahir"value="{{ old('tempat_lahir', $kunjungan->tempat_lahir) }}">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir"
                                        class="form-label @error('tanggal_lahir') is-invalid @enderror">Tanggal
                                        Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $kunjungan->tanggal_lahir) }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin"
                                        class="form-label @error('jenis_kelamin') is-invalid @enderror">Jenis
                                        Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki"
                                            {{ $kunjungan->exists() ? ($kunjungan->jenis_kelamin == 'Laki-laki' ? 'selected' : '') : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ $kunjungan->exists() ? ($kunjungan->jenis_kelamin == 'Perempuan' ? 'selected' : '') : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="umur"
                                        class="form-label @error('umur') is-invalid @enderror">Umur</label>
                                    <input type="numeric" class="form-control" id="umur" name="umur"
                                        value="{{ old('umur', $kunjungan->umur) }}" readonly>
                                    <small class="text-danger text-small fst-italic">Umur dibuat secara otomatis</small>
                                    @error('umur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nik"
                                        class="form-label @error('nik') is-invalid @enderror">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        value="{{ old('nik', $kunjungan->nik) }}">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_pelayanan"
                                        class="form-label @error('jenis_pelayanan') is-invalid @enderror">J.
                                        Pelayanan</label>
                                    <select type="text" class="form-control" id="jenis_pelayanan"
                                        name="jenis_pelayanan"
                                        value="{{ old('jenis_pelayanan', $kunjungan->jenis_pelayanan) }}">
                                        <option value="" selected disabled>Pilih J. Pelayanan</option>
                                        <option value="Umum"
                                            {{ $kunjungan->exists() ? ($kunjungan->jenis_pelayanan == 'Umum' ? 'selected' : '') : '' }}>
                                            Umum</option>
                                        <option value="BPJS"
                                            {{ $kunjungan->exists() ? ($kunjungan->jenis_pelayanan == 'BPJS' ? 'selected' : '') : '' }}>
                                            BPJS</option>
                                    </select>
                                    @error('jenis_pelayanan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi"
                                        class="form-label @error('provinsi') is-invalid @enderror">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi"
                                        value="{{ old('provinsi', $kunjungan->provinsi) ?? 'Jawa Timur' }}">
                                    @error('provinsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kabupaten"
                                        class="form-label @error('kabupaten') is-invalid @enderror">Kabupaten</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten"
                                        value="{{ old('kabupaten', $kunjungan->kabupaten) ?? 'Sampang' }}">
                                    @error('kabupaten')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kecamatan"
                                        class="form-label @error('kecamatan') is-invalid @enderror">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                        value="{{ old('kecamatan', $kunjungan->kecamatan) }}">
                                    @error('kecamatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kelurahan"
                                        class="form-label @error('kelurahan') is-invalid @enderror">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                        value="{{ old('kelurahan', $kunjungan->kelurahan) }}">
                                    @error('kelurahan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <x-b-primary-button class="float-start">
                                    {{ __('Simpan') }}
                                </x-b-primary-button>
                                <a href="{{ route('loket.index') }}">
                                    <x-b-secondary-button class="float-start mx-2" type="button">
                                        {{ __('Batal') }}
                                    </x-b-secondary-button>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#tanggal_lahir').change(function() {
                    var dob = new Date($(this).val());
                    var today = new Date();
                    var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                    $('#umur').val(age);
                });
            });
        </script>
    @endpush
</x-app-layout>
