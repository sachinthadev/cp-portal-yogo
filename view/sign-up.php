<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign In | YOGO - Corporate Portal</title>
    <!-- Favicon -->
    <link rel="icon" href="../template/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>

    <!-- Bootstrap Core Css -->
    <link href="../template/plugins/bootstrap/dist/css/bootstrap.css" rel="stylesheet"/>

    <!-- Font Awesome Css -->
    <link href="../template/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- iCheck Css -->
    <link href="../template/plugins/iCheck/skins/square/_all.css" rel="stylesheet"/>

    <!-- Toastr Css -->
    <link href="../template/plugins/toastr/toastr.css" rel="stylesheet"/>

    <!-- Custom Css -->
    <link href="../template/css/style.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #f9bd42;
        }
    </style>
</head>
<body class="sign-up-page">
<div class="signup-form-area">
    <h1><b>YOGO</b> - Corporate Portal</h1>
    <div class="signup-top-info">Register a new membership</div>
    <div class="row padding-15">
        <div class="col-sm-2 col-md-2 col-lg-4"></div>
        <div class="col-sm-8 col-md-8 col-lg-4">
            <form id="signUpForm" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Company Name" name="companyName"
                           id="companyName" value="<?php echo $_SESSION["tempYogoComName"] ?>" readonly="readonly"
                           required/>
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Name" name="name" id="name" readonly="readonly"
                           value="<?php echo $_SESSION["tempYogoEmpName"] ?>" required/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobileNum" id="mobileNum"
                           value="<?php echo $_SESSION["tempYogoEmpTelNo"] ?>" readonly="readonly" required/>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Email" name="email" id="email"
                           readonly="readonly" value="<?php echo $_SESSION["tempYogoEmpEmail"] ?>" required/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" minlength="4" name="password"
                           id="password" required/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Confirm Password" minlength="4"
                           name="confirmPassword" id="confirmPassword" required/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <div class="checkbox icheck m-l--20">
                        <label><input type="checkbox" name="Terms" class="Terms" required> I read and agree to the <a
                                    href="https://www.yogo.lk/termsandconditions.php">terms of
                                usage</a></label>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-block btn-flat">Sign Up</button>
                </div>
            </form>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-4"></div>
    </div>
</div>
<div class="signup-right-image">
    <div class="background-layer"></div>
    <div class="copyright-info">
        This photo taken from <b>Unsplash.com</b>
        <p><b>YOGO</b>. All rights reserved.</p>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="../template/plugins/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../template/plugins/bootstrap/dist/js/bootstrap.js"></script>

<!-- iCheck Js -->
<script src="../template/plugins/iCheck/icheck.js"></script>

<!-- Jquery Validation Js -->
<script src="../template/plugins/jquery-validation/dist/jquery.validate.js"></script>

<!-- Toastr Js -->
<script src="../template/plugins/toastr/toastr.js"></script>

<!-- Custom Js -->
<!--<script src="../template/js/pages/examples/signup.js"></script>-->

<!-- Custom Js -->
<script src="../js/sign-up.js" type="module"></script>
</body>
</html>
