<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-dark mb-0">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg-main">
                        <div class="card-body">
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#periodModal" data-term="harian">
                                            <div class="card bg-primary" style="height: 10rem;">
                                                <div class="card-body d-flex justify-content-center align-items-center">
                                                    <h1 class="m-0">
                                                        HARIAN
                                                    </h1>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#periodModal" data-term="bulanan">
                                            <div class="card bg-primary" style="height: 10rem;">
                                                <div class="card-body d-flex justify-content-center align-items-center">
                                                    <h1 class="m-0">
                                                        BULANAN
                                                    </h1>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#periodModal" data-term="tahunan">
                                            <div class="card bg-primary" style="height: 10rem;">
                                                <div class="card-body d-flex justify-content-center align-items-center">
                                                    <h1 class="m-0">
                                                        TAHUNAN
                                                    </h1>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Periode Laporan -->
    <div class="modal fade" id="periodModal" tabindex="-1" aria-labelledby="periodModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="periodModalLabel">Pilih Periode Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="laporanForm" action="{{ route('kepala.laporan') }}" method="GET">
                    <input type="hidden" id="termInput" name="term" value="">
                    <div class="modal-body">
                        <!-- Fields akan diisi secara dinamis oleh JavaScript -->
                        <div id="periodFields"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Handler untuk modal periode
                $('[data-bs-target="#periodModal"]').on('click', function() {
                    const term = $(this).data('term');
                    $('#termInput').val(term);

                    // Tentukan fields yang akan ditampilkan berdasarkan term
                    let fields = '';

                    switch (term) {
                        case 'harian':
                            fields = `
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Pilih Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required value="${formatDate(new Date())}">
                            </div>
                        `;
                            break;
                        case 'bulanan':
                            const currentMonth = new Date().toISOString().slice(0, 7); // Format YYYY-MM
                            fields = `
                                <div class="mb-3">
                                    <label for="bulan" class="form-label">Pilih Bulan</label>
                                    <input type="month" class="form-control" id="bulan" name="bulan" required value="${currentMonth}">
                                </div>
                                `;
                            break;
                        case 'tahunan':
                            const currentYear = new Date().getFullYear();
                            let yearOptions = '';

                            for (let year = currentYear; year >= currentYear - 5; year--) {
                                yearOptions += `<option value="${year}">${year}</option>`;
                            }

                            fields = `
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Pilih Tahun</label>
                                <select class="form-select" id="tahun" name="tahun" required>
                                    ${yearOptions}
                                </select>
                            </div>
                        `;
                            break;
                        default:
                            fields = `
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required value="${formatDate(new Date(new Date().setDate(new Date().getDate() - 7)))}">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required value="${formatDate(new Date())}">
                            </div>
                        `;
                    }

                    // Update modal title
                    $('#periodModalLabel').text(
                        `Pilih Periode Laporan ${term.charAt(0).toUpperCase() + term.slice(1)}`);

                    // Set fields dalam modal
                    $('#periodFields').html(fields);
                });

                // Validasi tanggal untuk form range (jika ada)
                $(document).on('change', '#tanggal_selesai', function() {
                    const tanggalMulai = new Date($('#tanggal_mulai').val());
                    const tanggalSelesai = new Date($(this).val());

                    if (tanggalSelesai < tanggalMulai) {
                        alert('Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
                        $(this).val($('#tanggal_mulai').val());
                    }
                });

                $(document).on('change', '#tanggal_mulai', function() {
                    const tanggalMulai = new Date($(this).val());
                    const tanggalSelesai = new Date($('#tanggal_selesai').val());

                    if (tanggalSelesai < tanggalMulai) {
                        $('#tanggal_selesai').val($(this).val());
                    }
                });

                // Helper functions untuk format tanggal
                function formatDate(date) {
                    return date.toISOString().split('T')[0];
                }

                function formatYearMonth(date) {
                    return date.toISOString().split('T')[0].substring(0, 7);
                }
            });
        </script>
    @endpush
</x-app-layout>
