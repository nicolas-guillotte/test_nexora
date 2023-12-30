<?php

class ChatController extends CoreController
{

    public function chat($params)
    {
        // $params contient les paramètres envoyés dans l'URL (donc l'ID de l'expéditeur)
        // on récupère l'ID de l'expéditeur
        $sender_id = $params["id"];

        $messageModel = new Message();
        $messages = $messageModel->getMessagesBySenderId($sender_id);

        $userModel = new User();
        $user = $userModel->find($sender_id); // Note: Vous devrez peut-être ajuster cette ligne en fonction de la structure de votre base de données

        // on affiche la vue en lui envoyant les messages et l'utilisateur
        $this->show('chat', [
            "pageTitle" => "Nexora - Discussion",
            "messages" => $messages,
            "user" => $user,
        ]);
    }

}