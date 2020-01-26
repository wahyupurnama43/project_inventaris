<?php


/**
 * 
 * ini adalah controller default dari website ini
 * jika ingin menload controller lain maka bisa dikonfigurasi dari file Config.php
 * 
 * setiap controller harus extends ke Controller.php
 * 
 */

class Home extends Controller
{
    /**
     * 
     * method default atau page default yang akan diload pertama kali
     * penggunaan parameter $name adalah dengan memanggil url
     * 
     * http://localhost/project_inventaris/public/home/index/nama_mu
     * 
     */
    public function index($name = '')
    {
        $this->useViews("home.index");
        $this->useModel("Home_model")->sayHello($name);
    }
}
