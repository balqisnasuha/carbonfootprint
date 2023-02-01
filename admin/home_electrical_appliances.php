<?php $title = "Home Electrical Appliances"; ?>
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
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                <div class="col-12">
                    <?php if (isset($_SESSION['message'])) : ?>
                        <?= $_SESSION['message'] ?>
                        <?php unset($_SESSION['message']) ?>
                    <?php endif ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <a href="home_electrical_appliances-add.php" class="btn btn-primary">Add New Home Electrical Appliances</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-default1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Device Name</th>
                                            <th>Device Watt</th>
                                            <th>Device Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($electric_model->get_all_device() as $d) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $d['device_name'] ?></td>
                                                <td><?= $d['device_watt'] ?></td>
                                                <td>
                                                    <?php if ($d['device_status'] == 1) : ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-danger">Inactive</span>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="home_electrical_appliances-edit.php?id=<?= $d['device_id'] ?>" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="home_electrical_appliances-delete.php?id=<?= $d['device_id'] ?>" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'layout/footer.php'; ?>