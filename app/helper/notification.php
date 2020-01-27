<?php

/**
 * 
 * notification.php
 * 
 * ini file digunakan untuk menload segala sesuatu yang berhubungan dengan notifikasi
 * 
 */


/**
 * 
 * setFlash($message, $type)
 * 
 * method ini untuk membuat sebuah flasher dari sebuah alert
 * 
 * @param String $message , menampung data message yang akan diload
 * @param String $type , menampung data type dari alert yang akan diload
 * 
 * @return String
 *
 */
function setFlash($message, $type)
{
    if (isset($message) && isset($type)) {
        $_SESSION['flasher'] = [
            "msg" => $message,
            "type" => $type
        ];
    } else {
        throw new Error("parameter can't be empty.");
    }
}
/**
 * 
 * flash()
 * 
 * method ini digunakan untuk menampilkan alert atau menampilkan flash
 * 
 */
function flash()
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
    } else {
        echo "";
    }
}
/**
 * 
 * makeNotification($msg)
 * 
 * method ini untuk menghasilkan sebuah notifikasi berupa banner
 * @param String $msg , menampung data message yang akan diload
 * 
 * @return mixed
 * 
 */
function makeNotification($msg)
{
    if (isset($msg) && $msg !== '') {
        $_SESSION['notification'] = [
            "msg" => $msg
        ];
    } else {
        throw new Error("parameter can't be empty.");
    }
}

/**
 * 
 * showNotification()
 * 
 * method ini menampilkan notifikasi dalam bentuk banner
 * 
 * @return mixed
 * 
 */
function showNotification()
{
    if (isset($_SESSION['notification'])) {
        $_SESSION['notification']['show'] = true;

        echo '
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 5px; right: 5px; z-index:99; min-width: 300px">
            <div class="toast-header">
                <div class="bg-primary rounded mr-2" style="width: 20px; height: 20px"></div>
                <strong class="mr-auto">System</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                ' . $_SESSION['notification']['msg'] . '
            </div>
        </div>
        ';
    } else {
        echo "";
    }
}
