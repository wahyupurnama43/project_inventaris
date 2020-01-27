<?php

use Inventaris\Core\Controller;

class Home extends Controller
{
    public function index()
    {
        setFlash("halo ini amerta", "danger");
        makeNotification("halo ini amerta");
        $params['title'] = "Inventaris";
        $this->useViews(["templates.header", "index", "templates.footer"], $params);
    }
}
