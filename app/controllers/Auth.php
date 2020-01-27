<?php

class Auth extends Controller
{
    public function index()
    {
        if (true) {
            if (!isset($_POST['login'])) {
                $params['title'] = "Inventaris - Login";
                $this->useViews(["templates.auth.header", "auth.login", "templates.auth.footer"], $params);
            } else {
                if ($this->useModel("Auth_model")->login() > 0) {
                    echo "berhasil login";
                }
            }
        }
    }
    public function register()
    {
        if (true) {
            if (!isset($_POST["register"])) {
                $params['title'] = "Inventaris - Register";
                $params['jurusan'] = $this->useModel("Main")->getJurusan();
                $this->useViews(["templates.auth.header", "auth.register", "templates.auth.footer"], $params);
            } else {
                if ($this->useModel("Auth_model")->registerNewAccount($_POST) > 0) {
                    Ardent::redirect(BASE_URL . "auth");
                }
            }
        }
    }
}
