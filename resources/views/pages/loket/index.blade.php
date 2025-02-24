<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ __('Loket') }}
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
                                    <a href="{{ route('loket.create') }}">
                                        <x-b-primary-button class="float-end">
                                            <span class="material-symbols-outlined">
                                                add
                                            </span>
                                        </x-b-primary-button>
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive mt-2 text-dark">
                                <table class="table" id="table">
                                    <thead>
                                        <tr class="tr">
                                            <th>NO RM</th>
                                            <th>NAMA</th>
                                            <th>ALAMAT</th>
                                            <th>TGL LAHIR</th>
                                            <th>JK</th>
                                            <th>NIK</th>
                                            <th>J. PELAYANAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kunjungans as $item)
                                            <tr>
                                                <td>{{ $item->no_rekam_medik }}</td>
                                                <td>{{ $item->nama_pasien }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->tanggal_lahir }}</td>
                                                <td>{{ $item->jenis_kelamin }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->jenis_pelayanan }}</td>
                                                <td>
                                                    <a href="{{ route('loket.show', $item->id) }}">
                                                        <x-b-secondary-button>
                                                            {{ __('Detail') }}
                                                        </x-b-secondary-button>
                                                        <a href="{{ route('loket.edit', $item->id) }}">
                                                            <x-b-primary-button>
                                                                {{ __('Edit') }}
                                                            </x-b-primary-button>
                                                        </a>
                                                        <form action="{{ route('loket.destroy', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                {{ __('Hapus') }}
                                                            </button>
                                                        </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#table').DataTable();
            });
        </script>
    @endpush
</x-app-layout>
