<?php

use Inventaris\Core\Ardent;
use Inventaris\Core\Database;

class Auth_model
{
    private $tb = "tb_user";
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * 
     * getUserBy($verificator, $value)
     * 
     * method ini digunakan untuk mengambil user berdasarkan verificator
     * 
     * @param String $verificator , menampung nama verifikator
     * @param mixed $value , menampung value verifikator
     * 
     * @return mixed
     * 
     */
    public function getUserBy($verificator, $value)
    {
        if (isset($verificator) && isset($value)) {
            $q = "SELECT * FROM $this->tb WHERE $verificator=:$verificator";
            $this->db->query($q);
            $this->db->bind($verificator, $value);
            return $this->db->getData();
        }
    }

    /**
     * 
     * login($data) 
     * 
     * method ini digunakan untuk login user
     * 
     * @param mixed $data , menampung data user
     * 
     * @return int
     * 
     */
    public function login($data)
    {
        $username = post("username");
        $password = post("password");

        setSavedValue("username", $username);

        if (isset($username) && $username !== '') {
            if ($datauser = $this->getUserBy("username", $username)) {
                $password_user = $datauser['password'];
                $role = $datauser['role_user'];
                if (isset($password) && $password !== '') {
                    if (password_verify($password, $password_user)) {
                        Ardent::makeCookies(["is_login", "role", "username"], [password_hash($username, PASSWORD_BCRYPT), $role, $username], 7200);
                        if ($role === '0' || $role === 0) {
                            Ardent::redirect(BASE_URL . "user");
                        } elseif ($role === '1' || $role === 1) {
                            Ardent::redirect(BASE_URL . "petugas");
                        } else {
                            Ardent::redirect(BASE_URL . "admin");
                        }
                        Ardent::unsetSession();
                    } else {
                        setError("pass_error");
                        Ardent::redirect(BASE_URL . "auth");
                    }
                } else {
                    setError("pass_empty");
                    Ardent::redirect(BASE_URL . "auth");
                }
            } else {
                setError("user_error");
                Ardent::redirect(BASE_URL . "auth");
            }
        } else {
            setError("user_empty");
            Ardent::redirect(BASE_URL . "auth");
        }
    }

    /**
     * 
     * registerNewAccount($data) 
     * 
     * method ini digunakan untuk menregister user baru
     * 
     * @param mixed $data , menampung data data yang akan di masukkan
     * 
     * @return int 
     * 
     */
    public function registerNewAccount($data)
    {
        $fullname = post("fullname");
        $jurusan = post("jurusan");
        $class = post("class");
        $username = post("username");
        $password = post("password");
        $conf_password = post("conf_password");

        setSavedValue(["fullname", "class", "username"], [$fullname, $class, $username]);

        if (isset($fullname) && $fullname !== '') {
            if (isset($jurusan) && $jurusan !== '') {
                if (isset($class) && $class !== '') {
                    if (isset($username) && $username !== '') {
                        if ($datauser = $this->getUserBy("username", $username)) {
                            setError("user_copy");
                            Ardent::redirect(BASE_URL . "auth/register");
                        } else {
                            if (isset($password) && $password !== '' || isset($conf_password) && $conf_password !== '') {
                                if ($password === $conf_password) {
                                    Ardent::unsetSession();
                                    $q = "INSERT INTO $this->tb VALUES('',:fullname,:username,:password,:jurusan,:kelas,:role)";
                                    $this->db->query($q);
                                    $this->db->bind("fullname", $fullname);
                                    $this->db->bind("username", $username);
                                    $this->db->bind("password", password_hash($password, PASSWORD_BCRYPT));
                                    $this->db->bind("jurusan", $jurusan);
                                    $this->db->bind("kelas", $class);
                                    $this->db->bind("role", 0);
                                    $this->db->execute();
                                    return $this->db->rowCount();
                                } else {
                                    setError("pass_error");
                                    Ardent::redirect(BASE_URL . "auth/register");
                                }
                            } else {
                                setError("pass_empty");
                                Ardent::redirect(BASE_URL . "auth/register");
                            }
                        }
                    } else {
                        setError("user_empty");
                        Ardent::redirect(BASE_URL . "auth/register");
                    }
                } else {
                    setError("class_empty");
                    Ardent::redirect(BASE_URL . "auth/register");
                }
            } else {
                setError("jurusan_empty");
                Ardent::redirect(BASE_URL . "auth/register");
            }
        } else {
            setError("name_empty");
            Ardent::redirect(BASE_URL . "auth/register");
        }
    }
}
