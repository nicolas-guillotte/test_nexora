<?php

class CoreController
{
    protected $db;

    public function __construct()
    {
        // Utilisez la méthode statique pour obtenir la connexion à la base de données
        $this->db = Database::getPDO();
    }

    protected function show($viewName, $viewData = [])
    {
        // pour avoir accès à notre $router à l'intérieur de nos vue, on peut utiliser une variable globale
        global $router;

        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../Views/header.tpl.php';
        require_once __DIR__ . '/../Views/' . $viewName . '.php';
        require_once __DIR__ . '/../Views/footer.tpl.php';
    }
}
