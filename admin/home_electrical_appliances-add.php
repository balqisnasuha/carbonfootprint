<?php $title = "Home Electrical Appliances"; ?>
<?php include "layout/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $device_name = $_POST['device_name'];
    $device_watt = $_POST['device_watt'];
    $device_status = $_POST['device_status'];

    $errors = array();

    if (empty($device_name)) {
        $errors['device_name'] = "Device Name is required";
    }
    if (empty($device_watt)) {
        $errors['device_watt'] = "Device Watt is required";
    }
    if (empty($device_status)) {
        $errors['device_status'] = "Device Status is required";
    }

    if (count($errors) == 0) {
        $dataDevice = array(
            'device_name' => $device_name,
            'device_watt' => $device_watt,
            'device_status' => $device_status
        );
        $electric_model->add_device($dataDevice);
        $_SESSION['message'] = alert('Device added successfully', 'success');
        redirect('admin/home_electrical_appliances.php');
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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fas fa-tv mr-1"></i> <?= $title ?>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="device_name">Device Name</label>
                                            <input type="text" name="device_name" id="device_name" class="form-control" placeholder="Device Name" value="<?= isset($_POST['device_name']) ? $_POST['device_name'] : '' ?>">
                                            <span class="text-danger font-weight-bold"><?= isset($errors['device_name']) ? $errors['device_name'] : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="device_watt">Device Watt</label>
                                            <input type="number" name="device_watt" id="device_watt" class="form-control" placeholder="Device Watt" value="<?= isset($_POST['device_watt']) ? $_POST['device_watt'] : '' ?>" step="0.01">
                                            <span class="text-danger font-weight-bold"><?= isset($errors['device_watt']) ? $errors['device_watt'] : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="device_status">Device Status</label>
                                            <select name="device_status" id="device_status" class="form-control">
                                                <option value="1" <?= isset($_POST['device_status']) && $_POST['device_status'] == 1 ? 'selected' : '' ?>>Active</option>
                                                <option value="2" <?= isset($_POST['device_status']) && $_POST['device_status'] == 2 ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                            <span class="text-danger font-weight-bold"><?= isset($errors['device_status']) ? $errors['device_status'] : '' ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>