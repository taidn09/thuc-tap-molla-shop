<?php 
    class Connection{
        var $db = null;
        function __construct()
        {
            $dsn = 'mysql:host=localhost;dbname=molla';
            $user = 'root';
            $pass = '';
            try {
                $this->db = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            } catch (\Throwable $th) {
                echo 'Connect to Database failed';
            }
        }
        public function getAll($select)
        {
            return $this->db->query($select)->fetchAll();
        }
        public function getOne($select)
        {
            $result = $this->db->query($select);
            $result = $result->fetch();
            return $result;
        }
        public function exec($query)
        {
            return $this->db->exec($query);
        }
        public function quote($str)
        {
            return $this->db->quote($str);
        }
    }
