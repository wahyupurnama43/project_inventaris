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
    /**
     * 
     * dashboard()
     * 
     * method ini untuk menload dashboard
     * 
     */
    public function dashboard()
    {
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '2' || $_COOKIE['role'] === 2) {
            $params['title'] = $_ENV["APP_NAME"] . " - Admin";
            $params['userdata'] = $this->useModel("Auth_model")->getUserBy("username", $_COOKIE['username']);
            $this->useViews(['templates.header', 'admin.index', 'templates.footer'], $params);
        } else {
            Ardent::redirect(BASE_URL . "auth");
        }
    }
    /**
     * 
     * logout()
     * 
     * method ini untuk melog out user
     * 
     */
    public function logout()
    {
        if (isset($_COOKIE['is_login'])) {
            // hancurkan cookies yang jadi pertanda seorang user sudah login atau belum
            Ardent::destroyCookies(["is_login", "username", "role"]);
            Ardent::redirect(BASE_URL . "auth");
        }
    }
}
