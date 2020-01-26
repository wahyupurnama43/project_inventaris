<?php

namespace Inventaris\Core;

/**
 * 
 * file inti aplikasi yang merupakan core dari aplikasi, disini digunakan untuk menjalankan
 * controller dan method berdasarkan url
 * 
 */

class App
{
    /**
     * 
     * Deklarasi variable controller, method, dan parameter default
     * 
     * @param String $controller, type data controller harus bernilai string
     * @param String $method, type data method harus bernilai string. Default adalah 'index'
     * @param array $params, type data params bernilai array karena akan menampung banyak value
     * 
     */
    private $controller = DEFAULT_HOMEPAGE, $method = "index", $params = [];

    public function __construct()
    {
        $url = $this->parseURL(); // diambil dari method pemecah url

        /**
         * 
         * Memanggil controller
         * 
         * dibawah ini merupakan teknik memecah url dan mengambil datanya untuk digunakan
         * dalam memanggil controller. Jika url kosong maka controller default akan
         * dipanggil
         * 
         */
        if (isset($url[0])) {
            /**
             * 
             * file_exists($path)
             * 
             * mengecek eksistensi file berdasarkan path
             * @param String $path, type data path berupa string yang merujuk pada file yg dituju
             * 
             */
            if (file_exists("../app/controllers/" . $url[0] . ".php")) {
                $this->controller = $url[0]; // redeclare default controller dengan url[0]
                unset($url[0]); // menghilangkan url[0] setelah menredeclare default controller
            }
        }
        require_once "../app/controllers/$this->controller.php"; // memanggil file controller
        $this->controller = new $this->controller; // instansiasi controller

        /**
         * 
         * Memanggil method
         * 
         * dibawah ini merupakan cara untuk mengecek method dari controller/class yang dipanggil
         * apabila ada, maka redeclare default method. Jika tidak maka akan digunakan method default
         * yaitu 'index'
         * 
         */
        if (isset($url[1])) {
            /**
             * 
             * method_exist($object, $method)
             * 
             * @param Object|Class $object, type data harus berupa instansiasi class/object
             * @param String $method, type data harus string
             * @return boolean , mengembalikan nilai berupa boolean
             * 
             */
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        /**
         * 
         * Menyimpan parameter
         * 
         * jika url masih memiliki value atau url tidak kosong maka gunakan value tersebut
         * untuk digunakan sebagai data parameter, jika kosong maka parameter akan diset sebagai
         * array kosong
         * 
         */
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        /**
         * 
         * call_user_func_array($callback, $parameter)
         * 
         * method built in php untuk membuat satuan array menjadi parameter sebuah function
         * @param callable|array|String $callback, dapat berupa array atau pun string
         * @param array $parameter, type data array untuk dijadikan parameter dari sebuah function
         * @return mixed , mengembalikan nilai dari function / callback yang dipanggil
         * 
         */
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * 
     * function parseURL()
     * 
     * method ini digunakan untuk mengambil url, dan memecahnya menjadi array
     * @return array $url, method ini mengembalikan nilai array
     * 
     */
    public function parseURL()
    {
        // cek $_GET['url]
        if (isset($_GET['url'])) {
            // menghilangkan spasi dibelakang url
            $url = rtrim($_GET['url']);
            // mencegah memasukkan string yang tidak semestinya
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // memecah url kedalam bentuk array
            $url = explode('/', $url);
            return $url;
        }
    }
}
