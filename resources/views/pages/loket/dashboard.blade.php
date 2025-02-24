<div class="row mt-2">
    @if ($antrian_kia > 0)
        <div class="col-12 col-sm-4 mt-2">
            <a href="{{ route('pasien.index', 'poli=KIA') }}" class="text-decoration-none">
                <div class="card bg-primary position-relative" style="width: 10rem; height: 10rem;">
                    <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger">
                        {{ $antrian_kia }}
                        <span class="visually-hidden">ANTRIAN KIA</span>
                    </span>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="m-0">
                            KIA
                        </h1>
                    </div>
                </div>
            </a>
        </div>
    @endif
    @if ($antrian_gigi > 0)
        <div class="col-12 col-sm-4 mt-2">
            <a href="{{ route('pasien.index', 'poli=Gigi') }}" class="text-decoration-none">
                <div class="card bg-primary position-relative" style="width: 10rem; height: 10rem;">
                    <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger">
                        {{ $antrian_gigi }}
                        <span class="visually-hidden">ANTRIAN GILUT</span>
                    </span>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="m-0">
                            GILUT
                        </h1>
                    </div>
                </div>
            </a>
        </div>
    @endif
    @if ($antrian_umum > 0)
        <div class="col-12 col-sm-4 mt-2">
            <a href="{{ route('pasien.index', 'poli=Umum') }}" class="text-decoration-none">
                <div class="card bg-primary position-relative" style="width: 10rem; height: 10rem;">
                    <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger">
                        {{ $antrian_umum }}
                        <span class="visually-hidden">ANTRIAN UMUM</span>
                    </span>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="m-0">
                            UMUM
                        </h1>
                    </div>
                </div>
            </a>
        </div>
    @endif
</div>
