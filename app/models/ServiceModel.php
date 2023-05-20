<?php 
    class ServiceModel{
        private $db = null;
        public function __construct() {
            $this->db = new Connection();
        }
        public function getServicesList()
        {
            $select = "SELECT * FROM services";
            return $this->db->getAll($select);
        }
    }
?>