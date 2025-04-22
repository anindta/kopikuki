<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="24x24" href="{{ asset('image/logo.png') }}">
    <title>KOPIKUKI</title>
    <!-- Custom CSS -->
    <link href="/backend/dist/css/style.min.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">

        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center "
            style="background-color:white;">
            <div class=""
                style="background-color: #14213D; padding: 30px; border-radius: 15px;">
                <div id="loginform">
                    <div class="text-center p-t-9 p-b-9">
                        <span class="db">
                            <img src="{{ asset('image/logo.png') }}" alt="logo" style="width:150px; height: auto;" />
                        </span>
                    </div>
                    <!-- Form -->
                    <!-- error -->
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                    <!-- errorEnd -->
                    <form class="form-horizontal m-t-20" id="loginform" action="{{ route('backend.login') }}"
                        method="post">
                        @csrf
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-white" id="basic-addon1"
                                            style="background-color: #FCA311; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                                            <i class="ti-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="email" value="{{ old('email') }}"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="Masukkan Email" aria-label="Username"
                                        aria-describedby="basic-addon1"  style=" border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
                                        
                                    @error('email')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-white" id="basic-addon2"
                                        style="background-color: #FCA311; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                                            <i class="ti-pencil"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="Masukkan Password" aria-label="Password"
                                        aria-describedby="basic-addon1" style=" border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
                                    @error('password')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="border-top: 2px solid white;">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn" id="to-recover" type="button" style="background-color:#14213D; color:white; border-radius:15px">
                                            <i class="fa fa-lock m-r-5"></i> Lost password?
                                        </button>
                                        <button class="btn float-right" type="submit"
                                            style="background-color:#FCA311; color:white; border-radius:15px">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Masukkan alamat email Anda di bawah dan kami akan mengirimkan petunjuk caranya
                        untuk memulihkan kata sandi</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white" id="basic-addon1" style="background-color: #FCA311; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                                        <i class="ti-email"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email" style=" border-top-right-radius: 15px; border-bottom-right-radius: 15px;"
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <button class="btn float-right" style="background-color: #FCA311; border-radius:10px;" type="button"
                                        name="action">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <!-- <script src="libs/jquery/dist/jquery.min.js"></script> -->
    <!-- Bootstrap tether Core JavaScript -->
    <!-- <script src="libs/popper.js/dist/umd/popper.min.js'"></script>
    <script src="libs/bootstrap/dist/js/bootstrap.min.js '"></script> -->
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js CDN (required for Bootstrap tooltips and popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function () {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function () {

            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>

</body>

</html>