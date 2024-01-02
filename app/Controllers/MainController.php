<?php

class MainController extends CoreController
{
    public function home()
    {
        $userModel = new User();
        $users = $userModel->findAll();

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

        $userModel = new User();
        $users = $userModel->findAll();
        dump($users);
    }
}