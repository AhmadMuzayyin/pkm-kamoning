<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ __('Detail Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <!-- Informasi Pasien -->
                    @include('pages.loket.info_pasien')
                    {{-- riwayat --}}
                    @include('pages.loket.riwayat')
                </div>

                <!-- Pendaftaran dan Rekam Medik -->
                <div class="col-md-7">
                    <div class="row">
                        @include('pages.loket.form_pendaftaran')
                        @if ($rekam_medik)
                            @include('pages.loket.rekam_medik')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            border-left: 3px solid #007bff;
            padding-left: 20px;
            position: relative;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .timeline-date {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 5px;
            width: 60px;
            border-radius: 5px;
            margin-right: 15px;
        }

        .timeline-date .date {
            font-size: 20px;
            font-weight: bold;
        }

        .timeline-date .month,
        .timeline-date .year {
            font-size: 12px;
        }

        .timeline-content {
            border-left: 2px solid #000;
            padding-left: 15px;
        }
    </style>

</x-app-layout>
