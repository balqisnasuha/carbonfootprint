<?php
class Electric_model
{
    private $table = 'electric';
    private $db;
    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }


    public function get_all_device()
    {
        $sql = "SELECT * FROM electric_device WHERE device_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_device_by_id($id)
    {
        $sql = "SELECT * FROM electric_device WHERE device_id = '$id' AND device_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function get_device_by_name($name)
    {
        $sql = "SELECT * FROM electric_device WHERE device_name = '$name' AND device_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function get_device_by_watt($watt)
    {
        $sql = "SELECT * FROM electric_device WHERE device_watt = '$watt' AND device_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function get_all_usage()
    {
        $sql = "SELECT * FROM electric_usage WHERE usage_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_usage_by_id($id)
    {
        $sql = "SELECT * FROM electric_usage WHERE usage_id = '$id' AND usage_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function get_usage_by_device_id($device_id)
    {
        $sql = "SELECT * FROM electric_usage WHERE usage_device_id = '$device_id' AND usage_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_usage_by_user_id($user_id)
    {
        $sql = "SELECT * FROM electric_usage WHERE usage_user_id = '$user_id' AND usage_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function get_usage_year_by_user_id($user_id)
    {
        $month = array();

        // loop each month this year
        for ($i = 1; $i <= 12; $i++) {
            $sql = "SELECT SUM(usage_watt) AS watt FROM electric_usage WHERE usage_user_id = '$user_id' AND MONTH(usage_date) = '$i' AND YEAR(usage_date) = YEAR(CURDATE()) AND usage_status != '3'";
            $result = mysqli_query($this->db, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 0) {
                $month[] = 0;
                continue;
            } else {
                $row = mysqli_fetch_assoc($result);
                $month[] = $row['watt'] * 0.622;
            }
        }

        return $month;
    }

    public function get_usage_year()
    {
        $month = array();
        $watt = array();
        // loop each month this year
        for ($i = 1; $i <= 12; $i++) {
            $sql = "SELECT SUM(usage_watt) AS watt FROM electric_usage WHERE MONTH(usage_date) = '$i' AND YEAR(usage_date) = YEAR(CURDATE()) AND usage_status != '3'";
            $result = mysqli_query($this->db, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 0) {
                $month[] = 0;
                $watt[] = 0;
                continue;
            } else {
                $row = mysqli_fetch_assoc($result);
                $month[] = $i;
                $watt[] = $row['watt'] * 0.622;
            }
        }

        return $watt;
    }

    public function get_usage_month_by_user_id($user_id)
    {
        $day = array();
        $watt = array();
        // get last day of this month
        $last_day = date('t');


        // loop each day this month

        for ($i = 1; $i <= $last_day; $i++) {
            $sql = "SELECT SUM(usage_watt) AS watt FROM electric_usage WHERE usage_user_id = '$user_id' AND DAY(usage_date) = '$i' AND MONTH(usage_date) = MONTH(CURDATE()) AND YEAR(usage_date) = YEAR(CURDATE()) AND usage_status != '3'";
            $result = mysqli_query($this->db, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 0) {
                $day[] = $i;
                $watt[] = 0;
            } else {
                $row = mysqli_fetch_assoc($result);
                $day[] = $i;
                $watt[] = $row['watt'] * 0.622;
            }
        }
        $data = array(
            'day' => $day,
            'watt' => $watt
        );
        return $data;
    }

    public function get_usage_month()
    {
        $day = array();
        $watt = array();
        // get last day of this month
        $last_day = date('t');

        // loop each day this month
        for ($i = 1; $i <= $last_day; $i++) {
            $sql = "SELECT SUM(usage_watt) AS watt FROM electric_usage WHERE DAY(usage_date) = '$i' AND MONTH(usage_date) = MONTH(CURDATE()) AND YEAR(usage_date) = YEAR(CURDATE()) AND usage_status != '3'";
            $result = mysqli_query($this->db, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 0) {
                $day[] = $i;
                $watt[] = 0;
            } else {
                $row = mysqli_fetch_assoc($result);
                $day[] = $i;
                $watt[] = $row['watt'] * 0.622;
            }
        }
        $data = array(
            'day' => $day,
            'watt' => $watt
        );
        return $data;
    }

    public function get_usage_by_device_id_and_user_id($device_id, $user_id)
    {
        $sql = "SELECT * FROM electric_usage WHERE usage_device_id = '$device_id' AND usage_user_id = '$user_id' AND usage_status != '3'";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }



    public function add_device($data)
    {
        $columns = implode(", ", array_keys($data));
        $escaped_values = array_map(array($this->db, 'real_escape_string'), array_values($data));

        $values = implode("', '", $escaped_values);

        $sql = "INSERT INTO electric_device ($columns) VALUES ('$values')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function add_usage($data)
    {
        $columns = implode(", ", array_keys($data));
        $escaped_values = array_map(array($this->db, 'real_escape_string'), array_values($data));

        $values = implode("', '", $escaped_values);

        $sql = "INSERT INTO electric_usage ($columns) VALUES ('$values')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }


    public function get_usage_by_user_id_and_device_id_and_date($user_id, $device_id, $date)
    {
        $sql = "SELECT * FROM electric_usage WHERE usage_user_id = '$user_id' AND usage_device_id = '$device_id' AND usage_date = '$date' AND usage_status != '3'";
        $result = mysqli_query($this->db, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            return false;
        } else {
            return mysqli_fetch_assoc($result);
        }
    }

    public function update_device($id, $data)
    {
        $set = "";
        $count = count($data);

        foreach ($data as $key => $value) {
            $set .= "$key = '$value'";
            $count--;
            if ($count != 0) {
                $set .= ", ";
            }
        }

        $sql = "UPDATE electric_device SET $set WHERE device_id = '$id'";

        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function update_usage($id, $data)
    {
        $set = "";
        $count = count($data);

        foreach ($data as $key => $value) {
            $set .= "$key = '$value'";
            $count--;
            if ($count != 0) {
                $set .= ", ";
            }
        }

        $sql = "UPDATE electric_usage SET $set WHERE usage_id = '$id'";

        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function delete_device($id)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE electric_device SET device_status = '3', device_deleted_at = '$date' WHERE device_id = '$id'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function delete_usage($id)
    {
        $sql = "UPDATE electric_usage SET usage_status = 3 WHERE usage_id = '$id'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function delete_usage_by_device_id($device_id)
    {
        $sql = "UPDATE electric_usage SET usage_status = 3 WHERE usage_device_id = '$device_id'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function delete_usage_by_user_id($user_id)
    {
        $sql = "UPDATE electric_usage SET usage_status = 3 WHERE usage_user_id = '$user_id'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function delete_usage_by_device_id_and_user_id($device_id, $user_id)
    {
        $sql = "UPDATE electric_usage SET usage_status = 3 WHERE usage_device_id = '$device_id' AND usage_user_id = '$user_id'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }
}
