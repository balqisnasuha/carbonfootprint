<?php
$title = "Reward";
include "layout/header.php";
if (isset($_GET['id'])) {
    $redeem_id = $_GET['id'];
    $redeem = $reward_model->get_reward_redeem_by_id($redeem_id);
    if ($redeem != false) {
    } else {
        $_SESSION['message'] = alert('Redeem not found.', 'danger');
        redirect('admin/reward.php');
    }
} else {
    $_SESSION['message'] = alert('Redeem not found.', 'danger');
    redirect('admin/reward.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $redeem_status = $_POST['redeem_status'];
    $redeem_comment = $_POST['redeem_comment'];

    $errors = [];

    if (empty($redeem_status)) {
        $errors['redeem_status'] = 'Status is required.';
    }

    if (empty($redeem_comment)) {
        $errors['redeem_comment'] = 'Comment is required.';
    }

    if (count($errors) == 0) {
        $dataRedeem = array(
            'redeem_status' => $redeem_status,
            'redeem_comment' => $redeem_comment
        );
        $result = $reward_model->update_redeem($redeem_id, $dataRedeem);

        if ($result) {
            $_SESSION['message'] = alert('Redeem updated successfully.', 'success');
            redirect('admin/reward.php');
        } else {
            $_SESSION['message'] = alert('Redeem updated failed.', 'danger');
            redirect('admin/reward.php');
        }
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?> Add</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php') ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?> Add</li>
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
                                <i class="fas fa-gift"></i> Reward
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="reward_name">Reward Name</label>
                                        <input type="text" name="reward_name" id="reward_name" class="form-control" placeholder="Reward Name" value="<?= $redeem['reward_name'] ?>" readonly>
                                        <span class="text-danger"><?= $errors['reward_name'] ?? '' ?></span>
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="reward_point">Reward Point</label>
                                        <input type="number" name="reward_point" id="reward_point" class="form-control" placeholder="Reward Point" value="<?= $redeem['reward_point'] ?>" readonly>
                                        <span class="text-danger"><?= $errors['reward_point'] ?? '' ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4 col-12">
                                        <label for="user_name">User Name</label>
                                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="User Name" value="<?= $redeem['user_name'] ?>" readonly>
                                        <span class="text-danger"><?= $errors['user_name'] ?? '' ?></span>
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <!-- phone -->
                                        <label for="user_phone">User Phone</label>
                                        <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="User Phone" value="<?= $redeem['user_phone'] ?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <!-- phone -->
                                        <label for="user_email">User Email</label>
                                        <input type="text" name="user_email" id="user_email" class="form-control" placeholder="User Email" value="<?= $redeem['user_email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="redeem_status">Status</label>
                                        <select name="redeem_status" id="redeem_status" name="redeem_status" class="form-control">
                                            <option value="0" <?= $redeem['redeem_status'] == 0 ? 'selected' : '' ?>>Pending</option>
                                            <option value="1" <?= $redeem['redeem_status'] == 1 ? 'selected' : '' ?>>Approved</option>
                                            <option value="2" <?= $redeem['redeem_status'] == 2 ? 'selected' : '' ?>>Rejected</option>
                                        </select>
                                        <span class="text-danger"><?= $errors['redeem_status'] ?? '' ?></span>
                                    </div>
                                    <!-- comment -->
                                    <div class="form-group col-lg-9 col-12">
                                        <label for="redeem_comment">Comment</label>
                                        <textarea name="redeem_comment" id="redeem_comment" class="form-control" rows="3" placeholder="Enter ..."><?= $redeem['redeem_comment'] ?></textarea>
                                        <span class="text-danger"><?= $errors['redeem_comment'] ?? '' ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include "layout/footer.php"; ?>