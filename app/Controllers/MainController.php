<?php

class MainController extends CoreController
{
    public function home()
    {
        // on a besoin de la liste des utilisateurs
        $userModel = new User();
        $users = $userModel->findAll();

        // on appelle la méthode show pour afficher notre vue
        $this->show('home', [
            "pageTitle" => "Nexora - Accueil",
            "users" => $users
        ]);
    }

    public function test()
    {
        $messageModel = new Message();
        $messages = $messageModel->findAll();
        dump($messages);

        // on peut également tester les autres modèles :
        $userModel = new User();
        $users = $userModel->findAll();
        dump($users);
    }
}