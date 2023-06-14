<?php
class PositionModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    public function getAll($isAll = true)
    {   
        $select = "SELECT * FROM positions";
        if($isAll == false){
            $select .= " WHERE id != 1";
        }
        return $this->db->getAll($select);
    }
    public function getById($id)
    {
        $select = "SELECT * FROM positions WHERE id = '$id'";
        return $this->db->getOne($select);
    }
    public function add($title){
        $query = "INSERT INTO `positions`(`job_title`) VALUES ('$title')";
        // echo $query;
        return $this->db->exec($query);
    }
    public function update($id, $title){
        $query = "UPDATE `positions` SET `job_title`='$title' WHERE id = '$id'";
        return $this->db->exec($query);
    }
    public function delete($id)
    {
        $query = "DELETE FROM `positions` WHERE id ='$id'";
        return $this->db->exec($query);
    }
    public function check_existed($title){
        $select = "SELECT * FROM `positions` WHERE LOWER(job_title) = LOWER('$title')";
        return $this->db->getOne($select);
    }
    public function authorize($id, $rolesString){
        $check = $this->getRoles($id);
        if(!empty($check)){
            $query = "UPDATE `roles` SET `rolesString`='$rolesString' WHERE id = '$id'";
        }else{
            $query = "INSERT INTO `roles`(`id`, `rolesString`) VALUES ('$id','$rolesString')";
        }
        return $this->db->exec($query);
    }
    public function getRoles($id)
    {
        $select = "SELECT * FROM `roles` WHERE id ='$id'";
        return $this->db->getOne($select);
    }
}
