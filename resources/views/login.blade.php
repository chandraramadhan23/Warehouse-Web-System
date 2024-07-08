<!doctype html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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

<link rel="stylesheet" href="assets/login/css/style.css">

</head>
<body>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        
                        <h3 class="text-center">Sign In</h3>
                        <p class="text-center mb-4">Warehouse System</p>

                        {{-- Form --}}
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Username" id="username">
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Password" id="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3" id="login">Login</button>
                            </div>
                        {{-- End Form --}}

                    </div>
                </div>
            </div>
        </div>
    </section>



<!-- Jquey cdn -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>

<!-- Sweet Alert 2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>

    // Login
    $(document).on('click', '#login', function() {
        let username = $('#username').val()
        let password = $('#password').val()

        $.ajax({
            type: 'post',
            url: '/login',
            data: {
                username: username,
                password: password,
            },
            success: function(response) {
                if (response.status == 'berhasil') {
                        window.location.href='/dashboard';
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Anda tidak dapat login!",
                        icon: "error"
                    });

                    $('#username').val('')
                    $('#password').val('')
                }
            }
        })
    })

</script>


</body>
</html>

