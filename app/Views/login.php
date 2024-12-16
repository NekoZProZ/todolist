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
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('logo/'.$logo->foto_icon)?>">
    <title><?= $logo->nama_web ?></title>
    <!-- Custom CSS -->
    <link href="<?= base_url('dist/css/style.min.css') ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
    .captcha-box {
      font-family: 'Courier New', Courier, monospace;
      font-size: 24px;
      font-weight: bold;
      background-color: #eee;
      padding: 10px;
      display: inline-block;
      letter-spacing: 5px;
      margin-bottom: 10px;
    }
    
    </style>
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
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <h3 style="color: white;">Login User </h3>
                        <!-- $capt->status  -->
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="loginform" action="<?= base_url('home/aksi_login') ?>" method="post">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required="" name="username">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="" name="password">
                                </div>
                                <input type="hidden" name="tb" value="1">
                                <?php if( $capt->status=='online'){?>
                                <div class="g-recaptcha" data-sitekey="6LeshCAqAAAAAOGLdQWzAJg5gwudDshcUM0J5hcY" data-callback="onLoginFormCaptcha"></div>
      <br/>
                                <?php } ?>
                                <?php if( $capt->status=='offline'){?>
                                    <div id="captcha" class="captcha-box"></div>
                                    
                                    <!-- <label for="captcha-input">Enter CAPTCHA:</label> -->
                                    <input type="text" id="captcha-input" required>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i>Membuat Akun/Register</button>
                                        <button class="btn btn-success float-right" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <h3 style="color: white;">Register</h3>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" id="loginad" action="<?= base_url('home/aksi_register') ?>" method="post">
                            <!-- email -->
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required="" name="username">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Nama" aria-label="Nama" aria-describedby="basic-addon1" required="" name="nama">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="" name="password">
                                </div>
                                <input type="hidden" name="tb" value="2">
                                <?php if( $capt->status=='online'){?>
                                <div class="g-recaptcha" data-sitekey="6LeshCAqAAAAAOGLdQWzAJg5gwudDshcUM0J5hcY" data-callback="onLoginAdCaptcha"></div>
      <br/>
                                <?php } ?>
                                <?php if( $capt->status=='offline'){?>
                                    <div id="captcha" class="captcha-box"></div>
                                    
                                    <!-- <label for="captcha-input">Enter CAPTCHA:</label> -->
                                    <input type="text" id="captcha-input" required>
                                <?php } ?>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-right" type="submit" name="action">Create</button>
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
    <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('assets/libs/popper.js/dist/umd/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>












<?php if( $capt->status=='online'){?>

<script>
        // Store reCAPTCHA responses for each form
    var loginFormCaptchaResponse = "";
    var loginAdCaptchaResponse = "";

    // Callback function for loginform's reCAPTCHA
    function onLoginFormCaptcha(response) {
        loginFormCaptchaResponse = response;
    }

    // Callback function for loginad's reCAPTCHA
    function onLoginAdCaptcha(response) {
        loginAdCaptchaResponse = response;
    }

    // Validate reCAPTCHA before form submission
    document.getElementById('loginform').addEventListener('submit', function(event) {
        if (loginFormCaptchaResponse.length === 0) {
            alert("Please complete the reCAPTCHA for Login.");
            event.preventDefault();
        }
    });

    document.getElementById('loginad').addEventListener('submit', function(event) {
        if (loginAdCaptchaResponse.length === 0) {
            alert("Please complete the reCAPTCHA for Ad.");
            event.preventDefault();
        }
    });
    </script>

<?php } ?>













<?php if( $capt->status=='offline'){?>

    <script>
    // Function to generate random alphanumeric string
    function generateCaptcha() {
      const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      let captcha = '';
      for (let i = 0; i < 6; i++) {
        captcha += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return captcha;
    }

    // Display the CAPTCHA when the page loads
    const captchaText = generateCaptcha();
    document.getElementById('captcha').innerText = captchaText;















    // Form submission event listener
    //document.getElementById('loginad').addEventListener('submit', function(event) {
    document.getElementById('loginform').addEventListener('submit', function (event) {
    //   e.preventDefault();
      const userInput = document.getElementById('captcha-input').value;
    //   const message = document.getElementById('message');
      
      // Check if the input matches the CAPTCHA
      if (userInput === captchaText) {
        // message.style.color = 'green';
        // message.innerText = 'CAPTCHA matched!';
      } else {
        // message.style.color = 'red';
        // message.innerText = 'CAPTCHA did not match. Try again.';
        alert("Please complete the reCAPTCHA for Login.");
            event.preventDefault();
      }
    });
  </script>

<?php } ?>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
</body>

</html>































