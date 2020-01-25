<?php

class App
{
    public function __construct()
    {
        $url = $this->parseURL();
        var_dump($url);
    }

    // method untuk memecah URL
    public function parseURL()
    {
        // cek $_GET['url]
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url']);
            // mencegah memasukkan string yang tidak semestinya
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // memecah url kedalam bentuk array
            $url = explode('/', $url);
            return $url;
        }
    }
}
