<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Login Page - Customer App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />


</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position" id="auth-particles">
            <div class="bg-overlay"></div>

            {{-- <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f3f4f5" fill-opacity="1" d="M0,96L20,96C40,96,80,96,120,112C160,128,200,160,240,165.3C280,171,320,149,360,138.7C400,128,440,128,480,160C520,192,560,256,600,250.7C640,245,680,171,720,165.3C760,160,800,224,840,218.7C880,213,920,139,960,122.7C1000,107,1040,149,1080,138.7C1120,128,1160,64,1200,53.3C1240,43,1280,85,1320,112C1360,139,1400,149,1420,154.7L1440,160L1440,320L1420,320C1400,320,1360,320,1320,320C1280,320,1240,320,1200,320C1160,320,1120,320,1080,320C1040,320,1000,320,960,320C920,320,880,320,840,320C800,320,760,320,720,320C680,320,640,320,600,320C560,320,520,320,480,320C440,320,400,320,360,320C320,320,280,320,240,320C200,320,160,320,120,320C80,320,40,320,20,320L0,320Z"></path></svg>
            </div> --}}
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <p class="mt-3 fs-15 fw-medium text-white">Inventaris Gudang - Yoozdstuff Store</p>
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
                                    <p class="text-muted">Login to continue Inventaris Warehouse.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    {{-- form --}}
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>                                        

                                    <div class="mt-4">
                                        <button class="btn btn-primary btn-animation waves-effect waves-light w-100" type="submit" id="submitLogin">Login</button>
                                    </div>
                                    
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
                                <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- Jquey cdn -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>



    {{-- @include('modals.modalError') --}}

    <script>

        // Addon Passeord
        // $(document).ready(function(){
        //     $('#password-addon').on('click', function () {
        //         var passwordInput = $('#password');
        //         var passwordInputType = passwordInput.attr('type');
                
        //         if (passwordInputType === 'password') {
        //             passwordInput.attr('type', 'text');
        //             $(this).find('i').removeClass('ri-eye-fill').addClass('ri-eye-off-fill');
        //         } else {
        //             passwordInput.attr('type', 'password');
        //             $(this).find('i').removeClass('ri-eye-off-fill').addClass('ri-eye-fill');
        //         }
        //     });
        // });


        // Login Button
        // $(document).on('click', '#submitLogin', function() {
        //     let username = $('#username').val()
        //     let password = $('#password').val()

        //     $.ajax({
        //         type: 'post',
        //         url: '/login',
        //         data: {
        //             username: username,
        //             password: password,
        //         },
        //         success: function(response) {
        //             if (response.status == 'berhasil') {
        //                 window.location.href='/dashboard';
        //             } else {
        //                 $('#modalError').modal('show');
        //             }
        //         }
        //     })
        // })
    </script>


</body>

</html>