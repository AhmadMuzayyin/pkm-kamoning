<!-- Rekam Medik -->
<div class="col-md-12 mt-4">
    <div class="card bg-light p-3">
        <h5 class="fw-bold">Rekam Medik</h5>
        <hr>
        <p><strong>Poli:</strong> {{ $rekam_medik?->poli }}</p>
        <p><strong>Tinggi Badan:</strong> {{ $rekam_medik?->fisik?->tinggi_badan }}</p>
        <p><strong>Berat Badan:</strong> {{ $rekam_medik?->fisik?->berat_badan }}</p>
        <p><strong>Suhu:</strong> {{ $rekam_medik?->fisik?->suhu_tubuh }}</p>
        <p><strong>Keluhan:</strong> {{ $rekam_medik?->pemeriksaan?->keluhan }}</p>
        <p><strong>Diagnosa:</strong> {{ $rekam_medik?->pemeriksaan?->diagnosa }}</p>
        <p><strong>Tindakan:</strong> {{ $rekam_medik?->tindakan?->tindakan }}</p>
        <p><strong>Obat:</strong> {{ $rekam_medik?->resep?->obat->nama . ' - ' . $rekam_medik?->resep?->obat->jumlah }}
        </p>
    </div>
</div>
