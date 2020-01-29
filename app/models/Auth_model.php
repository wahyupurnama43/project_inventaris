<?php

use Inventaris\Core\Ardent;
use Inventaris\Core\Database;

class Auth_model
{
    private $tb = "tb_user";
    private $db;
    private $url;

    public function __construct()
    {
        $this->db = new Database();
        $url = (int) $_COOKIE['role'] === 0 ? "user" : (int) $_COOKIE['role'] === 1 ? "petugas" : "admin";
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
     * updateProfile
     * 
     * method ini digunakan untuk mengupdate profile
     * 
     * @return int 
     * 
     */
    public function updateProfile()
    {
        $id = post('id');
        $fullname = post("fullname");
        $gender = post("gender");
        $jurusan = post("jurusan");
        $kelas = post("kelas");
        $username = post('username');

        // validation
        if (isset($fullname) && $fullname !== '') {
            if (isset($gender) && $gender !== '') {
                if (isset($jurusan) && $jurusan !== '') {
                    if (isset($kelas) && $kelas !== '') {
                        if (isset($username) && $username !== '') {
                            $q = "UPDATE $this->tb SET nama_user=:fullname,jurusan_user=:jurusan,kelas_user=:class,jenis_kelamin=:gender,username=:username WHERE id_user=:id";
                            $this->db->query($q);
                            $this->db->bind("id", $id);
                            $this->db->bind("fullname", $fullname);
                            $this->db->bind("jurusan", $jurusan);
                            $this->db->bind("class", $kelas);
                            $this->db->bind("gender", $gender);
                            $this->db->bind("username", $username);
                            $this->db->execute();
                            return $this->db->rowCount();
                        } else {
                            setError("user_empty");
                            Ardent::redirect(BASE_URL . $this->url . "editprofile");
                        }
                    } else {
                        setError("class_empty");
                        Ardent::redirect(BASE_URL . $this->url . "editprofile");
                    }
                } else {
                    setError("jurusan_empty");
                    Ardent::redirect(BASE_URL . $this->url . "editprofile");
                }
            } else {
                setError("gender_empty");
                Ardent::redirect(BASE_URL . $this->url . "editprofile");
            }
        } else {
            setError("name_empty");
            Ardent::redirect(BASE_URL . $this->url . "editprofile");
        }
    }

    /**
     * 
     * updatePassword()
     * 
     * method ini digunakan untuk mengupdate password user
     * 
     * @return int
     * 
     */
    public function updatePassword()
    {
        $id = post('id');
        $old_password = post("password_lama");
        $new_password = post("password_baru");
        $con_password = post("konfirmasi_password");

        $data_user_pass = $this->getUserBy("id_user", $id)['password'];

        if (isset($old_password) && $old_password !== '') {
            if (password_verify($old_password, $data_user_pass)) {
                if (isset($new_password) && $new_password !== '') {
                    if (isset($con_password) && $con_password !== '') {
                        if ($new_password === $con_password) {
                            $q = "UPDATE $this->tb SET password=:password WHERE id_user=:id";
                            $this->db->query($q);
                            $this->db->bind('password', password_hash($new_password, PASSWORD_BCRYPT));
                            $this->db->bind("id", $id);
                            $this->db->execute();
                            return $this->db->rowCount();
                        }
                    }
                }
            }
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
    public function login()
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
    public function registerNewAccount()
    {
        $fullname = post("fullname");
        $gender = post("gender");
        $jurusan = post("jurusan");
        $class = post("class");
        $username = post("username");
        $password = post("password");
        $conf_password = post("conf_password");

        setSavedValue(["fullname", "class", "username"], [$fullname, $class, $username]);

        if (isset($fullname) && $fullname !== '') {
            if (isset($gender) && $gender !== '') {
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
                                        $q = "INSERT INTO $this->tb VALUES('',:fullname,:gender,:username,:password,:jurusan,:kelas,:role)";
                                        $this->db->query($q);
                                        $this->db->bind("fullname", $fullname);
                                        $this->db->bind("gender", $gender);
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
                setError("gender_empty");
                Ardent::redirect(BASE_URL . "auth/register");
            }
        } else {
            setError("name_empty");
            Ardent::redirect(BASE_URL . "auth/register");
        }
    }
}
