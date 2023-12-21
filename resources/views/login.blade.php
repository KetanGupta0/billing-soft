<!doctype html>
<html lang="en" data-layout="semibox" data-sidebar-visibility="show" data-topbar="light" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<head>

    <meta charset="utf-8" />
    <title>Sign In | SpecBits - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.ico') }}">

    <!-- Layout config Js -->
    <script src="{{ url('public/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ url('public/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{ url('public/assets/images/logo-light.png') }}" alt=""
                                        height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to SpecBits.</p>
                                    <p id="error" class="alert alert-danger" style="display: none;"></p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="">

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username"
                                                placeholder="Enter username">
                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    placeholder="Enter password" id="password-input">
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>



                                        <div class="mt-4">
                                            <button class="btn btn-secondary w-100" id="signin" type="button">Sign
                                                In</button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by SpecBits
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $.ajax({
                method: 'post',
                url: "{{ url('checklogin') }}",
                data: {
                    uname: 'a',
                    upass: 'b'
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status === 419) {
                        location.reload();
                    }
                }
            });


            $(document).on('click', '#signin', function() {
                var uname = $('#username').val();
                var upass = $('#password-input').val();
                if (uname != '' && upass != '') {
                    $.ajax({
                        method: 'post',
                        url: "{{ url('checklogin') }}",
                        data: {
                            uname: uname,
                            upass: upass
                        },
                        success: function(result) {
                            if (result == 0) {
                                $('#error').html('Incorrect Email or Password');
                                $("#error").show();
                                $("#error").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#error").slideUp(500);
                                });
                            } else if (result == 1) {
                                window.location = "{{ url('dashboard') }}";
                            }
                        },
                    });
                } else {
                    $('#error').html('All fields are Required');
                    $("#error").show();
                    $("#error").fadeTo(2000, 500).slideUp(500, function() {
                        $("#error").slideUp(500);
                    });
                }
            });

        });
    </script>

    <!-- JAVASCRIPT -->
    <script src="{{ url('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('public/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('public/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('public/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ url('public/assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ url('public/assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ url('public/assets/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ url('public/assets/js/pages/password-addon.init.js') }}"></script>
</body>


</html>
