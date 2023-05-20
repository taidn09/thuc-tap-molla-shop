<?php 
    class BrandModel{
        private $db = null;
        public function __construct() {
            $this->db = new Connection();
        }
        public function getBrandsList()
        {
            $select = "SELECT * FROM brands";
            return $this->db->getAll($select);
        }

    }
?>