<?php
require_once __DIR__ . '/../model/User.php';

class UserController {

    private function phoneNumberIsValidFormat($phone) {
        return preg_match('/^0[0-9]{9}$/', $phone);
    }
    private function emailIsValidFormat($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    private function passwordIsValidFormat($password) {
        return strlen($password) >= 8 && strlen($password) <= 30;
    }
    private function roleIsValidValue($role) {
        return in_array($role, ['admin', 'customer']);
    }
    private function nameIsValidFormat($name) {
        return strlen($name) >= 5 && strlen($name) <= 50;
    }
    private function sexIsValidValue($sex) {
        return in_array($sex, ['M', 'F']);
    }
    private function fieldAreValid($name, $sex, $password, $email, $phone, $role) {
        if (!$this->nameIsValidFormat($name))
            return ["message" => "Name must be between 5 and 50 characters"];
        if (!$this->sexIsValidValue($sex))
            return ["message" => "Sex must be 'M' or 'F'"];
        if (!$this->emailIsValidFormat($email))
            return ["message" => "Email is invalid"];
        if (!$this->phoneNumberIsValidFormat($phone))
            return ["message" => "Phone is invalid"];
        if (!$this->passwordIsValidFormat($password))
            return ["message" => "Password must be between 8 and 30 characters"];
        if (!$this->roleIsValidValue($role))
            return ["message" => "Role is invalid"];
        return ["message" => "Valid"];
    }

    public function fetch($offset, $limit) {
        $user = new User();
        $res = $user->fetch($offset, $limit); // a fetch array or null
        if (isset($res['code'])) return $res;

        return empty($res) ?
            Util::getResponseArray(200, "There is no user in system now", [])
        :   Util::getResponseArray(200, "Found users", $res);
    }

    public function getById($id) {
        $user = new User();
        $res = $user->getById($id);
        if (isset($res['code'])) return $res;

        return Util::getResponseArray(200, "User found", $res);
    }

    public function getHistory($id, $offset, $limit) {
        $user = new User();
        $res = $user->getHistory($id, $offset, $limit); // a fetch array or null
        if (isset($res['code'])) return $res;

        return empty($res) ?
            Util::getResponseArray(200, "There is no order history for this user", [])
        :   Util::getResponseArray(200, "Found order history", $res);
    }

    public function insertUser($name, $sex, $password, $email, $phone, $role, $avatar, $address) {
        // check some field are valid in private functions, if not return error message for the first invalid field
        $validMessage = $this->fieldAreValid($name, $sex, $password, $email, $phone, $role)['message'];
        if ($validMessage !== "Valid") {
            return Util::getResponseArray(400, $validMessage, null);
        }
        
        // hash password:
        $password = password_hash($password, PASSWORD_ARGON2ID);
        
        $user = new User();
        return $user->insertUser($name, $sex, $password, $email, $phone, $role, $avatar, $address);
    }

    public function authenticateUserByEmail($email, $password) {
        $user = new User();
        $res = $user->getByEmail($email);

        if (isset($res['code'])) return $res;

        // because res is 2D array and phone is unique, so res[0] is the only record
        if (password_verify($password, $res[0]['password'])) {
            return Util::getResponseArray(200, "Login successfully", $res);
        }
        return Util::getResponseArray(401, "Password is incorrect", null);
    }

    public function authenticateUserByPhone($phone, $password) {
        $user = new User();
        $res = $user->getByPhone($phone);

        if (isset($res['code'])) return $res;
    
        // because res is 2D array and phone is unique, so res[0] is the only record
        return password_verify($password, $res[0]['password']) ?
            Util::getResponseArray(200, "Login successfully", $res)
        :   Util::getResponseArray(401, "Password is incorrect", null);
    }


    public function changeUserPassword($id, $currentPassword, $newPassword) {
        $user = new User();
        $res = $user->getById($id);

        if (isset($res['code'])) return $res;

        if (!password_verify($currentPassword, $res[0]['password'])) {
            return Util::getResponseArray(401, "Current password is incorrect", null);
        }

        if (!$this->passwordIsValidFormat($newPassword)) {
            return Util::getResponseArray(400, "New password must be between 8 and 30 characters", null);
        }

        $newPassword = password_hash($newPassword, PASSWORD_ARGON2ID);
        return $user->updatePassword($id, $newPassword);
    }

    public function updateUserName($id, $name) {
        if (!$this->nameIsValidFormat($name)) {
            return Util::getResponseArray(400, "Name must be between 5 and 50 characters", null);
        }
        $user = new User();
        return $user->updateName($id, $name);
    }

    public function updateUserEmail($id, $email) {
        if (!$this->emailIsValidFormat($email)) {
            return Util::getResponseArray(400, "Email is invalid", null);
        }
        $user = new User();
        return $user->updateEmail($id, $email);
    }

    public function updateUserPhone($id, $phone) {
        if (!$this->phoneNumberIsValidFormat($phone)) {
            return Util::getResponseArray(400, "Phone is invalid", null);
        }
        $user = new User();
        return $user->updatePhone($id, $phone);
    }

    public function updateUserSex($id, $sex) {
        if (!$this->sexIsValidValue($sex)) {
            return Util::getResponseArray(400, "Sex must be 'M' or 'F'", null);
        }
        $user = new User();
        return $user->updateSex($id, $sex);
    }

    public function updateUserRole($id, $role) {
        if (!$this->roleIsValidValue($role)) {
            return Util::getResponseArray(400, "Role is invalid", null);
        }
        $user = new User();
        return $user->updateRole($id, $role);
    }

    public function updateUserAvatar($id, $avatar) {
        $user = new User();
        return $user->updateAvatar($id, $avatar);
    }

    public function updateUserAddress($id, $address) {
        $user = new User();
        return $user->updateAddress($id, $address);
    }


    public function deleteUser($id) {
        $user = new User();
        return $user->deleteById($id);
    }

    public function deleteAllUsers() {
        $user = new User();
        return $user->deleteAll();
    }
}

?>