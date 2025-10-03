<?php
include_once('../util/session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>YOGO | Corporate Portal</title>
    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../template/plugins/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />

    <!-- Animate.css Css -->
    <link href="../template/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Font Awesome Css -->
    <link href="../template/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

    <!-- iCheck Css -->
    <link href="../template/plugins/iCheck/skins/flat/_all.css" rel="stylesheet" />

    <!-- Switchery Css -->
    <link href="../template/plugins/switchery/dist/switchery.css" rel="stylesheet" />

    <!-- Metis Menu Css -->
    <link href="../template/plugins/metisMenu/dist/metisMenu.css" rel="stylesheet" />

    <!-- Jquery Datatables Css -->
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" rel="stylesheet" />


    <!-- Bootstrap DateRangePicker Css -->
    <link href="../template/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />

    <!-- DateTimePicker Css -->
    <link href="../template/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet" />


    <!-- Pace Loader Css -->
    <link href="../template/plugins/pace/themes/white/pace-theme-flash.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../template/plugins/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Toastr Css -->
    <link href="../template/plugins/toastr/toastr.css" rel="stylesheet" />

    <!-- WaitMe Css -->
    <link href="../template/plugins/wait-me/src/waitMe.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../template/css/style.css" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../template/css/themes/allthemes.css" rel="stylesheet" />

    <!-- Jquery Datatables Css -->
    <link href="../template/plugins/DataTables/media/css/dataTables.bootstrap.css" rel="stylesheet" />

    <!-- Demo Purpose Only -->
    <link href="../template/css/demo/setting-box.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../style/custom.css" rel="stylesheet" />
</head>

<body class="footer-fixed theme-warning">
    <div class="all-content-wrapper">
        <!-- Top Bar -->
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="material-icons">swap_vert</i>
                        </button>
                        <a href="javascript:void(0);" class="left-toggle-left-sidebar js-left-toggle-left-sidebar">
                            <i class="material-icons">menu</i>
                        </a>
                        <!-- Logo -->
                        <a class="navbar-brand" href="dashboard.php">
                            <span class="logo-minimized">CP</span>
                            <span class="logo">YOGO - Corporate Portal</span>
                        </a>
                        <!-- #END# Logo -->
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="javascript:void(0);" class="toggle-left-sidebar js-toggle-left-sidebar">
                                    <i class="material-icons">menu</i>
                                </a>
                            </li>
        
                            <div class="navbar-brand" id="creditLimit1">
                                    <p style="color: red; font-weight:bold; font-size:large" id="creditLimit" name="creditLimit"></p>
                                </div>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <!-- User Menu -->
                            <div class="navbar-brand" id="creditBalance1">
                                    <p style="font-weight:bold; font-size:medium" id="creditBalance" name="creditBalance"></p>
                            </div>
                            <li class="dropdown user-menu">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../template/images/avatar.png" alt="User Avatar" />
                                    <span class="hidden-xs">
                                       <?php
              echo $_SESSION["employee_name"]
            ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">
                                        <img src="../template/images/avatar.png" alt="User Avatar" />
                                        <div class="user">
                                            <?php
              echo $_SESSION["employee_name"]
            ?>
                                        </div>
                                    </li>
                                    <li class="body">
                                        <ul>
                                            <li>
                                                <a href="profile.php">
                                                    <i class="material-icons">account_circle</i> Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="password-reset.php">
                                                    <i class="material-icons">lock_open</i> Change Password
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <div class="row clearfix">
                                            <div class="col-xs-5">
                                                <a href="log-out.php" class="btn btn-default btn-sm btn-block">Log Out</a>
                                            </div>
                                            <div class="col-xs-5"></div>
                                            <div class="col-xs-2"></div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- #END# User Menu -->
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- #END# Top Bar -->
        <!-- Left Menu -->
    </div>
    <?php
    include_once('sidebar.php');
    ?>
    <script src="../js/header.js" type="module"></script>
</body>

<!-- #END# Left Menu -->