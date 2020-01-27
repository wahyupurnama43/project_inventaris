<?php

use Inventaris\Core\Database;

/**
 * 
 * User_model.php
 * 
 * ini adalah model untuk komunikasi database khusus user
 * 
 * 
 */

class User_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
