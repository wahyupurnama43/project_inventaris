<?php

use Inventaris\Core\Ardent;
use Inventaris\Core\Controller;

/**
 * 
 * User.php
 * 
 * ini merupakan controller dari view user
 * 
 */

class Petugas extends Controller
{
    public function dashboard()
    {
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '1' || $_COOKIE['role'] === 1) {
            echo "Petugas/Index";
        } else {
            Ardent::redirect(BASE_URL . "auth");
        }
    }
}
