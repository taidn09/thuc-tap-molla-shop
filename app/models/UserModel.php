<?php
class UserModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }

    public function getUsersList()
    {
        $select = "SELECT * FROM users ORDER BY userId DESC";
        return $this->db->getAll($select);
    }
    public function checkEmailExisted($email)
    {
        $select = "SELECT * FROM users WHERE email = '$email'";
        if ($this->db->getOne($select)) {
            return true;
        }
        return false;
    }
    public function checkPhoneExisted($phone)
    {
        $select = "SELECT * FROM users WHERE phone = '$phone'";
        if ($this->db->getOne($select)) {
            return true;
        }
        return false;
    }
    public function register($email, $password)
    {
        if ($this->checkEmailExisted($email)) {
            return false;
        }
        $password = md5($password);
        $query = "INSERT INTO users(email,password) VALUES ('$email', '$password')";
        return $this->db->exec($query);
    }
    public function login($email, $password)
    {
        $password = md5($password);
        $select = "SELECT userId, fname, lname, email, phone, province, district, ward, street,role, socialLogin,avatar FROM users WHERE email = '$email' AND password = '$password'";
        return $this->db->getOne($select);
    }
    public function getUserById($userId)
    {
        $select = "SELECT userId, fname, lname, email, phone, province, district, ward, street,role, socialLogin, avatar FROM users WHERE userId = '$userId'";
        return $this->db->getOne($select);
    }
    public function changeInfo($userId, $fname, $lname, $phone, $province, $district, $ward, $street, $avatar)
    {
        if (!empty($this->db->getOne("SELECT * FROM users WHERE phone = '$phone' AND userId != '$userId'"))) {
            return false;
        }   
        $query = "UPDATE users SET fname = '$fname', lname = '$lname',phone = '$phone', province = '$province' ,district = '$district',ward = '$ward',street = '$street', `avatar` = '$avatar' WHERE userId = '$userId'";
        return $this->db->exec($query);
    }
    public function checkEnterRightPassword($userId, $password)
    {
        $password = md5($password);
        $select = "SELECT password FROM users WHERE userId = '$userId' AND password = '$password'";
        return $this->db->getOne($select);
    }
    public function changePassword($userId, $newPassword)
    {
        $newPassword = md5($newPassword);
        $query = "UPDATE users SET password = '$newPassword' WHERE userId = '$userId'";
        return $this->db->exec($query);
    }
    public function changePasswordByEmail($email, $password)
    {
        $newPassword = md5($password);
        $query = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
        return $this->db->exec($query);
    }
    public function updateUser($userId, $fname ='', $lname ='', $email ='', $phone ='', $province ='', $district ='', $ward ='', $street ='', $avatar = '')
    {
        if (!empty($this->db->getOne("SELECT * FROM users WHERE email != '' AND phone != '' AND (email = '$email' OR phone = '$phone') AND userId != '$userId'"))) {
            return false;
        }
        $query = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`email`='$email',`phone`='$phone',`province`='$province',`district`='$district',`ward`='$ward',`street`='$street', `avatar` = '$avatar' WHERE userId = '$userId'";
        return $this->db->exec($query);
    }
    public function deleteUser($id)
    {
        $query = "DELETE FROM `users` WHERE userId = '$id'";
        return $this->db->exec($query);
    }
    public function updateSocialLogin($userId){
        $query = "UPDATE `users` SET `socialLogin` = 1  WHERE userId = '$userId'";
        return $this->db->exec($query);
    }
}
