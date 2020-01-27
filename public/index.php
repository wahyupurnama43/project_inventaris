<?php

/**
 * 
 * autoload.php
 * 
 * file ini merupakan file bawaan untuk autoload file di vendor jadi dibiarkan saja
 * 
 */
require_once "vendor/autoload.php";

/**
 * 
 * ENVIRONMENT
 * 
 * ini merupakan file atau sebuah library untuk memudahkan deklarasi data sehingga tidak perlu 
 * mengubah secara langsung kedalam folder inti
 * 
 * untuk mengubah konfigurasi bisa dicek file '.env'
 * 
 */

$dotenv = Dotenv\Dotenv::createImmutable("../");
$dotenv->load();

require_once "../app/init.php";
