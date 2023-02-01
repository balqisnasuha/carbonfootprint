<?php
require_once 'config/db.php';
include 'model/user_model.php';
include 'model/reward_model.php';
$user_model = new User_model();
$reward_model = new Reward_model();
if (!isset($_SESSION['user'])) {
    redirect('login.php');
}
if (isset($_GET['id'])) {
    $reward = $reward_model->get_reward_by_id($_GET['id']);
    if ($reward != false) {
        $reward = $reward_model->get_reward_by_id($_GET['id']);

        if ($reward_model->get_all_user_reward_by_user_id($_SESSION['user']) >= $reward['reward_point'] && $reward['reward_status'] == '1') {
            $dataRedeem = array(
                'redeem_reward_id' => $reward['reward_id'],
                'redeem_user_id' => $_SESSION['user'],
                'redeem_point' => $reward['reward_point'],
                'redeem_status' => '0'
            );
            $insertRedeem = $reward_model->insert_reward_redeem($dataRedeem);
            $_SESSION['message'] = alert('Redeem success.', 'success');
            redirect('index.php');
        } else {
            $_SESSION['message'] = alert('You don\'t have enough point reward.', 'danger');
            redirect('index.php');
        }
    } else {
        redirect('index.php');
    }
} else {
    redirect('index.php');
}
