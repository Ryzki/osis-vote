@extends('layouts.main')
@section('evoting')

    <body>
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                                    {{-- <li class="breadcrumb-item">{{ ucwords($submenu) }}</li> --}}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nav tabs -->
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ $title }}</h4>
                    {{-- {{ $data_kegiatan }} --}}
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#all-order" role="tab">
                                Absensi Manual
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Barcode</a>
                        </li>
                    </ul>
                </div>
                <form id="form" class="needs-validation" action="{{ route('follow.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    {{-- barcode --}}
                                    {{-- <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    id="accordion-button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="bx bx-search-alt font-size-18"></i>
                                                    <b>Barcode</b>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body barcodeScanner">
                                                    <div class="row text-muted">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4 text-center">
                                                            <label class="form-label">Metode Scan</label>
                                                            <div class="mb-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input radio" type="radio"
                                                                        name="toggle" id="inlineRadio1" value="Barcode">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio1">Barcode</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input radio" type="radio"
                                                                        name="toggle" id="inlineRadio2"
                                                                        value="Scan Kamera">
                                                                    <label class="form-check-label" for="inlineRadio2">Scan
                                                                        Kamera</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row text-muted div_barcode">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="scanner_barcode"
                                                                class="form-control scanner_barcode" id="scanner_barcode"
                                                                placeholder="NIS" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="row text-muted div_scan_camera">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4">
                                                            <div id="qr-reader"></div>
                                                            <div id="qr-reader-results"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- akhir barcode --}}

                                    <div class="row">
                                        <div class="col-lg-6 mt-3">
                                            <div class="mb-6">
                                                <label class="form-label">
                                                    Kegiatan</label>
                                                <select class="form-control select select2 kegiatan" name="kegiatan"
                                                    id="kegiatan" required>
                                                    <option value="">-- Pilih --</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('kegiatan', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div class="mb-6">
                                                <label class="form-label">
                                                    Pembina</label>
                                                <input type="text" class="form-control" id="nama_pembina"
                                                    name="nama_pembina" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            <div class="mb-6">
                                                <label for="formrow-firstname-input" class="form-label">Nis</label>
                                                <select id="nis" class="form-control select select2" name="nis"
                                                    required>
                                                    <option value="" selected>-- Pilih --</option>
                                                    <div class="invalid-feedback">
                                                        Data wajib diisi.
                                                    </div>
                                                    {!! $errors->first('nis', '<div class="invalid-validasi">:message</div>') !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-6">
                                                <label for="formrow-firstname-input" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                                    placeholder="Siswa" readonly>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-12">
                                            <button type="button" id="tambahSiswaButton" class="btn btn-info w-md"
                                                style="float: right">
                                                Tambah Siswa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    id="accordion-button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="bx bx-search-alt font-size-18"></i>
                                                    <b>Barcode</b>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body barcodeScanner">
                                                    <div class="row text-muted">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4 text-center">
                                                            <label class="form-label">Metode Scan</label>
                                                            <div class="mb-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input radio" type="radio"
                                                                        name="toggle" id="inlineRadio1" value="Barcode">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio1">Barcode</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input radio" type="radio"
                                                                        name="toggle" id="inlineRadio2"
                                                                        value="Scan Kamera">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio2">Scan
                                                                        Kamera</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row text-muted div_barcode">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="scanner_barcode"
                                                                class="form-control scanner_barcode" id="scanner_barcode"
                                                                placeholder="NIS" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="row text-muted div_scan_camera">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4">
                                                            <div id="qr-reader"></div>
                                                            <div id="qr-reader-results"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 table-responsive mt-2">
                                        <table class="table table-responsive table-bordered table-striped"
                                            id="daftarBarcode">
                                            <thead>
                                                <tr>
                                                    <th class="text-left" style="width: 10%">No</th>
                                                    <th class="text-left" style="width: 0%" hidden>id</th>
                                                    <th class="text-left" style="width: 20%">Nis</th>
                                                    <th class="text-left" style="width: 30%">Siswa</th>
                                                    <th class="text-left" style="width: 0%" hidden>Kode</th>
                                                    <th class="text-left" style="width: 30%">Kegiatan</th>
                                                    <th class="text-left" style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-primary mt-2" type="button" style="float: right"
                                            id="simpanDataBtn">Simpan</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <style>
        #daftarBarcode tbody td.hidden {
            display: none;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script src="{{ asset('assets/scanner/html5-qrcode.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    barcode = decodedText;
                    // pembeli = document.getElementById("pembeli").value;

                    // get value database 
                    getValueScanBarcodeCamera(barcode)
                    // getValueScanBarcodeCamera(barcode, pembeli)
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: 250
                });
            html5QrcodeScanner.render(onScanSuccess);

            $('.div_scan_camera').hide();
            $('.div_barcode').hide();

            collapseOne.classList.remove("show");


            function getValueScanBarcodeCamera(nis, user) {
                var kegiatan = $("#kegiatan option:selected").text(); // Ambil nama kegiatan dari dropdown
                var kodeKegiatan = $("#kegiatan").val(); // Ambil kode kegiatan dari dropdown

                // Validasi apakah kegiatan sudah dipilih
                if (!kodeKegiatan) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pilih Kegiatan',
                        text: 'Harap pilih kegiatan terlebih dahulu.',
                    });
                    return;
                }

                var table = $('#daftarBarcode').DataTable();
                var existingData = new Set();

                // Loop through existing rows to populate existingData
                table.rows().every(function() {
                    var rowData = this.data();
                    var dataKey = rowData[1] + "-" + rowData[
                        4]; // Assuming ID is in the first column and Kode Kegiatan is in the fifth column
                    existingData.add(dataKey);
                });

                $.ajax({
                    type: "POST",
                    url: '{{ route('follow.scanBarcode1') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        nis,
                    },
                    success: response => {
                        console.log(response);
                        if (response.code == 200) {
                            // Handle jika response memiliki kode 200 (berhasil)
                            if (response.type == 'siswa') {
                                console.log(response);

                                // Buat kunci unik untuk data siswa dari barcode
                                var dataKey = response.id + "-" + kodeKegiatan;

                                // Cek apakah data siswa dari barcode sudah ada di tabel
                                if (existingData.has(dataKey)) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Data sudah ada',
                                        text: 'Data siswa dari barcode sudah ada di input.',
                                    });
                                    return;
                                }

                                // Tambahkan data siswa dari barcode ke dalam tabel
                                var rowNode = table.row.add([
                                    table.rows().count() + 1,
                                    response.id,
                                    response.nis,
                                    response.name,
                                    kodeKegiatan,
                                    kegiatan,
                                    '<a href="#" class="text-danger delete-record"><i class="mdi mdi-delete font-size-18"></i></a>'
                                ]).draw().node();

                                // Tambahkan data siswa dari barcode ke dalam Set existingData
                                existingData.add(dataKey);

                                // Tambahkan data ke dalam row sebagai atribut data-barcode
                                $(rowNode).attr('data-barcode', dataKey);

                                // Bersihkan nilai input barcode setelah berhasil
                                $('#scanner_barcode').val('');
                                var lastRow = table.row(table.rows().count() - 1);
                                var cells = lastRow.node().cells;
                                $(cells[1]).addClass('hidden');
                                $(cells[4]).addClass('hidden');

                                // Hapus data jika tombol delete di klik
                                $(rowNode).find('.delete-record').click(function(e) {
                                    e.preventDefault();
                                    var dataKeyToRemove = $(rowNode).attr('data-barcode');
                                    existingData.delete(dataKeyToRemove);
                                    table.row(rowNode).remove().draw();
                                });

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Siswa sudah terdaftar!',
                                    showConfirmButton: false,
                                    timer: 3000,
                                })
                            }
                        } else {
                            // Handle jika response memiliki kode selain 200 (gagal)
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan saat memproses permintaan.',
                                showConfirmButton: false,
                                timer: 3000,
                            });
                        }
                    },
                    error: (err) => {
                        console.log(err);
                    },
                });
            }


            $(document).ready(function() {
                $('.radio').click(function() {
                    let metode_scan = $(this).val();
                    if (metode_scan == 'Barcode') {
                        $('.div_scan_camera').hide();
                        $('.div_barcode').show();
                    } else {
                        $('.div_scan_camera').show();
                        $('.div_barcode').hide();
                    }
                });

                $(".scanner_barcode").change(function() {
                    let barcode = $(this).val();
                    // user = document.getElementById("user").value;
                    document.getElementById('scanner_barcode').value = '';
                    // get value database 
                    getValueScanBarcodeCamera(barcode)
                    // getValueScanBarcodeCamera(barcode, user)
                });

            })
        });

        // select option barcode
        $(document).ready(function() {

            var selectKegiatan = $('#kegiatan');

            // Variabel untuk menyimpan nilai kegiatan terpilih
            var selectedKegiatan;

            // Saat memilih kegiatan, isi nilai nama_pembina dengan user_name yang sesuai
            selectKegiatan.on('change', function() {
                var selectedOption = $(this).find(':selected');
                var user_name = selectedOption.data('id');
                $('#nama_pembina').val(user_name);
            });

            // Ambil data kegiatan dari server
            $.ajax({
                type: "GET",
                url: '{{ route('follow.data_kegiatan') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: response => {
                    $.each(response.data, function(i, item) {
                        selectKegiatan.append(
                            `<option value="${item.id}" data-id="${item.user_name}">${item.ekstrakurikuler_name}</option>`
                        )
                    });
                },
                error: (err) => {
                    console.log(err);
                },
            });

            // cari data siswa
            selectKegiatan.on('change', function() {
                var selectedOption = $(this).find(':selected');
                var user_name = selectedOption.data('id');
                $('#nama_pembina').val(user_name);

                // Update nilai selectedKegiatan
                selectedKegiatan = $(this).val();
                console.log(selectedKegiatan);
                // Bersihkan dropdown NIS
                $('#nis').empty();

                // Cek apakah kegiatan dipilih
                if (selectedKegiatan) {
                    // Lakukan request AJAX untuk mengisi dropdown NIS berdasarkan kegiatan
                    $.ajax({
                        type: "GET",
                        url: '{{ route('follow.cari_siswa') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            kegiatan: selectedKegiatan
                        },
                        success: function(response) {
                            if (response.data) {
                                $('#nis').append(
                                    `<option value="">-- Pilih --</option>`
                                );

                                // Isi dropdown NIS dengan data siswa yang sesuai
                                $.each(response.data, function(i, item) {
                                    $('#nis').append(
                                        //pastikan di query nya di select ada id nya karena ada item.id
                                        `<option value="${item.id}" data-id="${item.name}">${item.nis}</option>`
                                    );
                                });

                                $('#nis').change(function() {
                                    var nama_siswa = $('option:selected', this).attr(
                                        'data-id');
                                    document.getElementById("nama_siswa").value =
                                        nama_siswa;
                                });

                            } else {
                                // Tampilkan pesan jika tidak ada siswa yang sesuai
                                $('#nis').append(
                                    `<option value="">-- Pilih --</option>`
                                );
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                } else {
                    // Jika tidak ada kegiatan yang dipilih, bersihkan dropdown NIS
                    $('#nis').empty();
                    $('#nis').append(
                        `<option value="">-- Pilih --</option>`
                    );
                    // Bersihkan form input nama_siswa
                    $('#nama_siswa').val('');
                }
            });

            $(document).ready(function() {
                // Inisialisasi DataTable dengan konfigurasi
                var table = $('#daftarBarcode').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": false,
                    "info": false,
                });

                // Ketika tombol "Tambah Siswa" diklik
                // $("#tambahSiswaButton").click(function() {
                //     // Ambil data kegiatan dan nis dari form
                //     var kegiatan = $("#kegiatan option:selected").text();
                //     var id = $("#nis").val();
                //     var nis = $("#nis option:selected").text();
                //     var namaSiswa = $("#nama_siswa").val();

                //     $('#nis').val("").trigger('change')

                //     // Validasi kegiatan dan nis
                //     if (!kegiatan || !id) {
                //         Swal.fire({
                //             icon: 'error',
                //             title: 'Validasi Gagal',
                //             text: 'Kegiatan dan NIS harus dipilih.',
                //         });
                //         return;
                //     }

                //     // Tambahkan data siswa ke dalam tabel dengan DataTable
                //     table.row.add([
                //         table.rows().count() + 1,
                //         id,
                //         nis,
                //         namaSiswa,
                //         $("#kegiatan").val(), //  kode kegiatan
                //         kegiatan, //  nama kegiatan
                //         '<a href="#" class="text-danger delete-record"><i class="mdi mdi-delete font-size-18"></i></a>' // Tautan Hapus
                //     ]).draw();

                //     // Reset form ke default
                //     // $("#kegiatan").val("");
                //     $("#nis").val("");
                //     $("#nama_siswa").val("");

                //     // var lastRow = table.row(table.rows().count() - 1);
                //     // var cells = lastRow.node().cells;
                //     // $(cells[1]).addClass('hidden'); 
                //     // $(cells[4]).addClass('hidden'); 

                //     var lastRow = table.row(table.rows().count() - 1).nodes()
                //         .to$();
                //     var cells = lastRow[0].cells;
                //     $(cells[1]).addClass('hidden');
                //     $(cells[4]).addClass('hidden');

                //     lastRow.find('.delete-record').click(function(e) {
                //         e.preventDefault();
                //         table.row(lastRow).remove().draw();
                //     });

                // });

                var table = $('#daftarBarcode').DataTable();
                var existingData = new Set();

                $("#tambahSiswaButton").click(function() {
                    // Ambil data kegiatan dan nis dari form
                    var kegiatan = $("#kegiatan option:selected").text();
                    var id = $("#nis").val();
                    var nis = $("#nis option:selected").text();
                    var namaSiswa = $("#nama_siswa").val();

                    $('#nis').val("").trigger('change')

                    // Validasi kegiatan dan nis
                    if (!kegiatan || !id) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            text: 'Kegiatan dan NIS harus dipilih.',
                        });
                        return;
                    }

                    var dataKey = id + "-" + kegiatan;

                    // Cek apakah data sudah ada di tabel
                    if (existingData.has(dataKey)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data sudah ada',
                            text: 'Data siswa sudah ada di input.',
                        });
                        return;
                    }

                    // Tambahkan data siswa ke dalam tabel dengan DataTable
                    var rowNode = table.row.add([
                        table.rows().count() + 1,
                        id,
                        nis,
                        namaSiswa,
                        $("#kegiatan").val(), // kode kegiatan
                        kegiatan, // nama kegiatan
                        '<a href="#" class="text-danger delete-record"><i class="mdi mdi-delete font-size-18"></i></a>'
                    ]).draw().node();

                    // Tambahkan data ke Set
                    existingData.add(dataKey);

                    // Reset form ke default
                    $("#nis").val("");
                    $("#nama_siswa").val("");

                    var lastRow = table.row(table.rows().count() - 1).nodes().to$();
                    var cells = lastRow[0].cells;
                    $(cells[1]).addClass('hidden');
                    $(cells[4]).addClass('hidden');

                    lastRow.find('.delete-record').click(function(e) {
                        e.preventDefault();
                        // Hapus data dari Set saat data dihapus dari tabel
                        existingData.delete(dataKey);
                        table.row(lastRow).remove().draw();
                    });
                });


            });

            $("#simpanDataBtn").click(function() {
                // Mengumpulkan data dari tabel daftarBarcode
                var tableData = [];
                var table = $('#daftarBarcode').DataTable();
                table.rows().every(function() {
                    var rowData = this.data();
                    var dataItem = {
                        'id': rowData[1],
                        'nis': rowData[2],
                        'nama_siswa': rowData[3],
                        'kode_kegiatan': rowData[4],
                        'nama_kegiatan': rowData[5]
                    };
                    tableData.push(dataItem);
                });

                // Lakukan pengecekan data duplikat di tabel
                var duplicateData = findDuplicateData(tableData);

                if (duplicateData.length > 0) {
                    // Tampilkan pesan alert jika ada data duplikat di tabel
                    var message = 'Terdapat data duplikat:\n';
                    $.each(duplicateData, function(index, data) {
                        message += data.nama_siswa + ' pada kegiatan ' + data.nama_kegiatan + '\n';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Data duplikat',
                        text: message,
                    });
                } else {
                    // Mengirim data ke controller untuk pengecekan data duplikat di database
                    $.ajax({
                        type: "POST",
                        url: '{{ route('follow.cek_duplicate') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'tableData': tableData
                        },
                        success: function(response) {
                            if (response.duplicateData.length > 0) {
                                // Tampilkan pesan alert jika ada data duplikat di database
                                var message = 'Terdapat data duplikat di database:\n';
                                $.each(response.duplicateData, function(index, data) {
                                    message += data.nama_siswa + ' pada kegiatan ' +
                                        data.nama_kegiatan + '\n';
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Data duplikat di database',
                                    text: message,
                                });
                            } else {
                                // Jika tidak ada data duplikat di database, lanjutkan untuk menyimpan data
                                $.ajax({
                                    type: "POST",
                                    url: '{{ route('follow.simpan_pengikut') }}',
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        'tableData': tableData
                                    },
                                    success: function(response) {
                                        if (response.code == 200) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Data berhasil disimpan.',
                                                showConfirmButton: false,
                                                timer: 2000,
                                            });

                                            // Bersihkan data di tabel daftarBarcode
                                            table.clear().draw();
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Terjadi kesalahan saat menyimpan data.',
                                                showConfirmButton: false,
                                                timer: 3000,
                                            });
                                        }
                                    },
                                    error: function(err) {
                                        console.log(err);
                                    }
                                });
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                }
            });

            // Fungsi untuk mencari data duplikat
            function findDuplicateData(data) {
                var seen = {};
                var duplicates = [];

                for (var i = 0; i < data.length; i++) {
                    var item = data[i];
                    var key = item.id + '-' + item.kode_kegiatan;

                    if (seen[key]) {
                        duplicates.push(item);
                    } else {
                        seen[key] = true;
                    }
                }

                return duplicates;
            }
        });


        //daftar pengikut

        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#daftarPengikut').DataTable();

            $('#daftar').change(function() {
                var selectedId = $(this).val();

                if (selectedId !== '') {
                    $.ajax({
                        type: 'GET',
                        url: '/get-siswa-by-extra/' + selectedId,
                        dataType: 'json',
                        success: function(data) {
                            // Kosongkan tabel sebelum menambahkan data baru
                            table.clear().draw();

                            // Inisialisasi nomor urut
                            var counter = 1;

                            // Handle data dan tampilkan dalam tabel
                            $.each(data.data, function(index, siswa) {
                                table.row.add([
                                    counter,
                                    siswa.data_nis,
                                    siswa.nama_pengikut
                                ]).draw(false);

                                // Increment nomor urut
                                counter++;
                            });
                        },
                        error: function(error) {
                            console.log(error);
                            // Handle kesalahan jika diperlukan
                        }
                    });
                } else {
                    // Kosongkan tabel jika tidak ada opsi yang dipilih
                    table.clear().draw();
                }
            });
        });
    </script>
@endsection
