<?php

class Auth_model
{
    private $tb = "tb_user";
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // registerNewAccount
    public function registerNewAccount($data)
    {
        $fullname = post("fullname");
        $jurusan = post("jurusan");
        $class = post("class");
        $username = post("username");
        $password = post("password");
        $conf_password = post("conf_password");

        $q = "INSERT INTO $this->tb VALUES ('',:fullname,:username,:password,:jurusan,:class,:role)";
        $this->db->query($q);
        $this->db->bind("fullname", $fullname);
        $this->db->bind("username", $username);
        $this->db->bind("password", password_hash($password, PASSWORD_BCRYPT));
        $this->db->bind("jurusan", $jurusan);
        $this->db->bind("class", $class);
        $this->db->bind("role", 0);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
