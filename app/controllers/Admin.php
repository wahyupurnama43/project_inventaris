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
    public function index()
    {
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '2' || $_COOKIE['role'] === 2) {
            $params['userdata'] = $this->useModel("Auth_model")->getUserBy("username", $_COOKIE['username']);
            $params['menu'] = $this->useModel("Main_model")->getMenu();
            $params['title'] = $_ENV["APP_NAME"] . " - Admin";
            $this->useViews(['templates.header', 'admin.index', 'templates.footer'], $params);
        } else {
            Ardent::redirect(BASE_URL . "errorpage/forbidden");
        }
    }
    /**
     * 
     * profile()
     * 
     * method ini untuk menampilkan userprofile
     * 
     */
    public function profile($action = '')
    {
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '2' || $_COOKIE['role'] === 2) {
            $params['userdata'] = $this->useModel("Auth_model")->getUserBy("username", $_COOKIE['username']);
            $params['menu'] = $this->useModel("Main_model")->getMenu();
            if ($action === '') {
                $params['title'] = $_ENV["APP_NAME"] . " - Profile";
                $this->useViews(['templates.header', 'templates.profile', 'templates.footer'], $params);
            } else {
                $url = (int) $_COOKIE['role'] === 0 ? "user" : (int) $_COOKIE['role'] === 1 ? "petugas" : "admin";
                if ($action === 'editprofile') {
                    if (!isset($_POST['edit'])) {
                        $params['title'] = $_ENV["APP_NAME"] . " - Edit Profile";
                        $params['jurusan'] = $this->useModel("Main_model")->getJurusan();
                        $this->useViews(["templates.header", "templates.editprofile", "templates.footer"], $params);
                    } else {
                        if ($this->useModel("Auth_model")->updateProfile() > 0) {
                            setFlash("Successfully update your data.", "success");
                            Ardent::destroyCookies(['is_login', 'role', 'username']);
                            Ardent::makeCookies(["is_login", "role", "username"], [password_hash($_POST['username'], PASSWORD_BCRYPT), $params['userdata']['role_user'], $_POST['username']], 7200);
                            Ardent::redirect(BASE_URL . $url . "/profile");
                        }
                    }
                } elseif ($action === 'changepassword') {
                    if (!isset($_POST['change'])) {
                        $params['title'] = $_ENV["APP_NAME"] . " - Change Password";
                        $this->useViews(["templates.header", "templates.changepassword", "templates.footer"], $params);
                    } else {
                        if ($this->useModel("Auth_model")->updatePassword() > 0) {
                            setFlash("Successfully update your password.", "success");
                            Ardent::redirect(BASE_URL . $url . "/profile");
                        }
                    }
                } else {
                    Ardent::redirect(BASE_URL . "errorpage/notfound");
                }
            }
        } else {
            Ardent::redirect(BASE_URL . "errorpage/forbidden");
        }
    }

    /**
     * 
     * menu()
     * 
     * method ini untuk mengatur menu dan access menu
     * 
     */
    public function menu()
    {
        $params['userdata'] = $this->useModel("Auth_model")->getUserBy("username", $_COOKIE['username']);
        $params['menu'] = $this->useModel("Main_model")->getMenu();
        $params['title'] = $_ENV["APP_NAME"] . " - Admin";
        $this->useViews(['templates.header', 'admin.index', 'templates.footer'], $params);
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
            setFlash("Successfully logout from application, have a good day", "success");
            Ardent::redirect(BASE_URL . "auth");
        } else {
            Ardent::redirect(BASE_URL . "errorpage/forbidden");
        }
    }
}
