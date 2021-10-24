<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('global.site_title') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" type="text/css">
</head>

<body class="login-page">)
    <!-- Main content -->
    <div class="main-content">
        @yield('content')
    </div>

<!-- Footer -->
<footer id="footer-main">
<div class="container">
    <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-12 mb-5">
            <div class="copyright text-center text-white animated fadeInUp">
                &copy; 2020 Loanzspot All Rights Reserved.
            </div>
        </div>
    </div>
</div>
</footer>

<div class="modal fade" id="forgot-form" tabindex="-1" role="dialog">
<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-body p-0">
            <div class="card bg-form border-0 mb-0">
                <div class="text-right">
                    <button type="button" class="close mt-2 mr-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body px-lg-5 py-lg-4">
                    <div class="text-muted mb-4">
                        <h3>Forgot Password?</h3>
                        <p>Please enter your registered email to get reset password link.</p>
                    </div>
                    <form role="form">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" placeholder="Email" type="email" />
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary btn-block my-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
