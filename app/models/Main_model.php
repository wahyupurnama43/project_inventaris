<?php

use Inventaris\Core\Ardent;
use Inventaris\Core\Database;

class Main_model
{
    private $tbJurusan = "tb_jurusan";
    private $tbMenu = "tb_menu";

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
}
