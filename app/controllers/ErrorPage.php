<?php

use Inventaris\Core\Controller;

class ErrorPage extends Controller
{
    public function notfound()
    {
        $params['title'] = $_ENV['APP_NAME'] . " - Not Found";
        $this->useViews(["templates.error.header", "error.notfound", "templates.error.footer"], $params);
    }
    public function forbidden()
    {
        $params['title'] = $_ENV['APP_NAME'] . "- Forbidden";
        $this->useViews(["templates.error.header", "error.forbidden", "templates.error.footer"], $params);
    }
}
