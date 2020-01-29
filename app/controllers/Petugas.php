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
    /**
     * 
     * dashboard()
     * 
     * method ini untuk menload dashboard
     * 
     */
    public function index()
    {
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '1' || $_COOKIE['role'] === 1) {
            echo "Petugas/Index";
        } else {
            Ardent::redirect(BASE_URL . "auth");
        }
    }
    /**
     * 
     * logout function
     * 
     * method ini untuk melog out user
     * 
     */
    public function logout()
    {
        if (isset($_COOKIE['is_login'])) {
            // hancurkan cookies yang jadi pertanda seorang user sudah login atau belum
            Ardent::destroyCookies(["is_login", "username", "role"]);
            setFlash("Successfully logout from application, have a good day", "success");
            Ardent::redirect(BASE_URL . "auth");
        }
    }
}
