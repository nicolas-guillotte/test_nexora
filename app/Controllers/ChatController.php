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

    public function insert($params)
    {
        global $router;

        $receiver_id = $params["id"];
        $userModel = new User();
        $user = $userModel->find($receiver_id);

        $receiver_id = $user->getId();
        $sender_id = $_SESSION['user_id'];
        $text = filter_input(INPUT_POST, 'message');

        $errorList = [];

        // on créé un nouvel objet Post
        $message = new Message();

        // on alimente cet objet (on remplit ses propriétés)
        // avec les données potentiellement erronées
        $message->setSender_id($sender_id);
        $message->setReceiver_id($receiver_id);
        $message->setText($text);

        // on vérifie si on a rencontré une erreur
        if(empty($errorList)) {
            // si le tableau errorList est vide, ça veut dire qu'il n'y a pas d'erreur
            // donc on peut ajouter à la DB !

            // on dit à cet objet de s'insérer dans la base !
            // insert() renvoit true si l'ajout a fonctionné, false sinon
            //$success = $post->insert();
            $success = $message->insert();

            if($success) {
                // Redirection vers la page de discussion
                $chatUrl = $router->generate('chat', ['id' => $user->getId()]);
                $absoluteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $chatUrl;
                header('Location: ' . $absoluteUrl);
                exit;
            } else {
                // ça n'a pas fonctionné, on met un message d'erreur.
                $errorList[] = "Erreur lors de l'ajout.";
            }

        }

        // si on arrive là, c'est qu'il y a eu une erreur
        // on réaffiche le formulaire, mais pré-rempli avec les (mauvaises) données saisies

        // on affiche à nouveau de form d'ajout, mais avec les erreurs & les données erronées
        $this->show('chat', [
            "pageTitle" => "Nexora - Discussion",
            "messages" => $messages,
            "user" => $user,
        ], $router->generate('chat', ['id' => $sender_id])); // Utilisez $sender_id au lieu de $user->getId()
        
    }

}