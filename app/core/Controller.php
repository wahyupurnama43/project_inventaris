<?php

declare(strict_types=1);

/**
 * 
 * Controller.php
 * 
 * file ini digunakan untuk menyimpan method yang digunakan untuk menampilkan views 
 * ataupun memanggil sebuah model
 * 
 * file ini harus di inherit terhadap seluruh controller
 * 
 */

class Controller
{
    /**
     * 
     * useViews($path, $params)
     * 
     * method ini digunakan untuk menload atau menampilkan views
     * 
     * @param String|array $path , path to file bisa satu string atau multiple load
     * @param String|array|object $params , menyimpan parameter
     * 
     * @return mixed
     * 
     */
    public function useViews($path, array $params = [])
    {
        // path is required 
        if (isset($path) && !empty($params) || $path !== '') {
            // jika path adalah array
            if (is_array($path)) {
                // loop setiap views tersebut
                foreach ($path as $view) {
                    // jika mengandung char '.' maka akan direplace dengan '/'
                    if (strpos($view, ".")) {
                        require_once "../app/views/" . str_replace(".", "/", $view) . ".php";
                    } else {
                        require_once "../app/views/$view.php";
                    }
                }
            } else {
                // jika bukan array maka load seperti biasa
                require_once "../app/views/$path.php";
            }
        } else {
            throw new Error("Path can't be empty");
        }
    }
    /**
     * 
     * useModel($path)
     * 
     * method ini digunakkan untuk  menload model
     * 
     * @param String $path , path to file
     * 
     * @return Object|mixed class 
     * 
     */
    public function useModel($path)
    {
        if (isset($path) && !empty($path) || $path !== '') {
            // cek jika path mengandung titik
            if (strpos($path, ".")) {
                require_once "../app/models/" . str_replace(".", "/", $path) . ".php";
                // mengembalikan instansiasi dari model
                return new $path;
            } else {
                require_once "../app/models/$path.php";
                // mengembalikan instansiasi dari model
                return new $path;
            }
        }
    }
}
