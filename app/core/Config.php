<?php

/**
 * 
 * Config.php
 * 
 * gunakan file ini untuk mensetting data default untuk menjalankan website ini
 * 
 */

/**
 * 
 * PAGE CONFIGURATION
 * 
 * dibawah ini adalah konfigurasi untuk website ini
 * 
 */

/**
 * 
 * BASE_URL
 * 
 * variable ini digunakan untuk menyimpan base url atau url default, rubahlah dan
 * sesuaikan dengan url localhost mu, defaultnya adalah 'http://localhost/project_inventaris/public/'
 * 
 */
define('BASE_URL', isset($_ENV["BASE_URL"]) ? $_ENV["BASE_URL"] : "");


/**
 * 
 * DEFAULT_HOMEPAGE
 * 
 * default page yang diload pertama kali atau jika url yang ditulis tidak memiliki kecocokan dengan
 * controller atau method yang ada. Defaultnya adalah 'home', ubahlah sesuai dengan controller yang
 * ingin kalian load
 * 
 */
define('DEFAULT_HOMEPAGE', isset($_ENV["DEFAULT_HOMEPAGE"]) ? $_ENV["DEFAULT_HOMEPAGE"] : "");

/**
 * 
 * DATABASE CONFIGURATION
 * 
 * dibawah ini berisi konfigurasi database, jika database kalian tidak sama dengan default database
 * yang disediakan, kalian bisa mengganti nama atau data-data dibawah ini sesuai dengan data dari
 * database kalian
 * 
 * didalam folder ini sudah disediakan default database berupa file sql yang bernama db_inventaris.sql
 * jika ingin menggunakan nya bisa kalian import ke dalam sql_server atau DBMS kalian
 * 
 */

/**
 * 
 * DB_HOST
 * 
 * deklarasi konstanta untuk menyimpan nama host, default adalah 'localhost'
 * 
 */
define('DB_HOST', isset($_ENV["DB_HOST"]) ? $_ENV["DB_HOST"] : "");

/**
 * 
 * DB_USER
 * 
 * deklarasi konstanta untuk menyimpan nama user, default adalah 'root'
 * 
 */
define('DB_USER', isset($_ENV["DB_USER"]) ? $_ENV["DB_USER"] : "");

/**
 * 
 * DB_PASS
 * 
 * deklarasi untuk menyimpan password dari sql_server, default adalah '' (string kosong)
 * 
 */
define('DB_PASS', isset($_ENV["DB_PASS"]) ? $_ENV["DB_PASS"] : "");

/**
 * 
 * DB_NAME
 * 
 * deklarasi untuk menyimpan nama database yang akan digunakan, default adalah 'db_inventaris'
 * 
 */
define('DB_NAME', isset($_ENV["DB_NAME"]) ? $_ENV["DB_NAME"] : "");

/**
 * 
 * DB_CHARSET
 * 
 * deklarasi untuk menyimpan charset, default nya adalah 'utf8mb4'
 * 
 */
define('CHARSET', isset($_ENV["CHARSET"]) ? $_ENV["CHARSET"] : "");
