<x-app-layout>
    <x-slot name="header">
        @if (auth()->user()->role == 'Petugas Loket')
            <div class="row justify-content-end">
                <div class="col-md-6 d-flex justify-content-center">
                    <a href="{{ route('loket.index') }}">
                        <x-b-primary-button class="rounded-circle">
                            <span class="material-symbols-outlined">
                                add
                            </span>
                        </x-b-primary-button>
                    </a>
                </div>
            </div>
        @endif
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg-main">
                        <div class="card-body">
                            @if (auth()->user()->role == 'Petugas Loket')
                                @include('pages.loket.dashboard')
                            @endif
                            {{-- row menu --}}
                            @if (auth()->user()->role == 'Dokter')
                                @include('pages.pasien.dashboard')
                            @elseif(auth()->user()->role == 'Kasir')
                                @include('pages.kasir.dashboard')
                            @elseif(auth()->user()->role == 'Farmasi')
                                @include('pages.farmasi.dashboard')
                            @elseif(auth()->user()->role == 'Kepala Rekam Medik')
                                @include('pages.kepala.dashboard')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
