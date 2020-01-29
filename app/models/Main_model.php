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
}
