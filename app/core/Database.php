<?php

/**
 * 
 * Database.php
 * 
 * didalam file ini akan digunakan untuk menjalankan Server Side atau menghubungkan website
 * dengan database | sql_server. Data-data dari database bisa dikonfigurasi dari file Config.php
 * 
 * disini akan menggunakan teknik PDO (PHP Data Object) untuk koneksi dengan database
 * jika tidak mengerti bisa cek url dibawah
 * 
 * https://www.duniailkom.com/tutorial-php-mysql-pengertian-pdo-dan-cara-mengaktifkan-pdo-php-data-objects/
 * 
 */

class Database
{
    /**
     * 
     * Deklarasi data default berdasarkan file Config php
     * 
     * @param String $dbHost, menyimpan data host sql server / DBMS
     * @param String $dbUser, menyimpan data user sql server / DBMS
     * @param String $dbPass, menyimpan password sql server / DBMS
     * @param String $dbName, menyimpan nama database kalian
     * @param String $charset, menyimpan character set sql server / DBMS
     * 
     */
    private $dbHost = DB_HOST, $dbUser = DB_USER, $dbPass = DB_PASS, $dbName = DB_NAME, $charset = CHARSET;

    private $dbh, $stmt;

    public function __construct()
    {
        /**
         * 
         * @param String $dsn, menyimpan data source name
         * 
         * Data Source Name adalah string yang memiliki struktur data terkait yang digunakan untuk 
         * menggambarkan koneksi ke sumber data
         * 
         */
        $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=$this->charset";
        /**
         * 
         * @param array $opts, menyimpan konfigurasi PDO
         * 
         */
        $opts = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            /**
             * 
             * PDO($dsn, $user, $pass, $options)
             * 
             * @param String $dsn, data source dari database
             * @param String $user, data nama user dari database
             * @param String $pass, data password dari database
             * @param array $options, data konfigurasi PDO
             * 
             * @return mixed connection
             * 
             */
            $this->dbh = new PDO($dsn, $this->dbUser, $this->dbPass, $opts);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * 
     * query($query)
     * 
     * method ini digunakan untuk menjalankan query dari user kedalam database
     * 
     * @param String $query, menyimpan query yang akan dijalankan
     * 
     */
    public function query($query)
    {
        /**
         * 
         * prepare($query)
         * 
         * method dari PDO untuk mempersiapkan query untuk dieksekusi
         * 
         * @param String $query
         * 
         */
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * 
     * bind($param, $value, $type)
     * 
     * method untuk mensterilisasi data yang akan dikirim
     * 
     * @param String $param , untuk menyimpan nama dari value
     * @param mixed $value , untuk menyimpan value
     * @param mixed $type , menyimpan type value. Default adalah 'null'
     * 
     * @return mixed value yang akan diquery
     * 
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * 
     * execute()
     * 
     * method ini digunakan untuk eksekusi query ke database
     * 
     */
    public function execute()
    {
        $this->stmt->execute();
    }

    /**
     * 
     * getAllData()
     * 
     * method ini  digunakan untuk memfetch atau mengambil data dan mengembalikan sebuah array
     * dari hasil query kedatabase
     * 
     * digunakan untuk  mengquerykan data yang lebih dari satu data
     * 
     * @return array 
     * 
     */
    public function getAllData()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * getData()
     * 
     * method ini juga digunakan untuk memfetch atau mengambil data dan mengembalikan array
     * dari hasil query database
     * 
     * digunakan untuk mengquery kan satu data atau spesifik data
     * 
     * @return array
     * 
     */
    public function getData()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * rowCount()
     * 
     * method ini mengembalikan integer dimana method ini digunakan untuk mengetahui apabila
     * data dalam database ada yang terpengaruh atau tidak
     * 
     * @return int , mengembalikan nilai 1 atau -1 mungkin juga 0
     * 
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
