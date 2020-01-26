<?php

/**
 * 
 * ini adalah contoh model , bisa dihapus nanti
 * 
 */

class Home_model
{

    /**
     * 
     * model ini digunakan untuk berkomunikasi dengan database
     * 
     * @param String $tb_[tbName] , nama tb bisa disimpan dengan format tb_[nama table]
     * 
     */

    private $db;

    public function __construct()
    {
        /**
         * 
         * new Database() 
         * 
         * merupakan instansiasi dari file Database.php
         * digunakan untuk mengambil fungsi fungsi koneksi ke database
         * setiap file model harus menginstansiasi file Database ini
         * 
         */
        $this->db = new Database();
    }

    //  contoh method
    public function sayHello($name)
    {
        $str = "hello there ";
        $str .= $name !== '' ? $name : "user";
        $str .= "!";
        echo $str;
    }
}
