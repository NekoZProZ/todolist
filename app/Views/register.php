<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Register</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet" />
    <link href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" />
    <link href="<?= base_url('vendors/themify-icons/css/themify-icons.css')?>" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?= base_url('css/main.css')?>" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?= base_url('css/pages/auth-light.css')?>" rel="stylesheet" />
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="">AdminCAST</a>
        </div>
        <form id="register-form" action="<?= base_url('home/aksi_register') ?>" method="post">
            <h2 class="login-title">Sign Up</h2>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="first_name" placeholder="First Name">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="last_name" placeholder="Last Name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Password">
            </div>

            
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Sign up</button>
            </div>
            
            <div class="text-center">Already a member?
                <a class="color-blue" href="<?= base_url('home/login') ?>">Login here</a>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="<?= base_url('vendors/jquery/dist/jquery.min.js')?>" type="text/javascript"></script>
    <script src="<?= base_url('vendors/popper.js/dist/umd/popper.min.js')?>" type="text/javascript"></script>
    <script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="<?= base_url('vendors/jquery-validation/dist/jquery.validate.min.js')?>" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?= base_url('js/app.js')?>" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#register-form').validate({
                errorClass: "help-block",
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        confirmed: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>