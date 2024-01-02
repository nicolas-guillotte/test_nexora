<?php

class ErrorController extends CoreController
{
    public function error404()
    {
        http_response_code(404);
        
        $this->show('error404', [
            "pageTitle" => "Nexora - page non trouvée"
        ]);
    }
}