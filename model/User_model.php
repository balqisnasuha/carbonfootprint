<?php
class User_model
{
    private $table = 'users';
    private $db;
    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }
    public function get_user_by_id($id)
    {
        $sql = "SELECT * FROM $this->table WHERE user_id = '$id' AND user_deleted_at IS NULL";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function get_user_by_email($email)
    {
        $sql = "SELECT * FROM $this->table WHERE user_email = '$email' AND user_deleted_at IS NULL";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function get_user_by_user_ic_no($ic)
    {
        $sql = "SELECT * FROM $this->table WHERE user_ic_no = '$ic' AND user_deleted_at IS NULL";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }



    public function update_user_by_user_id($user_id, $data)
    {
        $set = '';

        $n = count($data);
        foreach ($data as $key => $value) {
            $n--;
            if ($n == 0) {
                $set .= "$key = '$value'";
            } else {
                $set .= "$key = '$value', ";
            }
        }

        $sql = "UPDATE $this->table SET $set WHERE user_id = $user_id";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_all_user($role = null)
    {
        if ($role == null) {
            $sql = "SELECT * FROM $this->table";
            $result = mysqli_query($this->db, $sql);
            return $result;
        } else {
            $sql = "SELECT * FROM $this->table WHERE user_role = '$role'";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }
    }

    public function get_all_state()
    {
        $sql = "SELECT * FROM `state`";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function add_address($user_id, $address, $city, $postcode, $state)
    {
        $sql = "INSERT INTO `users_address` (`user_id`, `user_address`, `user_address_city`, `user_address_postcode`, `user_address_state_id`) VALUES ('$user_id', '$address', '$city', '$postcode', '$state')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_address_by_id_and_user_id($id, $user_id)
    {
        $sql = "SELECT * FROM `users_address` WHERE `users_address`.`user_address_id` = $id AND `users_address`.`user_id` = $user_id AND `users_address`.`user_address_deleted_at` IS NULL";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function get_all_user_address_by_user_id($id)
    {
        $sql = "SELECT * FROM `users_address` JOIN `state` ON `users_address`.`user_address_state_id` = `state`.`state_id` WHERE `users_address`.`user_id` = $id";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function delete_address($id)
    {
        $sql = "UPDATE `users_address` SET `user_address_deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `users_address`.`user_address_id` = $id";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function update_address($user_id, $data)
    {
        $set = '';
        $n = count($data);
        foreach ($data as $key => $value) {
            $n--;
            if ($n == 0) {
                $set .= "$key = '$value'";
            } else {
                $set .= "$key = '$value', ";
            }
        }

        $sql = "UPDATE `users_address` SET $set WHERE `users_address`.`user_id` = $user_id";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }


}
