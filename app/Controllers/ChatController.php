<?php

class ChatController extends CoreController
{

    public function chat($params)
    {
        $receiver_id = $params["id"];
        $sender_id = $_SESSION['user_id'];

        $messageModel = new Message();
        $chatMessages = $messageModel->getMessagesForChat($sender_id, $receiver_id);

        $userModel = new User();
        $user = $userModel->find($receiver_id);

        $this->show('chat', [
            "pageTitle" => "Nexora - Discussion",
            "messages" => $chatMessages,
            "user" => $user,
            "sender" => $sender_id
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
    
        $messageModel = new Message();
        $chatMessages = $messageModel->getMessagesForChat($sender_id, $receiver_id);
    
        $errorList = [];
    
        $message = new Message();
    
        $message->setSender_id($sender_id);
        $message->setReceiver_id($receiver_id);
        $message->setText($text);
    
        if(empty($errorList)) {
    
            $success = $message->insert();
    
            if($success) {
                $chatUrl = $router->generate('chat', ['id' => $user->getId()]);
                header('Location: ' . $chatUrl);
                exit;
            } else {
                $errorList[] = "Erreur lors de l'ajout.";
            }
        }
    
            $this->show('chat', [
            "pageTitle" => "Nexora - Discussion",
            "messages" => $chatMessages,
            "user" => $user,
            "errorList" => $errorList,
            "sender" => $sender_id
        ]);
    }
    

}