<?php $title = "Dashboard"; ?>
<?php include "layout/header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>&nbsp;</h3>
                            <div class="icon d-block d-sm-none justify-content-center align-items-center">
                                <i class="fa-solid fa-plug"></i>
                            </div>
                            <p>HOME ELECTRICAL APPLIANCE</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-plug"></i>
                        </div>
                        <a href="home_electrical_appliances.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>&nbsp;</h3>
                            <div class="icon d-block d-sm-none justify-content-center align-items-center">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <p>MONTHLY ANALYSIS</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <a href="monthly_analysis.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>&nbsp;</h3>
                            <div class="icon d-block d-sm-none justify-content-center align-items-center">
                                <i class="fa-solid fa-gift"></i>
                            </div>
                            <p>Reward</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <a href="<?= base_url('admin/reward.php') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'layout/footer.php'; ?>