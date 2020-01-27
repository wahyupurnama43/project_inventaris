<?php

use Inventaris\Core\Controller;
use Inventaris\Core\Ardent;

class Auth extends Controller
{
    public function index()
    {
        if (!isset($_COOKIE['is_login'])) {
            if (!isset($_POST['login'])) {
                $params['title'] = "Inventaris - Login";
                $this->useViews(["templates.auth.header", "auth.login", "templates.auth.footer"], $params);
                Ardent::unsetSession();
            } else {
                $this->useModel("Auth_model")->login($_POST);
            }
        } else {
            if ($_COOKIE['role'] === '0' || $_COOKIE['role'] === 0) {
                Ardent::redirect(BASE_URL . "user");
            } elseif ($_COOKIE['role'] === '1' || $_COOKIE['role'] === 1) {
                Ardent::redirect(BASE_URL . "petugas");
            } else {
                Ardent::redirect(BASE_URL . "admin");
            }
        }
    }
    public function register()
    {
        if (!isset($_COOKIE['is_login'])) {
            if (!isset($_POST["register"])) {
                $params['title'] = "Inventaris - Register";
                $params['jurusan'] = $this->useModel("Main_model")->getJurusan();
                $this->useViews(["templates.auth.header", "auth.register", "templates.auth.footer"], $params);
                Ardent::unsetSession();
            } else {
                if ($this->useModel("Auth_model")->registerNewAccount($_POST) > 0) {
                    setFlash("Congrats! You success create an account. Please login!", "success");
                    Ardent::redirect(BASE_URL . "auth");
                }
            }
        } else {
            if ($_COOKIE['role'] === '0' || $_COOKIE['role'] === 0) {
                Ardent::redirect(BASE_URL . "user");
            } elseif ($_COOKIE['role'] === '1' || $_COOKIE['role'] === 1) {
                Ardent::redirect(BASE_URL . "petugas");
            } else {
                Ardent::redirect(BASE_URL . "admin");
            }
        }
    }
}
