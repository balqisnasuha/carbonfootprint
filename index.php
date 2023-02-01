<?php
$title = "Dashboard";
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
                <!-- Point reward -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $reward_model->get_all_user_reward_by_user_id($_SESSION['user']) ?></h3>
                            <p>Point Reward</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Point Reward
                            </h3>
                        </div>
                        <div class="card-body">
                            <p>
                                To get point reward, you need to save your electricity usage data.
                            </p>
                            <p>
                                You can save your electricity usage data by clicking the button below.
                            </p>
                            <a href="<?= base_url('home_electrical_appliances.php') ?>" class="btn btn-primary">Save Electricity Usage</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- list reward that can be redeem -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                List Reward
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Reward Name</th>
                                        <th>Point</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($reward_model->get_all_reward() as $row) : ?>
                                        <?php if ($row['reward_status'] == '1' && strtotime(date('Y-m-d H:i:s')) >= strtotime($row['reward_start_date']) && strtotime(date('Y-m-d H:i:s')) <= strtotime($row['reward_end_date'])) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['reward_name'] ?></td>
                                                <td><?= $row['reward_point'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('redeem.php?id=' . $row['reward_id']) ?>" class="btn btn-primary">Redeem</a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
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
                                History Reward has been redeemed
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="table-default2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Reward Name</th>
                                        <th>Point</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <th>Date Redeem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($reward_model->list_user_reward_by_user_id($_SESSION['user']) as $row) : ?>
                                        <?php if ($row['reward_status'] != '3') : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['reward_name'] ?></td>
                                                <td><?= $row['reward_point'] ?></td>
                                                <td><?= $row['redeem_comment'] ?></td>
                                                <td>
                                                    <?php if ($row['redeem_status'] == '0') : ?>
                                                        <span class="badge badge-warning">Pending</span>
                                                    <?php elseif ($row['redeem_status'] == '1') : ?>
                                                        <span class="badge badge-success">Success</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= date("d F Y h:i a", strtotime($row['redeem_created_at'])) ?></td>
                                            </tr>
                                        <?php endif; ?>
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