<!-- Form Pendaftaran -->
<div class="col-md-12">
    <div class="card bg-light p-3">
        <h5 class="fw-bold">PENDAFTARAN</h5>
        <hr>
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('loket.pendaftaran', $kunjungan->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="jenis_bayar">Jenis Bayar</label>
                    <select class="form-control" id="jenis_bayar" name="jenis_bayar">
                        <option value="Umum"
                            {{ $kunjungan->exists() ? ($kunjungan->jenis_pelayanan == 'Umum' ? 'selected' : '') : '' }}>
                            Non BPJS</option>
                        <option value="BPJS"
                            {{ $kunjungan->exists() ? ($kunjungan->jenis_pelayanan == 'BPJS' ? 'selected' : '') : '' }}>
                            BPJS</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tgl_periksa">Tgl Pemeriksaan</label>
                    <input type="date" class="form-control" id="tgl_periksa" name="tanggal_periksa"
                        value="{{ old('tanggal_periksa') }}">
                </div>
                <div class="col-md-4">
                    <label for="ke_poli">Ke Poli</label>
                    <select class="form-control" id="ke_poli" name="poli">
                        <option value="" selected disabled>Pilih Poli Tujuan</option>
                        <option value="Umum" {{ old('poli') == 'Umum' ? 'selected' : '' }}>
                            Umum</option>
                        <option value="Gigi" {{ old('poli') == 'Gigi' ? 'selected' : '' }}>
                            Gigi</option>
                        <option value="IKIA" {{ old('poli') == 'IKIA' ? 'selected' : '' }}>
                            IKIA</option>
                    </select>
                </div>
            </div>
            <x-b-primary-button class="mt-2">
                {{ __('Simpan') }}
            </x-b-primary-button>
        </form>
    </div>
</div>
