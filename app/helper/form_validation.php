<?php

/**
 * 
 * file helper untuk validasi form
 * 
 */

function sayHello()
{
    echo "Hello say helo";
}

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
        return $_POST[$name];
    } else {
        throw new Error("parameter can't be empty.");
    }
}
