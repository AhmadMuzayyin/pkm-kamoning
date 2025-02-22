<!-- Riwayat Kunjungan -->
<div class="card bg-light p-3 mt-4">
    <h5 class="fw-bold">Riwayat Kunjungan</h5>
    <hr>
    <div class="timeline">
        @php
            $riwayat = $kunjungan->exists() ? $kunjungan->pendaftaran : 0;
        @endphp
        @foreach ($riwayat as $item)
            <a href="{{ url()->current() . "?riwayat=$item->id" }}" class="text-decoration-none">
                <div class="timeline-item text-dark">
                    <div class="timeline-date">
                        <span class="date">{{ date('d', strtotime($item->tanggal_periksa)) }}</span>
                        <span class="month">{{ date('M', strtotime($item->tanggal_periksa)) }}</span>
                        <span class="year">{{ date('Y', strtotime($item->tanggal_periksa)) }}</span>
                    </div>
                    <div class="timeline-content">
                        <h6 class="fw-bold">Poli</h6>
                        <p>{{ $item->poli }}</p>
                        <h6 class="fw-bold">Diagnosa</h6>
                        <p>{{ $item->pemeriksaan?->diagnosa }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
