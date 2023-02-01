<?php
$title = "Reward";
include "layout/header.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reward_name = $_POST['reward_name'];
    $reward_point = $_POST['reward_point'];
    $reward_start_date = $_POST['reward_start_date'];
    $reward_end_date = $_POST['reward_end_date'];
    $reward_status = $_POST['reward_status'];

    $errors = [];

    if (empty($reward_name)) {
        $errors['reward_name'] = "Reward Name is required";
    }

    if (empty($reward_point)) {
        $errors['reward_point'] = "Reward Point is required";
    }

    if (empty($reward_start_date)) {
        $errors['reward_start_date'] = "Reward Start Date is required";
    }

    if (empty($reward_end_date)) {
        $errors['reward_end_date'] = "Reward End Date is required";
    }

    if (empty($reward_status)) {
        $errors['reward_status'] = "Reward Status is required";
    }

    if (count($errors) == 0) {
        $dataReward = array(
            'reward_name' => $reward_name,
            'reward_point' => $reward_point,
            'reward_start_date' => $reward_start_date,
            'reward_end_date' => $reward_end_date,
            'reward_status' => $reward_status
        );
        $reward_model->insert_reward($dataReward);
        $_SESSION['message'] = alert('Reward Added Successfully', 'success');
        redirect('admin/reward.php');
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
                                    <div class="form-group col">
                                        <label for="reward_name">Reward Name</label>
                                        <input type="text" name="reward_name" id="reward_name" class="form-control" placeholder="Reward Name" value="<?= isset($_POST['reward_name']) ? $_POST['reward_name'] : '' ?>">
                                        <span class="text-danger font-weight-bold" id="reward_name_error"><?= isset($errors['reward_name']) ? $errors['reward_name'] : '' ?></span>
                                    </div>
                                    <div class="form-group col">
                                        <label for="reward_point">Reward Point</label>
                                        <input type="number" name="reward_point" id="reward_point" class="form-control" placeholder="Reward Point" value="<?= isset($_POST['reward_point']) ? $_POST['reward_point'] : '' ?>">
                                        <span class="text-danger font-weight-bold" id="reward_point_error"><?= isset($errors['reward_point']) ? $errors['reward_point'] : '' ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="reward_start_date">Reward Start Date</label>
                                        <input type="datetime-local" name="reward_start_date" id="reward_start_date" class="form-control" placeholder="Reward Start Date" value="<?= isset($_POST['reward_start_date']) ? $_POST['reward_start_date'] : '' ?>">
                                        <span class="text-danger font-weight-bold" id="reward_start_date_error"><?= isset($errors['reward_start_date']) ? $errors['reward_start_date'] : '' ?></span>
                                    </div>
                                    <div class="form-group col">
                                        <label for="reward_end_date">Reward End Date</label>
                                        <input type="datetime-local" name="reward_end_date" id="reward_end_date" class="form-control" placeholder="Reward End Date" value="<?= isset($_POST['reward_end_date']) ? $_POST['reward_end_date'] : '' ?>">
                                        <span class="text-danger font-weight-bold" id="reward_end_date_error"><?= isset($errors['reward_end_date']) ? $errors['reward_end_date'] : '' ?></span>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col">
                                    <label for="reward_status">Reward Status</label>
                                    <select name="reward_status" id="reward_status" class="form-control">
                                        <option value="1" <?= isset($_POST['reward_status']) && $_POST['reward_status'] == 1 ? 'selected' : '' ?>>Active</option>
                                        <option value="2" <?= isset($_POST['reward_status']) && $_POST['reward_status'] == 2 ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <span class="text-danger font-weight-bold" id="reward_status_error"><?= isset($errors['reward_status']) ? $errors['reward_status'] : '' ?></span>
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

<?php
include "layout/footer.php";
?>