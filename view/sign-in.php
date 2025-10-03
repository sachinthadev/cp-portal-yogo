<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign In | YOGO - Corporate Portal</title>
    <!-- Favicon -->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

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
<body class="sign-in-page">
<div class="signin-form-area">
    <h1><b>YOGO</b> - Corporate Portal</h1>
    <div class="signin-top-info">Sign in to start your session</div>
    <div class="row padding-15">
        <div class="col-sm-2 col-md-2 col-lg-4"></div>
        <div class="col-sm-8 col-md-8 col-lg-4">
            <form id="signInForm" method="post">
                <div class="form-group has-feedback">
                                <input type="email" class="form-control" placeholder="Phone Number or Email" name="email" id="email" required/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="passwordTxt" id="passwordTxt" required/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="forgot-password">
                <a href="forgot-password.php">Forgot Password?</a>
            </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" id="submitBtn" class="btn btn-block btn-success">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-4"></div>
    </div>
</div>
<div class="signin-right-image">
    <div class="background-layer">
    </div>
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
<script src="../js/sign-in.js" type="module"></script>
</body>
</html>

