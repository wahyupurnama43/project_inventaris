<?php

/**
 * 
 * file helper untuk validasi form
 * 
 */

/**
 * 
 * post($name)
 * 
 * method ini untuk mengambil data dari $_POST
 * @param String $name , menampung nama
 * 
 * @return mixed
 * 
 */
function post($name)
{
    if (isset($name) && $name !== '') {
        return htmlspecialchars($_POST[$name]);
    } else {
        throw new Error("parameter can't be empty.");
    }
}

/**
 * 
 * setError($err_code)
 * 
 * method ini untuk menampilkan error berdasarkan error code
 * 
 * @param int $err_code , menampung data kode error yang digunakan untuk menampilkan error
 * 
 * @return String
 * 
 */
function setError($err_code)
{
    if (isset($err_code)) {
        $_SESSION['err'] = [
            "is_error" => true
        ];
        switch ((int) $err_code) {
            case 1:
                return $_SESSION['err'] = [
                    "msg" => "Username not found in out database."
                ];
                break;
            case 2:
                return $_SESSION['err'] = [
                    "msg" => "This field can't be empty."
                ];
                break;
            case 3:
                return $_SESSION['err'] = [
                    "msg" => "Password is not matching."
                ];
                break;
            default:
                return null;
                break;
        }
    }
}

/**
 * 
 * showError()
 * 
 * method ini digunakan untuk menampilkan error jika ada error yang di set
 * 
 * @return mixed
 * 
 */
function showError()
{
    if (isset($_SESSION['err'])) {
        return '
        <small class="text-danger">' . $_SESSION['err']['msg'] . '</small>
        ';
        unset($_SESSION['err']);
    } else {
        throw new Error("Session is not setted yet.");
    }
}

/**
 * 
 * required($variable)
 * 
 * method ini digunakan untuk menandakan sebuah variable itu diperlukan
 * 
 * @param mixed $variable , untuk menampung data yang ingin divalidasi
 * 
 * @return boolean
 * 
 */
function required($variable)
{
    if (isset($variable) || $variable !== '' || !empty($variable)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 
 * min_length($variable, $len)
 * 
 * method ini digunakan untuk memvalidasi panjang rendah dari sebuah variable
 * 
 * @param String $variable , menampung data yang ingin divalidasi
 * @param int $len , menampung seberapa panjang yang ingin dicapai
 * 
 * @return boolean
 * 
 */
function min_length($variable, int $len)
{
    if (isset($variable)) {
        if (strlen($variable) > (int) $len) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * 
 * valid_email($variable)
 * 
 * method ini digunakan untuk memvalidasi email
 * 
 * @param String $variable , untuk menampung email pengguna
 * 
 * @return boolean
 * 
 */
function valid_email($variable)
{
    if (isset($variable)) {
        if (strpos($variable, "@")) {
            return true;
        } else {
            return false;
        }
    }
}
