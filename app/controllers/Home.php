<?php

use Inventaris\Core\Controller;

class Home extends Controller
{
    public function index()
    {
        $params['title'] = "Inventaris";
        $this->useViews(["templates.header", "index", "templates.footer"], $params);
    }
}
