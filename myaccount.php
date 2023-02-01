<?php
$title = "My Account";
include "layout/header.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['user_name'];
    $ic = $_POST['user_ic'];
    $email = $_POST['user_email'];
    $phone = $_POST['user_phone'];
    $password_old = $_POST['user_password_old'];
    $password_new = $_POST['user_password_new'];
    $password_confirm = $_POST['user_password_confirm'];

    $errors = [];

    if (empty($name)) {
        $errors['user_name'] = 'Name is required';
    }

    if (empty($ic)) {
        $errors['user_ic'] = 'IC is required';
    } else {
        $user_ic = $user_model->get_user_by_user_ic_no($ic);
        if ($user_ic) {
            if ($user_ic['user_id'] != $_SESSION['user']) {
                $errors['user_ic'] = 'IC already exists';
            }
        }
    }

    if (empty($email)) {
        $errors['user_email'] = 'Email is required';
    } else {
        $user_email = $user_model->get_user_by_email($email);
        if ($user_email) {
            if ($user_email['user_id'] != $_SESSION['user']) {
                $errors['user_email'] = 'Email already exists';
            }
        }
    }

    if (empty($phone)) {
        $errors['user_phone'] = 'Phone is required';
    }

    if (!empty($password_old)) {
        if (empty($password_new)) {
            $errors['user_password_new'] = 'New password is required';
        } else {
            if (!password_verify($password_old, $user['user_password'])) {
                $errors['user_password_old'] = 'Password does not match with old password';
            }
        }

        if (empty($password_confirm)) {
            $errors['user_password_confirm'] = 'Confirm password is required';
        }

        if ($password_new != $password_confirm) {
            $errors['user_password_confirm'] = 'Password does not match';
        }
    }

    if (empty($errors)) {

        if (empty($errors)) {
            $dataUser = array();

            $dataUser['user_name'] = $name;
            $dataUser['user_ic_no'] = $ic;
            $dataUser['user_email'] = $email;
            $dataUser['user_phone'] = $phone;

            if (!empty($password_new)) {
                $dataUser['user_password'] = password_hash($password_new, PASSWORD_DEFAULT);
            }

            $user_model->update_user_by_user_id($_SESSION['user'], $dataUser);
            $_SESSION['message'] = alert('Profile updated successfully', 'success');
            redirect('myaccount.php');
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
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                My Account
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="user_name">Name</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?= $user['user_name'] ?>">
                                    <span class="text-danger font-weight-bold"><?= isset($errors['user_name']) ? $errors['user_name'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="user_ic">IC</label>
                                    <input type="text" class="form-control" id="user_ic" name="user_ic" value="<?= $user['user_ic_no'] ?>" placeholder="IC" onkeypress="return isNumberKey(event)">
                                    <span class="text-danger font-weight-bold"><?= isset($errors['user_ic']) ? $errors['user_ic'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email</label>
                                    <input type="email" class="form-control" id="user_email" name="user_email" value="<?= $user['user_email'] ?>">
                                    <span class="text-danger font-weight-bold"><?= isset($errors['user_email']) ? $errors['user_email'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="user_phone">Phone</label>
                                    <input type="number" class="form-control" id="user_phone" name="user_phone" value="<?= $user['user_phone'] ?>" placeholder="Phone" onkeypress="return isNumberKey(event)">
                                    <span class="text-danger font-weight-bold"><?= isset($errors['user_phone']) ? $errors['user_phone'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="user_password_old">Old Password</label>
                                    <input type="password" class="form-control" id="user_password_old" name="user_password_old" placeholder="Leave blank if you don't want to change password" value="">
                                    <span class="text-danger font-weight-bold"><?= isset($errors['user_password_old']) ? $errors['user_password_old'] : '' ?></span>
                                </div>
                                <!-- new password -->
                                <div class="form-group">
                                    <label for="user_password_new">New Password</label>
                                    <input type="password" class="form-control" id="user_password_new" name="user_password_new" placeholder="Leave blank if you don't want to change password" value="">
                                    <span class="text-danger font-weight-bold"><?= isset($errors['user_password_new']) ? $errors['user_password_new'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="user_password_confirm">Confirm Password</label>
                                    <input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm" placeholder="Leave blank if you don't want to change password" value="">
                                    <span class="text-danger font-weight-bold"><?= isset($errors['user_password_confirm']) ? $errors['user_password_confirm'] : '' ?></span>
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
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<?php unset($_SESSION['message']) ?>