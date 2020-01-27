<?php

/**
 * 
 * Admin_model.php
 * 
 * ini adalah model untuk koneksi database khusus admin
 * 
 */

use Inventaris\Core\Database;

class Admin_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
