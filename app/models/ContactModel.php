<?php

class ContactModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    public function addContact($name, $userId, $email, $phone, $message)
    {   
        $createdAt = date('Y-m-d H:i:s');
        if (!empty($userId)) {
            $query = "INSERT INTO contact(name, userId, email, phone, message, createdAt) VALUES('$name',$userId, '$email', '$phone','$message', '$createdAt')";
        } else {
            $query = "INSERT INTO contact(name, email, phone, message, createdAt) VALUES('$name', '$email', '$phone','$message', '$createdAt')";
        }
        return $this->db->exec($query);
    }
    public function reply($id, $reply = null)
    {
        $query = "UPDATE `contact` SET `reply` = '$reply'  WHERE id = $id";
        return $this->db->exec($query);
    }
    public function deleteContact($id)
    {
        $query  = "DELETE FROM `contact` WHERE id = $id";
        return $this->db->exec($query);
    }
    public function getAllContact()
    {
        $select = "SELECT * FROM `contact`";
        return $this->db->getAll($select);
    }
    public function getContactById($id)
    {
        $select = "SELECT * FROM `contact` WHERE id = $id";
        return $this->db->getOne($select);
    }
}
