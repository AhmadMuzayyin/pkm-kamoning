<form action="{{ route('pasien.store', $pasien->id) }}" method="POST">
    @csrf
    <div class="col-md-12 mb-4">
        <div class="card bg-light p-4">
            <h5 class="fw-bold mb-3">Fisik</h5>
            <hr class="mb-4">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="tinggi_badan" class="col-form-label fw-semibold">Tinggi Badan (cm)</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan"
                                value="{{ old('tinggi_badan') }}" placeholder="Masukkan tinggi badan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="berat_badan" class="col-form-label fw-semibold">Berat Badan (kg)</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="berat_badan" name="berat_badan"
                                value="{{ old('berat_badan') }}" placeholder="Masukkan berat badan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="suhu_tubuh" class="col-form-label fw-semibold">Suhu Tubuh (°C)</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="suhu_tubuh" name="suhu_tubuh"
                                value="{{ old('suhu_tubuh') }}" placeholder="Masukkan suhu tubuh" step="0.1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="card bg-light p-4">
            <h5 class="fw-bold mb-3">Pemeriksaan</h5>
            <hr class="mb-4">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="keluhan" class="col-form-label fw-semibold">Keluhan</label>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" placeholder="Deskripsikan keluhan pasien">{{ old('keluhan') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="diagnosa" class="col-form-label fw-semibold">Diagnosa</label>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" id="diagnosa" name="diagnosa" rows="3" placeholder="Tuliskan hasil diagnosa">{{ old('diagnosa') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="card bg-light p-4">
            <h5 class="fw-bold mb-3">Tindakan</h5>
            <hr class="mb-4">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="tindakan" class="col-form-label fw-semibold">Tindakan</label>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" id="tindakan" name="tindakan" rows="3"
                                placeholder="Deskripsikan tindakan yang dilakukan">{{ old('tindakan') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="card bg-light p-4">
            <h5 class="fw-bold mb-3">Obat</h5>
            <hr class="mb-4">

            <!-- Container untuk daftar obat yang dipilih -->
            <div id="selected-obats-container">
                <!-- Daftar obat yang dipilih akan ditampilkan di sini -->
            </div>

            <!-- Template untuk item obat (tersembunyi) -->
            <div id="obat-item-template" style="display: none;">
                <div class="obat-item mb-3 card border p-3">
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="fw-bold obat-nama"></h6>
                            <p class="mb-1 small text-muted obat-stok"></p>
                            <input type="hidden" name="obat_ids[]" class="obat-id-input">
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label fw-semibold">Jumlah</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary btn-decrease">-</button>
                                    <input type="number" class="form-control text-center jumlah-input"
                                        name="jumlah_obats[]" value="1" min="1">
                                    <button type="button" class="btn btn-outline-secondary btn-increase">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm btn-remove-obat">
                                <i class="fas fa-times"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input pencarian obat -->
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <label for="obat-search" class="col-form-label fw-semibold">Cari Obat</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="search" class="form-control" id="obat-search"
                                    placeholder="Masukkan nama obat untuk mencari...">
                                <span class="input-group-text" id="search-indicator" style="display: none;">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </span>
                            </div>
                            <small class="form-text text-muted">Ketik minimal 3 karakter dan tunggu hasil
                                pencarian</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hasil pencarian obat -->
            <div id="obat-search-results" class="row mb-3" style="display: none;">
                <div class="col-md-8">
                    <div class="card border p-3">
                        <h6 class="fw-bold mb-3">Hasil Pencarian</h6>
                        <div id="obat-results-list">
                            <!-- Hasil pencarian akan ditampilkan di sini -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template untuk hasil pencarian (tersembunyi) -->
    <div id="search-result-template" style="display: none;">
        <div class="search-result-item mb-2 p-2 border-bottom">
            <div class="row">
                <div class="col-md-8">
                    <strong class="result-obat-nama"></strong>
                    <p class="mb-0 small text-muted result-obat-stok"></p>
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn btn-primary btn-sm btn-add-obat">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            @if (session('error'))
                <div class="alert alert-danger mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <x-b-primary-button class="mt-2 px-4 py-2">
                {{ __('Simpan') }}
            </x-b-primary-button>
        </div>
    </div>
</form>
@push('scripts')
    <script>
        $(document).ready(function() {
            let searchTimeout = null;
            let selectedObats = [];

            $('#obat-search').on('keyup', function() {
                const searchTerm = $(this).val();
                $('#obat-error-message').remove();

                if (searchTerm.length < 3) {
                    $('#obat-search-results').hide();
                    return;
                }

                if (searchTimeout) {
                    clearTimeout(searchTimeout);
                }

                searchTimeout = setTimeout(function() {
                    $('#search-indicator').show();

                    $.ajax({
                        url: "{{ route('obat.search') }}",
                        type: 'GET',
                        data: {
                            term: searchTerm
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#search-indicator').hide();

                            if (data.success && data.obat) {
                                displaySearchResults([data.obat]);
                            } else {
                                $('#obat-search-results').hide();

                                if (data.message) {
                                    $('<div id="obat-error-message" class="alert alert-warning mt-2">' +
                                            data.message + '</div>')
                                        .insertAfter('#obat-search').parent();
                                }
                            }
                        },
                        error: function() {
                            $('#search-indicator').hide();
                            $('<div id="obat-error-message" class="alert alert-danger mt-2">Terjadi kesalahan saat mencari obat</div>')
                                .insertAfter('#obat-search').parent();
                        }
                    });
                }, 500);
            });

            function displaySearchResults(obats) {
                const $resultsList = $('#obat-results-list');
                $resultsList.empty();

                obats.forEach(function(obat) {
                    const $template = $('#search-result-template').children().first().clone();

                    $template.find('.result-obat-nama').text(obat.nama);
                    $template.find('.result-obat-stok').text('Stok: ' + obat.stok);

                    const $addButton = $template.find('.btn-add-obat');

                    $addButton.data('obat', obat);
                    $addButton.on('click', function() {
                        const obatData = $(this).data('obat');

                        if (isObatAlreadySelected(obatData.id)) {
                            alert('Obat ini sudah dipilih!');
                            return;
                        }

                        addObatToSelection(obatData);
                        $('#obat-search').val('');
                        $('#obat-search-results').hide();
                    });

                    $resultsList.append($template);
                });

                $('#obat-search-results').show();
            }

            function isObatAlreadySelected(obatId) {
                return selectedObats.some(obat => obat.id === obatId);
            }

            function addObatToSelection(obatData) {
                if (isObatAlreadySelected(obatData.id)) {
                    alert('Obat ini sudah dipilih!');
                    return;
                }

                selectedObats.push(obatData);

                // Buat elemen baru
                const $template = $('#obat-item-template').children().first().clone();

                // Hapus hidden input yang mungkin ada sebelumnya
                $template.find('.obat-id-input').remove();

                // Tambahkan hidden input yang baru
                $template.find('.col-md-5').first().append(
                    $('<input>', {
                        type: 'hidden',
                        name: 'obat_ids[]',
                        class: 'obat-id-input',
                        value: obatData.id
                    })
                );

                // Set properti lainnya seperti biasa
                $template.find('.obat-nama').text(obatData.nama);
                $template.find('.obat-stok').text('Stok: ' + obatData.stok);
                $template.find('.obat-id-input').val(obatData.id);

                const $jumlahInput = $template.find('.jumlah-input');
                $jumlahInput.attr('max', obatData.stok);

                $template.find('.btn-increase').on('click', function() {
                    const currentVal = parseInt($jumlahInput.val());
                    const max = parseInt($jumlahInput.attr('max'));

                    if (currentVal < max) {
                        $jumlahInput.val(currentVal + 1);
                    }
                });

                $template.find('.btn-decrease').on('click', function() {
                    const currentVal = parseInt($jumlahInput.val());

                    if (currentVal > 1) {
                        $jumlahInput.val(currentVal - 1);
                    }
                });

                $jumlahInput.on('change', function() {
                    const max = parseInt($(this).attr('max'));
                    const val = parseInt($(this).val());

                    if (val > max) {
                        $(this).val(max);
                        alert('Jumlah obat tidak boleh melebihi stok yang tersedia');
                    }

                    if (val < 1) {
                        $(this).val(1);
                    }
                });

                $template.find('.btn-remove-obat').on('click', function() {
                    const $item = $(this).closest('.obat-item');
                    const obatId = $item.find('.obat-id-input').val();
                    selectedObats = selectedObats.filter(obat => obat.id != obatId);
                    $item.remove();
                    reindexObatInputs();

                    updateEmptyState();
                });

                $('#selected-obats-container').append($template);
                updateEmptyState();
            }

            function updateEmptyState() {
                if (selectedObats.length === 0) {
                    if ($('#empty-obat-message').length === 0) {
                        $('#selected-obats-container').append(
                            '<div id="empty-obat-message" class="alert alert-info">Belum ada obat yang dipilih. Silakan cari obat di atas.</div>'
                        );
                    }
                } else {
                    $('#empty-obat-message').remove();
                }
            }

            updateEmptyState();

            $('form').on('submit', function(e) {
                if (selectedObats.length === 0) {
                    e.preventDefault();
                    alert('Pilih setidaknya satu obat sebelum menyimpan!');
                    return false;
                }

                // Prevent double submission
                $(this).find('button[type="submit"]').prop('disabled', true);
            });

            function reindexObatInputs() {
                // Hapus semua input yang ada
                $('input[name="obat_ids[]"]').each(function(index) {
                    $(this).attr('name', 'obat_ids[' + index + ']');
                });

                $('input[name="jumlah_obats[]"]').each(function(index) {
                    $(this).attr('name', 'jumlah_obats[' + index + ']');
                });
            }
        });


        function incrementJumlah() {
            const input = document.getElementById('jumlah_obat');
            const max = parseInt(input.getAttribute('max'));
            const currentVal = parseInt(input.value);

            if (currentVal < max) {
                input.value = currentVal + 1;
            }
        }

        function decrementJumlah() {
            const input = document.getElementById('jumlah_obat');
            const currentVal = parseInt(input.value);

            if (currentVal > 1) {
                input.value = currentVal - 1;
            }
        }
    </script>
@endpush
