<?php
$title = "Reward";
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
                    <?php if (isset($_SESSION['message'])) : ?>
                        <?= $_SESSION['message'] ?>
                        <?php unset($_SESSION['message']) ?>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <a href="<?= base_url('admin/reward-add.php') ?>" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Add Reward
                                </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="table-default1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Reward Name</th>
                                        <th>Reward Point</th>
                                        <th>Reward Start Date</th>
                                        <th>Reward End Date</th>
                                        <th>Reward Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($reward_model->get_all_reward() as $reward) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $reward['reward_name'] ?></td>
                                            <td><?= $reward['reward_point'] ?></td>
                                            <td><?= $reward['reward_start_date'] ?></td>
                                            <td><?= $reward['reward_end_date'] ?></td>
                                            <td>
                                                <?php if ($reward['reward_status'] == 1) : ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php else : ?>
                                                    <span class="badge badge-danger">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('admin/reward-edit.php?id=' . $reward['reward_id']) ?>" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/reward-delete.php?id=' . $reward['reward_id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                List Reward Redeem
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="table-default2">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Reward Name</th>
                                        <th>Reward Point</th>
                                        <th>Reward Status</th>
                                        <th>Redeem Created</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($reward_model->get_all_redeem() as $reward) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $reward['reward_name'] ?></td>
                                            <td><?= $reward['reward_point'] ?></td>
                                            <td>
                                                <?php if ($reward['redeem_status'] == 1) : ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php else : ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d F Y h:i a', strtotime($reward['redeem_created_at'])) ?></td>
                                            <td class="text-center">
                                                <?php if ($reward['redeem_status'] == 0) : ?>
                                                    <a href="<?= base_url('admin/redeem-edit.php?id=' . $reward['reward_id']) ?>" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                <?php else : ?>
                                                    <span class="badge badge-success">Redeem Success</span>
                                                <?php endif; ?>
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