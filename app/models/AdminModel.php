<?php
class AdminModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    public function checkEmailExisted($email, $adminId = null)
    {
        if (!$adminId) {
            $select = "SELECT email FROM `admins` WHERE email = '$email'";
        } else {
            $select = "SELECT email FROM `admins` WHERE email = '$email' AND adminId != $adminId";
        }

        if ($this->db->getOne($select)) {
            return true;
        }
        return false;
    }
    public function getAdminList($all = false)
    {
        $select = "SELECT * FROM `admins` WHERE email != 'taidn@gmail.com'";
        if($all == true){
            $select = "SELECT * FROM `admins`";
        }
        return $this->db->getAll($select);
    }
    public function login($email, $password)
    {
        $password = md5($password);
        $select = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
        return $this->db->getOne($select);
    }
    public function getAdminById($id)
    {
        $select = "SELECT * FROM `admins` WHERE adminId = $id";
        return $this->db->getOne($select);
    }
    public function createAdmin($name, $email, $password, $image, $role)
    {
        if ($this->checkEmailExisted($email)) {
            return false;
        }
        $password = md5($password);
        $query = "INSERT INTO `admins`(`name`, `email`, `password`, `image`,`role`) VALUES ('$name','$email','$password','$image',$role)";
        return $this->db->exec($query);
    }
    public function updateAdmin($adminId, $name, $email, $password, $image = null, $role)
    {
        if ($this->checkEmailExisted($email, $adminId)) {
            return false;
        }
        $password = md5(($password));
        if ($image) {
            $admin = $this->getAdminById($adminId);
            if(file_exists('public/assets/images/admin/' . $admin['image'])){
                unlink('public/assets/images/admin/' . $admin['image']);
            }
            $query = "UPDATE `admins` SET `name`='$name',`email`='$email',`password`='$password',`image`='$image',`role`='$role' WHERE adminId = $adminId";
        } else {
            $query = "UPDATE `admins` SET `name`='$name',`email`='$email',`password`='$password',`role`='$role' WHERE adminId = $adminId";
        }
        return $this->db->exec($query);
    }
    public function deleteAdmin($adminId)
    {
        $image = $this->getAdminById($adminId);
        unlink('public/assets/images/admin/' . $image['image']);
        $query = "DELETE FROM `admins` WHERE adminId = $adminId";
        return $this->db->exec($query);
    }
    public function updateAdminRoles($adminId, $role)
    {
        $query = "INSERT INTO `admin_roles`(`adminId`, `roleString`) VALUES ($adminId,'$role')";
        return $this->db->exec($query);
    }
    public function deleteRoles($adminId)
    {
        $delete = "DELETE FROM admin_roles WHERE adminId = '$adminId'";
        return $this->db->exec($delete);
    }
    public function getRoles($adminId)
    {
        $select = "SELECT roleString FROM admin_roles WHERE adminId = '$adminId'";
        return $this->db->getAll($select);
    }
    public function insertAdminRoles($adminId, $role)
    {
        $query = "INSERT INTO admin_roles (adminId, roleString) VALUES('$adminId' ,'$role')";
        return $this->db->exec($query);
    }
    public function checkEnterRightPassword($id, $password)
    {   
        $password = md5($password);
        $select = "SELECT * FROM `admins` WHERE adminId = '$id' AND password = '$password'";
        if($this->db->getOne($select)){
            return true;
        }
        return false;
    }
    public function changePassword($id, $password)
    {
        $password = md5($password);
        $query = "UPDATE `admins` SET `password`='$password' WHERE adminId ='$id'";
        return $this->db->exec($query);
    }
}
