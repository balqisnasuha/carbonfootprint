<?php $title = "Home Electrical Appliances"; ?>
<?php include "layout/header.php"; ?>
<?php
if (isset($_GET['id'])) {
    $device_id = $_GET['id'];
    $device = $electric_model->get_device_by_id($device_id);
    if (!$device) {
        $_SESSION['message'] = alert('Device not found', 'danger');
        redirect('admin/home_electrical_appliances.php');
    } else {
        $electric_model->delete_device($device_id);
        $_SESSION['message'] = alert('Device deleted successfully', 'success');
        redirect('admin/home_electrical_appliances.php');
    }
} else {
    $_SESSION['message'] = alert('Device not found', 'danger');
    redirect('admin/home_electrical_appliances.php');
}
