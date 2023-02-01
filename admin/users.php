<?php
$title = "Users";
include "layout/header.php";
?>

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
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php') ?>">Home</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <!-- <a href="<?= base_url('admin/users-add.php') ?>" class="btn btn-primary">Add New Users</a> -->
                                <i class="fas fa-users"></i> List of Users
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="table-default1">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>IC</th>
                                        <th>Phone</th>
                                        <th>Point</th>
                                        <th>Role</th>
                                        <th hidden>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user_model->get_all_user() as $u) : ?>
                                        <tr>
                                            <td><?= $u['user_name'] ?></td>
                                            <td><?= $u['user_email'] ?></td>
                                            <td><?= $u['user_ic_no'] ?></td>
                                            <td><?= $u['user_phone'] ?></td>
                                            <td>
                                                <?= $reward_model->get_all_user_reward_by_user_id($u['user_id']) ?>
                                            </td>
                                            <td><?= $u['user_role'] ?></td>
                                            <td hidden class="text-center">
                                                <a href="<?= base_url('admin/users-edit.php?id=' . $u['user_id']) ?>" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/users-delete.php?id=' . $u['user_id']) ?>" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php
include "layout/footer.php";
?>