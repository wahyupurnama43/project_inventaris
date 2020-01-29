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
    protected $url;
    public function __construct()
    {
        if ((int) $_COOKIE["role"] === 0) {
            $this->url = "user";
        } elseif ((int) $_COOKIE['role'] === 1) {
            $this->url = "petugas";
        } else {
            $this->url = "admin";
        }
    }
    /**
     * 
     * dashboard()
     * 
     * method ini untuk menload dashboard
     * 
     */
    public function index()
    {
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '0' || $_COOKIE['role'] === 0) {
            $params['title'] = $_ENV["APP_NAME"] . " - User";
            $params['userdata'] = $this->useModel("Auth_model")->getUserBy("username", $_COOKIE['username']);
            $params['menu'] = $this->useModel("Main_model")->getMenu("0");
            $this->useViews(['templates.header', 'user.index', 'templates.footer'], $params);
        } else {
            Ardent::redirect(BASE_URL . "auth");
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
        if (isset($_COOKIE['is_login']) && $_COOKIE['role'] === '0' || $_COOKIE['role'] === 0) {
            $params['userdata'] = $this->useModel("Auth_model")->getUserBy("username", $_COOKIE['username']);
            $params['menu'] = $this->useModel("Main_model")->getMenu(0);
            if ($action === '') {
                $params['title'] = $_ENV["APP_NAME"] . " - Profile";
                $this->useViews(['templates.header', 'templates.profile', 'templates.footer'], $params);
            } else {
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
                            Ardent::redirect(BASE_URL . $this->url . "/profile");
                        } else {
                            setFlash("Oops! something is when wrong here.", "danger");
                            Ardent::redirect(BASE_URL . $this->url . "/profile");
                        }
                    }
                } elseif ($action === 'changepassword') {
                    if (!isset($_POST['change'])) {
                        $params['title'] = $_ENV["APP_NAME"] . " - Change Password";
                        $this->useViews(["templates.header", "templates.changepassword", "templates.footer"], $params);
                    } else {
                        if ($this->useModel("Auth_model")->updatePassword() > 0) {
                            setFlash("Successfully update your password.", "success");
                            Ardent::redirect(BASE_URL . $this->url . "/profile");
                        } else {
                            setFlash("Oops! something is when wrong here.", "danger");
                            Ardent::redirect(BASE_URL . $this->url . "/profile");
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
