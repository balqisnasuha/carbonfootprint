<?php require_once 'config/db.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = [];
    if (empty($email)) {
        $error['email'] = 'Email is required';
    }
    if (empty($password)) {
        $error['password'] = 'Password is required';
    }
    if (empty($error)) {
        $sql = "SELECT * FROM users WHERE user_email = '$email' AND user_status != 3";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['user_password'])) {

                if ($row['user_status'] == 1) {

                    // store cookie
                    if (isset($_POST['remember'])) {
                        setcookie('email', $email, time() + 60 * 60 * 24 * 30);
                        setcookie('password', $password, time() + 60 * 60 * 24 * 30);
                    } else {
                        setcookie('email', $email, time() - 60 * 60 * 24 * 30);
                        setcookie('password', $password, time() - 60 * 60 * 24 * 30);
                    }

                    if ($row['user_role'] == 'admin') {
                        $_SESSION['admin'] = $row['user_id'];
                        redirect('admin/index.php');
                    } else if ($row['user_role'] == 'user') {
                        $_SESSION['user'] = $row['user_id'];
                        redirect('index.php');
                    }
                } else if ($row['user_status'] == 2) {
                    $error['email'] = 'Your account is blocked, please contact the administrator';
                } else if ($row['user_status'] == 0) {
                    $error['email'] = 'Your account is not activated, please check your email';
                }
            } else {
                $error['password'] = 'Password is incorrect';
            }
        } else {
            $error['email'] = 'Email is not registered';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/dist/img/favicon/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/dist/img/favicon/favicon.ico') ?>" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
</head>

<style>
    .login-page {
        background-image: url('<?= base_url('assets/dist/img/photo/recycle.jpg') ?>');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="<?= base_url('index.php') ?>" class="h1"><b>  SERRA HOUSE</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="" method="post" id="form_login">
                    <?php if (isset($_SESSION['message'])) : ?>
                        <?= $_SESSION['message'] ?>
                        <?php unset($_SESSION['message']) ?>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="<?php if (isset($_POST['email'])) : ?><?= $_POST['email'] ?><?php elseif (isset($_COOKIE['email'])) : ?><?= $_COOKIE['email'] ?><?php endif; ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger font-weight-bold" id="error_email"><?= isset($error['email']) ? $error['email'] : '' ?></span>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php if (isset($_COOKIE['password'])) : ?><?= $_COOKIE['password'] ?><?php endif; ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger font-weight-bold" id="error_password"><?= isset($error['password']) ? $error['password'] : '' ?></span>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" <?php if (isset($_COOKIE['email'])) : ?>checked<?php endif; ?>>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary btn-block" onclick="sign_in()">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- forgot password | register -->
                <p class="mb-1">
                    <a href="forgot-password.php">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.php" class="text-center">Register a new user</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>


    <script>
        function sign_in() {
            var email = $('#email').val();
            var password = $('#password').val();
            if (email == '') {
                $('#error_email').html('Email is required');
            } else {
                $('#error_email').html('');
            }
            if (password == '') {
                $('#error_password').html('Password is required');
            } else {
                $('#error_password').html('');
            }
            if (email != '' && password != '') {
                $('#form_login').submit();
            }
        }
    </script>
</body>

</html>