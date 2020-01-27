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
        }
    }
}
