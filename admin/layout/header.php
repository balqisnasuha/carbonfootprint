<?php
include '../config/db.php';
if (!isset($_SESSION['admin'])) {
    redirect('login.php');
}

include '../model/user_model.php';
include '../model/electric_model.php';
include '../model/reward_model.php';
$user_model = new User_model();
$user = $user_model->get_user_by_id($_SESSION['admin']);
$electric_model = new Electric_model();
$reward_model = new Reward_model();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | <?= $title ?></title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome v6.21 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <!-- <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../assets/dist/img/logo.jpg" alt="SerraHouse Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SERRA HOUSE</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../assets/dist/img/amin.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- dashbaord -->
                        <li class="nav-item">
                            <a href="index.php" class="nav-link <?php if ($title == 'Dashboard') : ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-grip"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="users.php" class="nav-link <?php if ($title == 'Users') : ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="home_electrical_appliances.php" class="nav-link <?php if ($title == 'Home Electrical Appliances') : ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-tv"></i>
                                <p style="font-size: 14px;">
                                    Home Electrical Appliances
                                </p>
                            </a>
                        </li>
                        <!-- reward -->
                        <li class="nav-item">
                            <a href="reward.php" class="nav-link <?php if ($title == 'Reward') : ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-gift"></i>
                                <p>
                                    Reward
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="monthly_analysis.php" class="nav-link <?php if ($title == 'Monthly Analysis') : ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Monthly Analysis
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>