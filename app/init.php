<?php

use Inventaris\Core;
use Inventaris\Core\App as SystemApplication;


/**
 * 
 * spl_autoload_register($function)
 * 
 * method untuk memanggil class secara otomatis dari file yang dituju
 * 
 * @param mixed $function
 * 
 * @return mixed
 * 
 */

require_once "core/Config.php"; // memanggil file konfigurasi


spl_autoload_register(function ($classname) {
    $classname = explode("\\", $classname);
    $classname = end($classname);
    require_once "core/$classname.php";
});

// instansiasi class app
$app = new SystemApplication();

/**
 * 
 * autoload file helper
 * 
 * dengan menggunakan method dary SystemApplication()
 * @param String $url , url menuju path
 * 
 */
