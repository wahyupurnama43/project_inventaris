<?php

use Inventaris\Core;
use Inventaris\Core\App as SystemApplication;
use Inventaris\Core\Ardent;

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

/**
 * 
 * LIBRARY LOADER
 * 
 */

if (is_array(LIBRARY)) {
    foreach (LIBRARY as $lib) {
        Ardent::loadHelper($lib);
    }
}

// instansiasi class app
$app = new SystemApplication();
