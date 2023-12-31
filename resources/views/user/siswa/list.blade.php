@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                @if (Auth::user()->id == 1)
                                    <a href="{{ route('pengguna.tambah_siswa') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Tambah Siswa
                                    </a>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['name'])) {
                                        } else {
                                            echo 'collapsed';
                                        } ?>" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="bx bx-search-alt font-size-18"></i>
                                            <b>Cari & Unduh Data</b>
                                        </button>
                                    </h2>

                                    <div id="collapseOne" class="accordion-collapse collapse <?php
                                    if (isset($_GET['name']) or isset($_GET['email']) or isset($_GET['nis']) or isset($_GET['class_id']) or isset($_GET['address']) or isset($_GET['phone'])) {
                                        if ($_GET['name'] != null or $_GET['email'] != null or $_GET['nis'] != null or $_GET['class_id'] != null or $_GET['address'] != null or $_GET['phone'] != null) {
                                            echo 'show';
                                        }
                                    }
                                    if (isset($_GET['like'])) {
                                        if ($_GET['like'] != null) {
                                            echo 'show';
                                        }
                                    } ?>"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                                <form>
                                                    <div class="row" id="id_where">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-2 mb-2">
                                                                    <input type="text" name="name" id="name"
                                                                        value="{{ isset($_GET['name']) ? $_GET['name'] : null }}"
                                                                        class="form-control" placeholder="Nama"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="email" id="email"
                                                                        value="{{ isset($_GET['email']) ? $_GET['email'] : null }}"
                                                                        class="form-control" placeholder="Email"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="nis" id="nis"
                                                                        value="{{ isset($_GET['nis']) ? $_GET['nis'] : null }}"
                                                                        class="form-control" placeholder="Nis"
                                                                        autocomplete="off">
                                                                </div>

                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="class_id" id="class_id"
                                                                        value="{{ isset($_GET['class_id']) ? $_GET['class_id'] : null }}"
                                                                        class="form-control" placeholder="Kelas"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="address" id="address"
                                                                        value="{{ isset($_GET['address']) ? $_GET['address'] : null }}"
                                                                        class="form-control" placeholder="Alamat"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="phone" id="phone"
                                                                        value="{{ isset($_GET['phone']) ? $_GET['phone'] : null }}"
                                                                        class="form-control" placeholder="Telepon"
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="id_like" style="display: none">
                                                        <div class="col-md-2 mb-2">
                                                            <input type="text" name="search_manual" id="search_manual"
                                                                value="{{ isset($_GET['search_manual']) ? $_GET['search_manual'] : null }}"
                                                                class="form-control" placeholder="Search">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-2 mb-2">
                                                            <div class="form-check form-check-right mb-3">
                                                                <input class="form-check-input" name="like"
                                                                    type="checkbox" id="like"
                                                                    value="{{ isset($_GET['like']) ? 'search' : 'default' }}"
                                                                    {{ isset($_GET['like']) ? 'checked' : null }}
                                                                    onclick="toggleCheckbox()">
                                                                <label class="form-check-label" for="like">
                                                                    Like semua data
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-10 mb-2">
                                                            <button type="submit"
                                                                class="btn btn-primary w-md">Cari</button>
                                                            <a href="{{ route('pengguna.index') }}"
                                                                class="btn btn-secondary w-md">Batal</a>
                                                            @if (isset($_GET['name']) or isset($_GET['like']))
                                                                <?php
                                                                $name = $_GET['name'];
                                                                $email = $_GET['email'];
                                                                $nis = $_GET['nis'];
                                                                $class_id = $_GET['class_id'];
                                                                $address = $_GET['address'];
                                                                $phone = $_GET['phone'];
                                                                // $name = $_GET['name'];
                                                                $search_manual = $_GET['search_manual'];
                                                                if (isset($_GET['like'])) {
                                                                    $like = $_GET['like'];
                                                                } else {
                                                                    $like = null;
                                                                }
                                                                ?>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nis</th>
                                        <th>Kelas</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script>
        function toggleCheckbox() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("name").value = null;
                document.getElementById("email").value = null;
                document.getElementById("nis").value = null;
                document.getElementById("class_id").value = null;
                document.getElementById("address").value = null;
                document.getElementById("phone").value = null;
                // document.getElementById("name").value = null;
                $('#type').val("").trigger('change')
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }
        }

        $(document).ready(function() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("name").value = null;
                document.getElementById("email").value = null;
                document.getElementById("nis").value = null;
                document.getElementById("class_id").value = null;
                document.getElementById("address").value = null;
                document.getElementById("phone").value = null;
                // document.getElementById("name").value = null;
                $('#type').val("").trigger('change')
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }

            // var i = document.getElementById("kode_transaksi").value = null;
            // console.log(i);

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('pengguna.get_data_siswa') }}",
                    data: function(d) {
                        d.name = (document.getElementById("name").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "name").value : null;
                        d.email = (document.getElementById("email").value.length != 0) ?
                            document
                            .getElementById(
                                "email").value : null;
                        d.nis = (document.getElementById("nis").value.length != 0) ?
                            document
                            .getElementById(
                                "nis").value : null;
                        d.class_id = (document.getElementById("class_id").value.length != 0) ?
                            document
                            .getElementById(
                                "class_id").value : null;
                        d.address = (document.getElementById("address").value.length != 0) ?
                            document
                            .getElementById(
                                "address").value : null;
                        d.phone = (document.getElementById("phone").value.length != 0) ?
                            document
                            .getElementById(
                                "phone").value : null;
                        d.search_manual = (document.getElementById("search_manual").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "search_manual").value : null;
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }

                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'class',
                        name: 'class'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });


        function showResetForm(id) {
            Swal.fire({
                title: 'Konfirmasi Reset Password',
                text: "Anda yakin ingin mereset password siswa ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Menampilkan formulir reset password
                    const formHtml = `
                    <form id="reset-form-${id}">
                        @csrf
                        <input type="hidden" name="student_id" value="${id}">
                        <input type="password" name="new_password" placeholder="Password baru" required>
                        <button type="submit">Reset Password</button>
                    </form>
                `;

                    Swal.fire({
                        title: 'Reset Password',
                        html: formHtml,
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });

                    // Submit form saat diisi
                    const resetForm = document.getElementById(`reset-form-${id}`);
                    resetForm.addEventListener('submit', (event) => {
                        event.preventDefault();
                        resetPassword(id, resetForm.new_password.value);
                    });
                }
            });
        }

        function resetPassword(id, newPassword) {
            // Kirim permintaan AJAX untuk mereset password
            axios.post(`/reset-password/${id}`, {
                    new_password: newPassword
                })
                .then(response => {
                    Swal.fire(
                        'Berhasil!',
                        'Password siswa berhasil di-reset.',
                        'success'
                    ).then(() => {
                        // Refresh halaman atau lakukan tindakan lain yang sesuai
                        location.reload();
                    });
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat mereset password.',
                        'error'
                    );
                });
        }
    </script>
@endsection
