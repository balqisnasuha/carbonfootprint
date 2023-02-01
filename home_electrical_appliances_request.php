<?php
include 'config/db.php';
if (!isset($_SESSION['user'])) {
    redirect('login.php');
}

include 'model/user_model.php';
include 'model/electric_model.php';
include 'model/reward_model.php';
$user_model = new User_model();
$electric_model = new Electric_model();
$reward_model = new Reward_model();
$user = $user_model->get_user_by_id($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'calculate_power_uses') {

        $device_id = $_POST['id'];
        $duration = $_POST['duration'];
        $w = 0;
        // power / 1000 x hours
        foreach ($device_id as $key => $d) {
            $device =  $electric_model->get_device_by_id($d);
            $power = $device['device_watt'];
            $w += $power / 1000 * $duration[$key];
        }
        $dataWatt = array(
            'status' => 'success',
            'watt' => number_format($w, 2)
        );
        echo json_encode($dataWatt);
    } else if ($_POST['action'] == 'calculate_carbon_emission') {
        $device_id = $_POST['id'];
        $duration = $_POST['duration'];
        $w = 0;
        
        // power / 1000 x 0.622 x hours
        foreach ($device_id as $key => $d) {
            $device =  $electric_model->get_device_by_id($d);
            $power = $device['device_watt'];
           $w += $power / 1000 * $duration[$key];
           $watt = $w / 1000 * 0.622 * $duration[$key];
            $dataElectric = array(
                'usage_user_id' => $_SESSION['user'],
                'usage_device_id' => $d,
                'usage_duration' => $duration[$key],
                'usage_date' => date('Y-m-d'),
                'usage_power' => $power,
                'usage_watt' => $watt,
            );
            $usage = $electric_model->get_usage_by_user_id_and_device_id_and_date($_SESSION['user'], $d, date('Y-m-d'));
            if ($usage) {
                $dataElectric['usage_id'] = $usage['usage_id'];
                $electric_model->update_usage($usage['usage_id'], $dataElectric);
            } else {
                $electric_model->add_usage($dataElectric);
            }

            if ($reward_model->get_user_reward_by_user_id_and_date($_SESSION['user']) == false) {
                $reward_point = rand(3, 10);
                $dataReward = array(
                    'reward_user_id' => $_SESSION['user'],
                    'reward_point' => $reward_point,
                );
                $reward_model->add_user_reward($dataReward);
            }
        }
        $dataWatt = array(
            'status' => 'success',
            'watt' => number_format($w, 2)
        );
        echo json_encode($dataWatt);
    }
}
