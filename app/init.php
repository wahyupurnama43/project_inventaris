<?php

// autoloading class didalam folder core
spl_autoload_register(function ($classname) {
    require_once "core/$classname.php";
});

// instansiasi class app
$app = new App();
