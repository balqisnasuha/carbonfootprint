<?php
include 'config/db.php';
if (!isset($_SESSION['user'])) {
    redirect('login.php');
}

include 'model/user_model.php';
include 'model/electric_model.php';
include 'model/reward_model.php';
$user_model = new User_model();
$electric_model = new Electric_model();
$user = $user_model->get_user_by_id($_SESSION['user']);
$reward_model = new Reward_model();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/dist/img/favicon/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/dist/img/favicon/favicon.ico') ?>" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <!-- <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/summernote/summernote-bs4.min.css') ?>">
    <!-- Datatable -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css') ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">
    <!-- owl  -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/owlcarousel/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/owlcarousel/css/owl.theme.default.min.css') ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('assets/dist/img/logo/logo.jpg') ?>" alt="logo" height="300" width="300">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('index.php') ?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link text-dark"><?= greeting() ?>, <?= $user['user_name'] ?></a>
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
            <a href="<?= base_url('index.php') ?>" class="brand-link">
                <img src="<?= base_url('assets/dist/img/logo/logo.jpg') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SERRA HOUSE</span>
            </a>
            <!-- Sidebar -->
            <?php include "layout/sidebar.php" ?>
            <!-- /.sidebar -->
        </aside>