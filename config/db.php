<?php
// Start the session
session_start();

// Timezone
date_default_timezone_set('Asia/Kuala_Lumpur');

// Database connection
$localhost = "localhost";
$user = "root";
$pass = "";
$db_name = "db";

// Create connection
$conn = new mysqli($localhost, $user, $pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function base_url($url = null)
{
    $base = "http://localhost/carbonfootprint/";

    if ($url != null) {
        return $base . $url;
    } else {
        return $base;
    }
}

function redirect($url = null)
{
    echo '<script>window.location="' . base_url($url) . '"</script>';
}

function alert($msg, $status)
{
    $text = '<div class="alert alert-' . $status . ' alert-dismissible fade show" role="alert">
                <strong>' . $msg . '</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    return $text;
}

function greeting()
{
    $hour = date('H');
    if ($hour >= 0 && $hour < 12) {
        $greeting = "Good Morning";
    } else if ($hour >= 12 && $hour < 18) {
        $greeting = "Good Afternoon";
    } else if ($hour >= 18 && $hour < 24) {
        $greeting = "Good Evening";
    }
    return $greeting;
}
