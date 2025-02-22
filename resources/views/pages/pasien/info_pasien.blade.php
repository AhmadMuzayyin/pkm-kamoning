<div class="card bg-light p-3">
    <h5 class="fw-bold">Pasien</h5>
    <hr>
    <p>
        <strong>No Rekam Medik:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->no_rekam_medik : '' }}
    </p>
    <p>
        <strong>Nama Pasien:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->nama_pasien : '' }}
    </p>
    <p>
        <strong>Alamat:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->alamat : '' }}
    </p>
    <p>
        <strong>Telepon:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->telpon : '' }}
    </p>
    <p>
        <strong>Kecamatan:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->kecamatan : '' }}
    </p>
    <p>
        <strong>Kelurahan:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->kelurahan : '' }}
    </p>
    <p>
        <strong>Tempat/Tgl Lahir:</strong>
        {{ $pasien->exists() ? "{$pasien->kunjungan->tempat_lahir}/{$pasien->kunjungan->tanggal_lahir}" : '' }}
    </p>
    <p>
        <strong>Umur:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->umur : '' }}
    </p>
    <p>
        <strong>Jenis Kelamin:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->jenis_kelamin : '' }}
    </p>
    <p>
        <strong>NIK:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->nik : '' }}
    </p>
    <p>
        <strong>Jenis Bayar:</strong>
        {{ $pasien->exists() ? $pasien->kunjungan->jenis_pelayanan : '' }}
    </p>
</div>
