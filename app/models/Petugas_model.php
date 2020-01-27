<?php

use Inventaris\Core\Database;

/**
 * 
 * Petugas_model.php
 * 
 * ini adalah model untuk koneksi database khusus untuk petugas
 * 
 */

class Petugas_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
