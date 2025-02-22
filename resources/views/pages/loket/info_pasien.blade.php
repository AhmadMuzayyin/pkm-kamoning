<div class="card bg-light p-3">
    <h5 class="fw-bold">Pasien</h5>
    <hr>
    <p>
        <strong>No Rekam Medik:</strong>
        {{ $kunjungan->exists() ? $kunjungan->no_rekam_medik : '' }}
    </p>
    <p>
        <strong>Nama Pasien:</strong>
        {{ $kunjungan->exists() ? $kunjungan->nama_pasien : '' }}
    </p>
    <p>
        <strong>Alamat:</strong>
        {{ $kunjungan->exists() ? $kunjungan->alamat : '' }}
    </p>
    <p>
        <strong>Telepon:</strong>
        {{ $kunjungan->exists() ? $kunjungan->telpon : '' }}
    </p>
    <p>
        <strong>Kecamatan:</strong>
        {{ $kunjungan->exists() ? $kunjungan->kecamatan : '' }}
    </p>
    <p>
        <strong>Kelurahan:</strong>
        {{ $kunjungan->exists() ? $kunjungan->kelurahan : '' }}
    </p>
    <p>
        <strong>Tempat/Tgl Lahir:</strong>
        {{ $kunjungan->exists() ? "$kunjungan->tempat_lahir/$kunjungan->tanggal_lahir" : '' }}
    </p>
    <p>
        <strong>Umur:</strong>
        {{ $kunjungan->exists() ? $kunjungan->umur : '' }}
    </p>
    <p>
        <strong>Jenis Kelamin:</strong>
        {{ $kunjungan->exists() ? $kunjungan->jenis_kelamin : '' }}
    </p>
    <p>
        <strong>NIK:</strong>
        {{ $kunjungan->exists() ? $kunjungan->nik : '' }}
    </p>
    <p>
        <strong>Jenis Bayar:</strong>
        {{ $kunjungan->exists() ? $kunjungan->jenis_pelayanan : '' }}
    </p>
</div>
