<?php

class CoreController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getPDO();
    }

    protected function show($viewName, $viewData = [])
    {
        global $router;

        require_once __DIR__ . '/../Views/header.tpl.php';
        require_once __DIR__ . '/../Views/' . $viewName . '.php';
    }
}
