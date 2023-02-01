<?php require_once 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ic_no = $_POST['ic_no'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $error = [];

    if (empty($name)) {
        $error['name'] = 'Name is required';
    }

    if (empty($email)) {
        $error['email'] = 'Email is required';
    }

    if (empty($ic_no)) {
        $error['ic_no'] = 'IC No is required';
    } else if (!preg_match('/^[0-9]*$/', $ic_no)) {
        $error['ic_no'] = 'IC No must be numeric';
    } else if (strlen($ic_no) != 12) {
        $error['ic_no'] = 'IC No must be 12 characters';
    }

    if (empty($phone)) {
        $error['phone'] = 'Phone is required';
    }

    if (empty($password)) {
        $error['password'] = 'Password is required';
    }

    if (empty($confirm_password)) {
        $error['confirm_password'] = 'Confirm Password is required';
    }

    if ($password != $confirm_password) {
        $error['confirm_password'] = 'Password and Confirm Password not match';
    }
    if (!isset($_POST['terms'])) {
        $error['terms'] = 'Please agree to our terms';
    }

    if (count($error) == 0) {

        $sql_email = "SELECT * FROM users WHERE user_email = '$email'";
        $result_email = mysqli_query($conn, $sql_email);
        if (mysqli_num_rows($result_email) > 0) {
            $_SESSION['message'] = alert('Email already exists', 'danger');
            // redirect('register.php');
        } else {

            $sql_ic = "SELECT * FROM users WHERE user_ic_no = '$ic_no'";
            $result_ic = mysqli_query($conn, $sql_ic);
            if (mysqli_num_rows($result_ic) > 0) {
                $_SESSION['message'] = alert('IC No already exists', 'danger');
                // redirect('register.php');
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                // $sql = "INSERT INTO users (user_name, user_email, user_phone, user_password) VALUES ('$name', '$email', '$phone', '$password')";
                $sql = "INSERT INTO users (user_name, user_email, user_ic_no, user_phone, user_password) VALUES ('$name', '$email', '$ic_no', '$phone', '$password')";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['message'] = alert('Registration successful', 'success');
                    redirect('login.php');
                } else {
                    $_SESSION['message'] = alert('Registration failed', 'danger');
                    redirect('register.php');
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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
    .register-page {
        background-image: url('<?= base_url('assets/dist/img/photo/recycle.jpg') ?>');
        background-repeat: no-repeat;
        background-size: cover;
    }

    /* desktop */
    @media (min-width: 992px) {
        .register-box {
            width: 50%;
            margin: 0 auto;
        }
    }
</style>

<body class="hold-transition register-page">
    <div class="register-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-body">
                <p class="login-box-msg">Register a new user</p>
                <form action="" method="post" id="form_register">
                    <?php if (isset($_SESSION['message'])) : ?>
                        <?= $_SESSION['message'] ?>
                        <?php unset($_SESSION['message']) ?>
                    <?php endif; ?>
                    <!-- name -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger font-weight-bold" id="error_name"><?= isset($error['name']) ? $error['name'] : '' ?></span>
                    <!-- email -->
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger font-weight-bold" id="error_email"><?= isset($error['email']) ? $error['email'] : '' ?></span>

                    <!-- ic no -->
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="IC No" name="ic_no" id="ic_no" value="<?= isset($_POST['ic_no']) ? $_POST['ic_no'] : '' ?>" onkeypress="return isNumberKey(event)" maxlength="12" minlength="12">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger font-weight-bold" id="error_ic_no"><?= isset($error['ic_no']) ? $error['ic_no'] : '' ?></span>

                    <!-- phone -->
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="Phone" name="phone" id="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" onkeypress="return isNumberKey(event)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger font-weight-bold" id="error_phone"><?= isset($error['phone']) ? $error['phone'] : '' ?></span>
                    <!-- password -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger font-weight-bold" id="error_password"><?= isset($error['password']) ? $error['password'] : '' ?></span>
                    <!-- confirm password -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                            <span class="text-danger font-weight-bold" id="error_terms"><?= isset($error['terms']) ? $error['terms'] : '' ?></span>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary btn-block" onclick="sign_up()">Sign Up</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links  mt-2 mb-3">
                    <a href="<?= base_url('login.php') ?>">
                        Already have an account? Login
                    </a>
                </div>
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
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $('#name').on('keyup', function() {
            $('#error_name').html('');
        });
        $('#email').on('keyup', function() {
            $('#error_email').html('');
        });
        $('#phone').on('keyup', function() {
            $('#error_phone').html('');
        });
        $('#password').on('keyup', function() {
            $('#error_password').html('');
        });
        $('#confirm_password').on('keyup', function() {
            $('#error_confirm_password').html('');
        });
        $('#agreeTerms').on('click', function() {
            $('#error_terms').html('');
        });

        function sign_up() {
            var name = $('#name').val();
            var email = $('#email').val();
            email = email.toLowerCase();
            var ic_no = $('#ic_no').val();
            var phone = $('#phone').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            var agreeTerms = $('#agreeTerms').val();

            if (name == '') {
                $('#error_name').html('Name is required');
                $('#name').focus();
                return false;
            } else {
                $('#error_name').html('');
            }

            if (email == '') {
                $('#error_email').html('Email is required');
                $('#email').focus();
                return false;
            } else {
                $('#error_email').html('');
            }

            if (ic_no == '') {
                $('#error_ic_no').html('IC No is required');
                $('#ic_no').focus();
                return false;
            } else {
                $('#error_ic_no').html('');

                // ic no 12 digit
                if (ic_no.length != 12) {
                    $('#error_ic_no').html('IC No must be 12 digit');
                    $('#ic_no').focus();
                    return false;
                } else {
                    $('#error_ic_no').html('');
                }

            }

            if (phone == '') {
                $('#error_phone').html('Phone is required');
                $('#phone').focus();
                return false;
            } else {
                $('#error_phone').html('');
            }

            if (password == '') {
                $('#error_password').html('Password is required');
                $('#password').focus();
                return false;
            } else {
                $('#error_password').html('');
            }

            if (confirm_password == '') {
                $('#error_confirm_password').html('Confirm Password is required');
                $('#confirm_password').focus();
                return false;
            } else {
                $('#error_confirm_password').html('');
            }

            if (password != confirm_password) {
                $('#error_confirm_password').html('Password and Confirm Password not match');
                $('#confirm_password').focus();
                return false;
            } else {
                $('#error_confirm_password').html('');
            }

            if (agreeTerms == '') {
                $('#error_terms').html('Please agree to our terms');
                $('#agreeTerms').focus();
                return false;
            } else {
                $('#error_terms').html('');
            }

            $('#form_register').submit();
        }
    </script>
</body>

</html>