<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>440 | YOGO - Corporate Portal</title>
    <!-- Favicon -->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Bootstrap Core Css -->
    <link href="../template/plugins/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />

    <!-- Font Awesome Css -->
    <link href="../template/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../template/css/style.css" rel="stylesheet" />
</head>
<body>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="error-box">
                <h1>440</h1>
                <h3>Session has been expired</h3>
                <div class="info">
                    Login again from <a href="../index.php">here</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="../template/plugins/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../template/plugins/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
