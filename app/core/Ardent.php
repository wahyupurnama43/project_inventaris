<?php

declare(strict_types=1);

namespace Inventaris\Core;

/**
 * 
 * Ardent.php
 * 
 * class ini digunakan untuk menyimpan helper yang digunakan untuk memudah kan programmer membuat
 * sesuatu
 * 
 */

class Ardent
{
    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }
    }

    /**
     * 
     * unsetSession()
     * 
     * method ini digunakan untuk mengunset atau meniadakan seluruh session
     * 
     */
    public static function unsetSession()
    {
        session_destroy();
        session_unset();
        $_SESSION = [];
    }

    /**
     * 
     * makeCookies($cookiename, $cookievalue, $cookietime)
     * 
     * method ini digunakan untuk membuat cookie baik itu hanya satu ataupun multiple
     * cookie
     * 
     * @param array|String $cookiename , untuk menampung nama dari cookie
     * @param mixed $cookievalue , untuk menampung value dari cookie
     * @param int $cookietime , untuk menampung batas waktu expired sebuah cookie
     * 
     * @return mixed , mengembalikan cookie
     * 
     */
    public static function makeCookies($cookiename = '', $cookievalue = '', int $cookietime = 0)
    {
        if (isset($cookiename) && isset($cookievalue) && isset($cookietime)) {
            // apabila merupakan sebuah type data array
            if (is_array($cookiename) && is_array($cookievalue)) {
                // apabila tidak merupakan array kosong
                if (!empty($cookiename) && !empty($cookievalue) && $cookietime !== 0) {
                    // looping dari array
                    for ($count = 0; $count < count($cookiename); $count++) {
                        setcookie($cookiename[$count], $cookievalue[$count], time() + $cookietime, "/");
                    }
                } else {
                    throw new \Error("this parameter can't be empty.");
                }
            } else {
                if ($cookiename !== '' && $cookievalue !== '' && $cookietime !== 0) {
                    setcookie($cookiename, $cookievalue, time() + $cookietime, "/");
                } else {
                    throw new \Error("this parameter can't be empty.");
                }
            }
        }
    }

    /**
     * 
     * destroyCookies($cookiename)
     * 
     * method ini digunakan untuk meng-unset cookie
     * @param array|String $cookiename , untuk menampung nama cookie dapat berupa string atau array
     * 
     */
    public static function destroyCookies($cookiename)
    {
        if (isset($cookiename)) {
            // apabila cookiename adalah tipe data array
            if (is_array($cookiename)) {
                foreach ($cookiename as $cn) {
                    if ($cn !== '') {
                        setcookie($cn, '', time() - time() * 2, "/");
                    } else {
                        throw new \Error("this parameter can't be empty.");
                    }
                }
            } else {
                if ($cookiename !== '') {
                    setcookie($cookiename, '', time() - time() * 2, "/");
                } else {
                    throw new \Error("this parameter can't be empty.");
                }
            }
        }
    }
}
