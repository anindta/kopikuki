<html lang="en" dir="ltr" style="background-color: #e5e5e5;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Responsive design settings -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/logo.png') }}">
    <title>KOPIKUKI</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js for IE8 support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div id="main-wrapper" style="background-color: #14213D">
        <!-- Topbar Header -->
        <header class="topbar" data-navbarbg="skin5" style="background-color: #14213D">
            <nav class="navbar top-navbar navbar-expand-md " style="background-color: #14213D; color: white;">
                <div class="navbar-header">

                    <!-- Sidebar Toggle for Mobile -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- Logo -->
                    <a class="navbar-brand" href="/backend/beranda">
                        <b class="logo-icon p-l-3">
                            <img src="{{ asset('image/logo.png') }}" alt="homepage" class="light-logo"
                                style="width:50px; height: auto;" />
                        </b>
                        <span class="logo-text" style="color: white; ">
                            kopikuki Admin
                        </span>
                    </a>
                </div>

                <!-- Navbar Collapse -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5"
                    style="background-color: #14213D">
                    <ul class="navbar-nav float-left mr-auto" style="background-color: #14213D">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light " href="javascript:void(0)"
                                data-sidebartype="mini-sidebar" style="color:white;">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right" style="background-color: #14213D">
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic d-flex align-items-center"
                                href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::user()->foto)
                                    <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user"
                                        class="rounded-circle" width="31">
                                @else
                                    <img src="{{ asset('storage/img-user/img-default.jpg') }}" alt="user"
                                        class="rounded-circle" width="31">
                                @endif
                                <div class="ml-2 text-left d-flex flex-column" style="color:white;">
                                    <small class="font-weight-bold mb-0">{{ Auth::user()->nama }}</small>
                                    <small class=" mb-0" style="margin-top: -50px;">{{ Auth::user()->email }}</small>
                                </div>

                            </a>


                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="{{ route('backend.user.edit', Auth::user()->id) }}">
                                    <i class="ti-user m-r-5 m-l-5"></i> Profil Saya
                                </a>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Keluar
                                </a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left Sidebar -->
        <aside class="left-sidebar" data-sidebarbg="skin5" style="background-color: #14213D">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30" style="background-color: #14213D">
                        <li class="sidebar-item" style="background-color: #14213D">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" style="color: white;"
                                href="{{ route('backend.beranda') }}" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Beranda</span>
                            </a>
                        </li>
                        <li class="sidebar-item" style="background-color: #14213D">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" style="color: white;"
                                href="{{ route('backend.user.index') }}" aria-expanded="false">
                                <i class="mdi mdi-account"></i><span class="hide-menu">User</span>
                            </a>
                        </li>
                        <li class="sidebar-item" style="background-color: #14213D">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                <i class="mdi mdi-shopping"></i><span class="hide-menu">Data Produk</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level" style="background-color: #14213D">
                                <li class="sidebar-item"><a ss="sidebar-item" style="background-color: #14213D">
                                        <a href="{{ route('backend.kategori.index') }}" class="sidebar-link"><i
                                                class="mdi mdi-chevron-right"></i><span
                                                class="hide-menu">Kategori</span></a></li>
                                <li class="sidebar-item"><a href="{{ route('backend.produk.index') }}"
                                        class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                            class="hide-menu">Produk</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('backend.customer.index') }}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Customer</span></a>
                        </li>
                        <li class="sidebar-item" style="background-color: #14213D">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                <i class="mdi mdi-receipt"></i><span class="hide-menu">Laporan </span></a>
                            <ul aria-expanded="false" class="collapse  first-level" style="background-color: #14213D">
                                <li class="sidebar-item"><a href="{{route('backend.laporan.formuser') }}"
                                        style="background-color: #14213D" class="sidebar-link"><i
                                            class="mdi mdi-chevron-right"></i><span class="hide-menu"> User </span></a>
                                </li>
                                <li class="sidebar-item" style="background-color: #14213D"><a
                                        href="{{ route('backend.laporan.formproduk') }}" class="sidebar-link"><i
                                            class="mdi mdi-chevron-right"></i><span class="hide-menu"> Produk</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="container-fluid" style="background-color: #e5e5e5;">
                <!-- Page Content -->
                @yield('content')
            </div>

            <!-- Footer -->
        </div>
    </div>

    <!-- Javascripts -->
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ asset('backend/dist/js/waves.js') }}"></script>
    <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $('#zero_config').DataTable();
    </script>

    <!-- Logout form -->
    <form id="keluar-app" action="{{ route('backend.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Sweetalert -->
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}"
            });
        </script>
    @endif

    <!-- Confirmation for delete -->
    <script type="text/javascript">
        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var konfdelete = $(this).data("konf-delete");
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus Data?',
                html: "Data yang dihapus <strong>" + konfdelete + "</strong> tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dihapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
                        .then(() => {
                            form.submit();
                        });
                }
            });
        });
    </script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- Uncomment the line below if you prefer using CDN -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> -->
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function previewFoto() {
            const foto = document.querySelector('input[name="foto"]');
            const fotoPreview = document.querySelector('.foto-preview');
            fotoPreview.style.display = 'block';
            const fotoReader = new FileReader();
            fotoReader.readAsDataURL(foto.files[0]);
            fotoReader.onload = function (fotoEvent) {
                fotoPreview.src = fotoEvent.target.result;
                fotoPreview.style.width = '100%'
            }
        }
    </script>
    <!-- Memuat Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>






</body>

</html>