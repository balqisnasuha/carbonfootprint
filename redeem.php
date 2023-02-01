<?php
$title = "Dashboard";
include "layout/header.php";

if (isset($_GET['id'])) {
    $reward = $reward_model->get_reward_by_id($_GET['id']);
    if ($reward != false) {
        $reward = $reward_model->get_reward_by_id($_GET['id']);
    } else {
        redirect('index.php');
    }
} else {
    redirect('index.php');
}
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
                                <i class="fas fa-gift"></i> Redeem Reward
                            </h4>
                        </div>
                        <div class="card-body">
                            <p> You have <?= $reward_model->get_all_user_reward_by_user_id($_SESSION['user']) ?> point reward. </p>
                            <p>
                                You want to redeem (<?= $reward['reward_name'] ?>) it will cost <?= $reward['reward_point'] ?> point reward.
                            </p>
                            <?php if ($reward_model->get_all_user_reward_by_user_id($_SESSION['user']) >= $reward['reward_point']) : ?>
                                <a href="<?= base_url('redeem_process.php?id=' . $reward['reward_id']) ?>" class="btn btn-primary">Redeem</a>
                            <?php else : ?>
                                <p> You don't have enough point reward. </p>
                            <?php endif; ?>
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