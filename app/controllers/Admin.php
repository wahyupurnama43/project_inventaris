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

class Admin extends Controller
{
    public function index()
    {
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '2' || $_COOKIE['role'] === 2) {
            echo "User/Index";
        } else {
            Ardent::redirect(BASE_URL . "auth");
        }
    }
}
