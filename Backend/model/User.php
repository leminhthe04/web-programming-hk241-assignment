<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../lib/utils.php';
require_once __DIR__ . '/Order.php';

class User {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect(); // get connection from database.php
    }


    public function fetch($offset, $limit) {
        $page_count = Util::getPageCount('users', $limit);

        $stmt = $this->conn->prepare("CALL findAll('users', ?, ?)");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        $stmt->close();
        return $arr;        
    }

    public function getById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL findById('users', ?)");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            $stmt->close();
            return $arr;
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function getHistory($id, $offset, $limit) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL findUserHistory(?)");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $table = $stmt->get_result();
            $history = Util::fetch($table);
            $stmt->close();

            $order = new Order();
            $orders = [];
            foreach ($history as $h) {
                $order_id = $h['order_id'];
                $order_detail = $order->getById($order_id);
                if (isset($order_detail['code'])) return $order_detail;
                $orders[$order_id] = $order_detail;
            }   

            $page_count = ceil(count($orders) / $limit);
            sort($orders);
            $orders = array_slice($orders, $offset, $limit);
            $data = ["page_count" => $page_count, "data" => $orders];
            return $data;
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }


    public function getByEmail($email) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL findByUniqueField('users', 'email', ?)");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            $stmt->close();
            return $arr;
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function getByPhone($phone) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try{
            $stmt = $this->conn->prepare("CALL findByUniqueField('users', 'phone', ?)");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            $stmt->close();
            return $arr;
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    // CALL insertUser('Nguyen Van B', 'M', '123456', 'nguyenB@gmail.com', '0123456790', 'admin', 'avt_url', '192 ĐPB, Q.1, TP.HCM');
    public function insertUser($name, $sex, $password, $email, $phone, $role, $avatar, $address) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL insertUser(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $name, $sex, $password, $email, $phone, $role, $avatar, $address);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return Util::getResponseArray(201, "User created", ["id" => $result->fetch_assoc()['id']]);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updatePassword($id, $password) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateUserPassword(?, ?)");
            $stmt->bind_param("is", $id, $password);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Password updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateName($id, $name) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateUserName(?, ?)");
            $stmt->bind_param("is", $id, $name);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Name updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateSex($id, $sex) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateUserSex(?, ?)");
            $stmt->bind_param("is", $id, $sex);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Sex updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateEmail($id, $email) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateUserEmail(?, ?)");
            $stmt->bind_param("is", $id, $email);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Email updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updatePhone($id, $phone) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateUserPhone(?, ?)");
            $stmt->bind_param("is", $id, $phone);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Phone updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateRole($id, $role) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateUserRole(?, ?)");
            $stmt->bind_param("is", $id, $role);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Role updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateAvatar($id, $avt_url) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateUserAvtUrl(?, ?)");
            $stmt->bind_param("is", $id, $avt_url);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Avatar updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateAddress($id, $address) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateUserAddress(?, ?)");
            $stmt->bind_param("is", $id, $address);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Address updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function deleteById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL deleteById('users', ?);");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "User deleted", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function deleteAll() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL deleteAll('users')");
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "All users deleted", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }
}

?>