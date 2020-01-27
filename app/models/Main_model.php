<?php

use Inventaris\Core\Database;

class Main_model
{
    private $tbJurusan = "tb_jurusan";

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getJurusan()
    {
        $q = "SELECT * FROM $this->tbJurusan";
        $this->db->query($q);
        return $this->db->getAllData();
    }
}
