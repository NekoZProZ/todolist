<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Login</title>
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
        <form id="login-form" action="<?= base_url('home/aksi_login_p') ?>" method="post">
            <h2 class="login-title">Log in</h2>
            <!-- <h3 class="login-person">Log in</h3> -->
            <div class="input-group-icon right">
                    <div class="input-icon"></div>
                    <input class="form-control" type="text" name="table" value="pasien" readonly>
                </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="text" name="email" placeholder="Nama" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <!-- <button class="btn btn-info" onclick="changetoggle()">Change</button> -->
                <!-- <a href="<?= base_url('home/forget_pass') ?>">Forgot password?</a> -->
                <a href="<?= base_url('home/login') ?>">Change</a>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>

           <!--  <div class="text-center">Not a member?
                <a class="color-blue" href="<?= base_url('home/register') ?>">Create account</a>
            </div> -->
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
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true
                        //email: true
                    },
                    password: {
                        required: true
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
        // function changetoggle() {
        //     var titleElement = document.querySelector('input[name="table"]');
        //     if (titleElement.innerHTML === "dokter") {
        //         titleElement.innerHTML = "pasien";
        //     } else {
        //         titleElement.innerHTML = "dokter";
        //     }
        // }
    </script>
</body>

</html>