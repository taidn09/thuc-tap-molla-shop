<?php 
    class TokenModel {
        private $db =null;
        public function __construct()
        {
            $this->db = new Connection();
        }
        public function add($email, $token)
        {   
            $current_datetime = new DateTime();
            $current_datetime->modify('+5 minutes');
            $expired_time = $current_datetime->format('Y-m-d H:i:s');
            $this->delete($email);
            $query = "INSERT INTO `tokens`(`email`, `token`, `expired_time`) VALUES ('$email','$token','$expired_time')";
            return $this->db->exec($query);
        }
        public function delete($email)
        {
            $query = "DELETE FROM `tokens` WHERE email ='$email'";
            return $this->db->exec($query);
        }
        public function check($email, $token)
        {
            $current_datetime = date('Y-m-d H:i:s');
            $select  = "SELECT * FROM `tokens` WHERE email ='$email' AND token = '$token' AND expired_time > '$current_datetime'";
            // echo $select;
            return $this->db->getOne($select);
        }
    }
