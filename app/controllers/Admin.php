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
}
