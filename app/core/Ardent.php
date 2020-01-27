<?php

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
                    throw new Error("this parameter can't be empty.");
                }
            } else {
                if ($cookiename !== '' && $cookievalue !== '' && $cookietime !== 0) {
                    setcookie($cookiename, $cookievalue, time() + $cookietime, "/");
                } else {
                    throw new Error("this parameter can't be empty.");
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
                        throw new Error("this parameter can't be empty.");
                    }
                }
            } else {
                if ($cookiename !== '') {
                    setcookie($cookiename, '', time() - time() * 2, "/");
                } else {
                    throw new Error("this parameter can't be empty.");
                }
            }
        }
    }
    /**
     * 
     * loadHelper($helpername)
     * 
     * method ini digunakan untuk meload helper dari folder helper
     * @param String|array $helpername , untuk menampung nama helper.
     * 
     * @return mixed
     * 
     */
    public static function loadHelper($helpername)
    {
        if (isset($helpername) && !empty($helpername) || $helpername !== '') {
            if (is_array($helpername)) {
                foreach ($helpername as $hn) {
                    if ($hn !== '') {
                        require_once "../app/helper/$hn.php";
                    } else {
                        throw new Error("this parameter can't be empty.");
                    }
                }
            } else {
                require_once "../app/helper/$helpername.php";
            }
        } else {
            throw new Error("this parameter can't be empty.");
        }
    }

    /**
     * 
     * loadSpesificViews($path)
     * 
     * method untuk menampilkan views dari dalam file
     * 
     * @param String $path , menampung data path
     * 
     * @return String
     * 
     */
    public static function loadSpesificViews($path, $params)
    {
        if (isset($path) && $path !== '') {
            require_once "../app/views/$path.php";
        }
    }

    /**
     * 
     * dd($data)
     * 
     * method ini digunakan untuk mendump sebuah data dan kemudian tidak menjalankan script
     * dibawahya
     * 
     * @param mixed $data , menampung data yang ingin ditampilkan
     * 
     * @return mixed
     * 
     */
    public static function dd($data)
    {
        var_dump($data);
        die();
        exit();
    }

    /**
     * 
     * redirect($url)
     * 
     * method ini digunakan untuk menredirect atau memaksa user berpindah kehalaman
     * yang diinginkan
     * 
     * @param String $path , menampung data path
     * 
     */
    public static function redirect($url)
    {
        header("Location: " . $url);
    }

    public static function setFlash($message, $type)
    {
        if (!session_id()) {
            session_start();
        }
        $_SESSION['flasher'] = [
            "msg" => $message,
            "type" => $type
        ];
    }
    public static function flash()
    {
        if (isset($_SESSION['flasher'])) {
            echo '
            <div class="alert alert-' . $_SESSION['flasher']['type'] . ' alert-dismissible fade show" role="alert">
                ' . $_SESSION['flasher']['msg'] . '.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
            unset($_SESSION['flasher']);
        }
    }
}
