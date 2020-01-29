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
     * menu()
     * 
     * method ini untuk mengatur menu dan access menu
     * 
     */
    public function menu($actions = '', $verificator = '')
    {
        if (isset($_COOKIE['is_login'])) {
            $params['userdata'] = $this->useModel("Auth_model")->getUserBy("username", $_COOKIE['username']);
            $params['menu'] = $this->useModel("Main_model")->getMenu();
            $params['title'] = $_ENV["APP_NAME"] . " - Admin";
            if (!isset($actions) || $actions === '') {
                $this->useViews(['templates.header', 'admin.menulists', 'templates.footer'], $params);
            } else {
                if (isset($actions) && $actions === "addnewmenu") {
                    if (!isset($_POST["addnewmenu"])) {
                        $params['title'] = $_ENV["APP_NAME"] . " - Add New Menu";
                        $this->useViews(["templates.header", "admin.addmenu", "templates.footer"], $params);
                        Ardent::unsetSession();
                    } else {
                        if ($this->useModel("Main_model")->addNewMenu()) {
                            setFlash("Successfully new menu is added.", "success");
                            Ardent::redirect(BASE_URL . $this->url . "/menu");
                        } else {
                            setFlash("Oops! Look is something when wrong here.", "danger");
                            Ardent::redirect(BASE_URL . $this->url . "/menu");
                        }
                    }
                } elseif (isset($actions) && $actions === 'deletemenu') {
                    if (isset($verificator) && $verificator !== '') {
                        if ($this->useModel("Main_model")->deleteMenu($verificator) > 0) {
                            setFlash("Successfully deleted new menu.", "success");
                            Ardent::redirect(BASE_URL . $this->url . "/menu");
                        } else {
                            setFlash("Oops! Look is something when wrong here.", "danger");
                            Ardent::redirect(BASE_URL . $this->url . "/menu");
                        }
                    } else {
                        setFlash("You entered invalid url for delete a menu.", "danger");
                        makeNotification("Failed to delete menu!");
                        Ardent::redirect(BASE_URL . $this->url . "/menu");
                    }
                } elseif (isset($actions) && $actions === 'editmenu') {
                    if (isset($verificator) && $verificator !== '') {
                        if (!isset($_POST['editmenu'])) {
                            $params['title'] = $_ENV["APP_NAME"] . " - Edit Menu";
                            $params['spes_menu'] = $this->useModel("Main_model")->getMenuById($verificator);
                            $this->useViews(["templates.header", "admin.editmenu", "templates.footer"], $params);
                        } else {
                            if($this->useModel("Main_model")->updateMenu($verificator) > 0) {
                                setFlash("Successfully update menu.", "success");
                                makeNotification("Menu has been updated.");
                                Ardent::redirect(BASE_URL . $this->url . "/menu");
                            } else {
                                setFlash("Oops! Look is something when wrong.", "danger");
                                makeNotification("Failed to update menu.");
                                Ardent::redirect(BASE_URL . $this->url . "/menu");
                            }
                        }
                    } else {
                        setFlash("You entered invalid url for edit a menu.", "danger");
                        makeNotification("Failed to update menu.");
                        Ardent::redirect(BASE_URL . $this->url . "/menu");
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
