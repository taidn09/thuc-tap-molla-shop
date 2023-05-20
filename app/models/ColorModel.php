<?php
class ColorModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    public function getAllColors()
    {
        $select = "SELECT * FROM colors";
        return $this->db->getAll($select);
    }
}
