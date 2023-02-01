<?php
class Reward_model
{
    private $table = 'reward';
    private $db;
    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function get_all_reward()
    {
        $sql = "SELECT * FROM reward WHERE reward_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_reward_by_id($id)
    {
        $sql = "SELECT * FROM reward WHERE reward_id = '$id' AND reward_status != '3'";
        $result = mysqli_query($this->db, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $return = mysqli_fetch_assoc($result);
            return $return;
        } else {
            return false;
        }
    }

    public function insert_reward($data)
    {
        $column = implode(", ", array_keys($data));
        $value = implode("', '", $data);
        $sql = "INSERT INTO reward ($column) VALUES ('$value')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function update_reward($id, $data)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = substr($set, 0, -2);
        $sql = "UPDATE reward SET $set WHERE reward_id = '$id'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function delete_reward($id)
    {
        $sql = "UPDATE reward SET reward_status = '3' WHERE reward_id = '$id'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function insert_reward_redeem($data)
    {
        $column = implode(", ", array_keys($data));
        $value = implode("', '", $data);
        $sql = "INSERT INTO reward_redeem ($column) VALUES ('$value')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_all_user_reward_redeem_by_user_id($id)
    {
        $sql = "SELECT SUM(redeem_point) AS total FROM reward_redeem WHERE redeem_user_id = '$id' AND redeem_status = '1'";
        $result = mysqli_query($this->db, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $return = mysqli_fetch_assoc($result);
            return $return['total'];
        } else {
            return 0;
        }
    }

    public function get_all_user_reward_by_user_id($id)
    {
        $sql = "SELECT * FROM `user_reward` WHERE `reward_user_id` = $id";
        $result = mysqli_query($this->db, $sql);

        $total = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['reward_point'];
        }

        return $total - $this->get_all_user_reward_redeem_by_user_id($id);
    }

    public function list_user_reward_by_user_id($id)
    {
        $sql = "SELECT * FROM `reward_redeem` JOIN `reward` ON `reward_redeem`.`redeem_reward_id` = `reward`.`reward_id` WHERE `redeem_user_id` = '$id' AND `redeem_status` != '3'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_user_reward_by_user_id_and_date($id, $date = null)
    {
        if ($date == null) {
            $sql = "SELECT * FROM `user_reward` WHERE `reward_user_id` = $id AND `reward_created_at` >= '" . date('Y-m-d') . " 00:00:00' AND `reward_created_at` <= '" . date('Y-m-d') . " 23:59:59'";
            $result = mysqli_query($this->db, $sql);
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                return mysqli_fetch_assoc($result);
            } else {
                return false;
            }
        } else {
            $sql = "SELECT * FROM `user_reward` WHERE `reward_user_id` = $id AND `reward_created_at` >= '$date 00:00:00' AND `reward_created_at` <= '$date 23:59:59'";
            $result = mysqli_query($this->db, $sql);
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                return mysqli_fetch_assoc($result);
            } else {
                return false;
            }
        }
    }

    public function add_user_reward($data)
    {
        $columns = implode(", ", array_keys($data));
        $escaped_values = array_map(array($this->db, 'real_escape_string'), array_values($data));
        $values = implode("', '", $escaped_values);
        $sql = "INSERT INTO `user_reward`($columns) VALUES ('$values')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_all_redeem()
    {
        // SELECT `redeem_id`, `redeem_reward_id`, `redeem_user_id`, `redeem_point`, `redeem_status`, `redeem_comment`, `redeem_created_at`, `redeem_updated_at`, `redeem_deleted_at` FROM `reward_redeem` WHERE 1
        // SELECT `user_id`, `user_name`, `user_email`, `user_ic_no`, `user_phone`, `user_password`, `user_role`, `user_status`, `user_created_at`, `user_updated_at`, `user_deleted_at` FROM `users` WHERE 1
        // SELECT `reward_id`, `reward_name`, `reward_point`, `reward_start_date`, `reward_end_date`, `reward_status`, `reward_created_at`, `reward_updated_at`, `reward_deleted_at` FROM `reward` WHERE 1

        $sql = "SELECT * FROM `reward_redeem` JOIN `users` ON `reward_redeem`.`redeem_user_id` = `users`.`user_id` JOIN `reward` ON `reward_redeem`.`redeem_reward_id` = `reward`.`reward_id`";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_reward_redeem_by_id($id)
    {
        $sql = "SELECT * FROM `reward_redeem` JOIN `users` ON `reward_redeem`.`redeem_user_id` = `users`.`user_id` JOIN `reward` ON `reward_redeem`.`redeem_reward_id` = `reward`.`reward_id` WHERE `redeem_id` = '$id'";
        $result = mysqli_query($this->db, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }

    public function update_redeem($id, $data)
    {
        $set = '';
        $x = 1;

        foreach ($data as $name => $value) {
            $set .= "{$name} = '{$value}'";
            if ($x < count($data)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE `reward_redeem` SET {$set} WHERE `redeem_id` = {$id}";

        $result = mysqli_query($this->db, $sql);

        return $result;
    }
}
