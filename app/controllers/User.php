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

class User extends Controller
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
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '0' || $_COOKIE['role'] === 0) {
            $params['title'] = $_ENV["APP_NAME"] . " - User";
            $params['userdata'] = $this->useModel("Auth_model")->getUserBy("username", $_COOKIE['username']);
            $this->useViews(['templates.header', 'user.index', 'templates.footer'], $params);
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
            Ardent::redirect(BASE_URL . "auth");
        }
    }
}
