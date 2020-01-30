<?php

use Inventaris\Core\Ardent;
use Inventaris\Core\Database;

class Main_model
{
    private $tbJurusan = "tb_jurusan";
    private $tbMenu = "tb_menu";
    private $tbUser = "tb_user";

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * 
     * getJurusan
     * 
     * ini untuk mengquery jurusan, atau mendapatkan data jurusan
     * 
     * @return String jurusan
     * 
     */
    public function getJurusan()
    {
        $q = "SELECT * FROM $this->tbJurusan";
        $this->db->query($q);
        return $this->db->getAllData();
    }

    public function getJurusanAndKepJur()
    {
        $q = "SELECT * FROM $this->tbJurusan INNER JOIN $this->tbUser ON $this->tbJurusan.kode_jurusan=$this->tbUser.kelas_user";
        $this->db->query($q);
        return $this->db->getAllData();
    }

    public function getKepalaJurusan()
    {
        $q = "SELECT * FROM $this->tbUser WHERE role_user=:role";
        $this->db->query($q);
        $this->db->bind("role", 1);
        return $this->db->getAllData();
    }

    public function addNewMajor()
    {
        $major_name = post("major_name");
        $major_code = post("major_code");
        $major_head = post("major_head");
        $id_jurusan = uniqid("j-");

        $is_go = false;
        $url = (int) $_COOKIE['role'] === 0 ? "user" : (int) $_COOKIE['role'] === 1 ? "petugas" : "admin";

        if ($major_name != null && $major_name !== '') {
            $is_go = true;
        } else {
            setError("major_name_empty");
            Ardent::redirect(BASE_URL . $url . "/major/addnewmajor");
        }

        if ($major_code != null && $major_code !== '') {
            $is_go = true;
        } else {
            setError("major_code_empty");
            Ardent::redirect(BASE_URL . $url . "/major/addnewmajor");
        }

        if ($major_head != null && $major_head !== '') {
            $is_go = true;
        } else {
            setError("major_head_empty");
            Ardent::redirect(BASE_URL . $url . "/major/addnewmajor");
        }

        if ($is_go) {
            $q = "INSERT INTO $this->tbJurusan VALUES(:id,:major_name,:major_code,:major_head)";

            $this->db->query($q);
            $this->db->bind("id", $id_jurusan);
            $this->db->bind("major_name", $major_name);
            $this->db->bind("major_code", $major_code);
            $this->db->bind("major_head", $major_head);
            $this->db->execute();
            return $this->db->rowCount();
        }

        return -1;
    }

    /**
     * 
     * getMenu($role = '')
     * 
     * method ini untuk query menu berdasarkan rolenya
     * 
     * @param String $role , menampung data role. Apabila kosong maka ambil semuanya
     * 
     * @return mixed menu
     * 
     */
    public function getMenu($role = '')
    {
        $q = "SELECT * FROM $this->tbMenu ORDER BY id_menu ASC";
        $this->db->query($q);
        $dataMenu = $this->db->getAllData();

        $resMenu = [];
        foreach ($dataMenu as $menu) {
            if (isset($role) && $role !== '') {
                if (strpos($menu['role_menu'], "|")) {
                    $menu_role = explode("|", $menu['role_menu']);
                    if (in_array($role, $menu_role)) {
                        $resMenu[] = $menu;
                    }
                } else {
                    if ($menu['role_menu'] == $role) {
                        $resMenu[] = $menu;
                    }
                }
            } else {
                $resMenu[] = $menu;
            }
        }
        return $resMenu;
    }

    public function getMenuById($id)
    {
        if ($id !== '') {
            $q = "SELECT * FROM $this->tbMenu WHERE id_menu=:id";
            $this->db->query($q);
            $this->db->bind("id", $id);
            $this->db->execute();
            return $this->db->getData();
        } else {
            return null;
        }
    }

    /**
     * 
     * addNewMenu()
     * 
     * method ini adalah method untuk memnambah sebuah menu baru
     * 
     * @return int
     * 
     */
    public function addNewMenu()
    {
        $menu_name = post("menu_name");
        $menu_link = post("menu_link");
        $menu_icon = post("menu_icon");
        $user_acc = post("access_user");
        $petugas_acc = post("access_petugas");
        $admin_acc = post("access_admin");
        $access = [];
        $url = (int) $_COOKIE['role'] === 0 ? "user" : (int) $_COOKIE['role'] === 1 ? "petugas" : "admin";
        $is_go = false;

        if ($user_acc !== null) {
            $access[] = "0";
        }
        if ($petugas_acc !== null) {
            $access[] = "1";
        }
        if ($admin_acc !== null) {
            $access[] = "2";
        }
        if ($user_acc == null && $petugas_acc == null && $admin_acc == null) {
            setError("menu_access_empty");
            Ardent::redirect(BASE_URL . $url . "/menu/addnewmenu");
        }

        $access = implode("|", $access);

        if ($menu_name != null && $menu_name !== '') {
            $is_go = true;
        } else {
            setError("menu_name_empty");
            Ardent::redirect(BASE_URL . $url . "/menu/addnewmenu");
        }
        if ($menu_link != null && $menu_link !== '') {
            $is_go = true;
        } else {
            setError("menu_link_empty");
            Ardent::redirect(BASE_URL . $url . "/menu/addnewmenu");
        }
        if ($menu_icon != null && $menu_icon !== '') {
            $is_go = true;
        } else {
            setError("menu_icon_empty");
            Ardent::redirect(BASE_URL . $url . "/menu/addnewmenu");
        }

        if ($is_go) {
            $q = "INSERT INTO $this->tbMenu VALUES('',:menu_name,:menu_link,:menu_icon,:access)";
            $this->db->query($q);
            $this->db->bind("menu_name", $menu_name);
            $this->db->bind("menu_link", $menu_link);
            $this->db->bind("menu_icon", $menu_icon);
            $this->db->bind("access", $access);
            $this->db->execute();
            return $this->db->rowCount();
        }

        return false;
    }

    /**
     * 
     * deleteMenu($id)
     * 
     * method ini digunakan untuk menghapus sebuah menu
     * 
     * @param String $id , menampung id verifikator untuk menghapus sebuah menu
     * 
     * @return int 
     * 
     */
    public function deleteMenu($id)
    {
        if ($id !== '') {
            $q = "DELETE FROM $this->tbMenu WHERE id_menu=:id";
            $this->db->query($q);
            $this->db->bind("id", $id);
            $this->db->execute();
            return $this->db->rowCount();
        } else {
            return -1;
        }
    }

    public function updateMenu($id)
    {
        if ($id !== '') {
            $menu_name = post("menu_name");
            $menu_link = post("menu_link");
            $menu_icon = post("menu_icon");
            $user_acc = post("access_user");
            $petugas_acc = post("access_petugas");
            $admin_acc = post("access_admin");
            $access = [];
            $url = (int) $_COOKIE['role'] === 0 ? "user" : (int) $_COOKIE['role'] === 1 ? "petugas" : "admin";
            $is_go = false;

            if ($user_acc !== null) {
                $access[] = "0";
            }
            if ($petugas_acc !== null) {
                $access[] = "1";
            }
            if ($admin_acc !== null) {
                $access[] = "2";
            }
            if ($user_acc == null && $petugas_acc == null && $admin_acc == null) {
                setError("menu_access_empty");
                Ardent::redirect(BASE_URL . $url . "/menu/addnewmenu");
            }

            $access = implode("|", $access);

            if ($menu_name != null && $menu_name !== '') {
                $is_go = true;
            } else {
                setError("menu_name_empty");
                Ardent::redirect(BASE_URL . $url . "/menu/addnewmenu");
            }
            if ($menu_link != null && $menu_link !== '') {
                $is_go = true;
            } else {
                setError("menu_link_empty");
                Ardent::redirect(BASE_URL . $url . "/menu/addnewmenu");
            }
            if ($menu_icon != null && $menu_icon !== '') {
                $is_go = true;
            } else {
                setError("menu_icon_empty");
                Ardent::redirect(BASE_URL . $url . "/menu/addnewmenu");
            }

            if ($is_go) {
                $q = "UPDATE $this->tbMenu SET nama_menu=:menu_name,link_menu=:menu_link,icon_menu=:menu_icon,role_menu=:access WHERE id_menu=:id";
                $this->db->query($q);
                $this->db->bind("id", $id);
                $this->db->bind("menu_name", $menu_name);
                $this->db->bind("menu_link", $menu_link);
                $this->db->bind("menu_icon", $menu_icon);
                $this->db->bind("access", $access);
                $this->db->execute();
                return $this->db->rowCount();
            }
        } else {
            return -1;
        }
    }

    /**
     * 
     * getStudents()
     * 
     * method ini digunakan untuk mengambil data siswa
     * 
     * @return mixed
     * 
     */
    public function getStudents()
    {
        $q = "SELECT * FROM $this->tbUser WHERE role_user=:role";
        $this->db->query($q);
        $this->db->bind("role", "0");
        return $this->db->getAllData();
    }

    /**
     * 
     * getDetailStudent()
     * 
     * method ini digunakan untuk mengambil data siswa secara spesifik
     * 
     * @return mixed
     * 
     */
    public function getDetailStudent($id)
    {
        $q = "SELECT * FROM $this->tbUser WHERE id_user=:id";
        $this->db->query($q);
        $this->db->bind("id", $id);
        return $this->db->getData();
    }
}
