<?php


namespace CESI\ProjetDiscord;


class MessageManager extends Manager
{
    public function __construct()
    {
        $this->db = $this->DbConnect();
    }

    public function getMessages($room){
        $afficherMessage = $this->db->prepare('SELECT utilisateur.id,utilisateur.nom, utilisateur.prenom, messages.message  FROM messages JOIN utilisateur ON utilisateur.id = messages.utilisateur WHERE messages.salon = :room ORDER BY messages.id desc');
        $success = $afficherMessage->execute(array(
           ':room' => $room
        ));
        $messages = [];
        while($message = $afficherMessage->fetch()){
            $message['displaySide'] = $_SESSION['id'] == $message['id'] ? 'justify-content-end' : 'justify-content-start';
            array_push($messages,$message);
        }
        echo json_encode($messages);
    }

    public function postMessage($room){

        $message = htmlspecialchars($_POST['message']);
        $stockMessage = $this->db->prepare('INSERT INTO messages VALUES (id, :room , :utilisateur, :message)');
        $success = $stockMessage->execute(array(
            ':utilisateur' => $_SESSION['id'],
            ':room' => $room,
            'message' => $message
        ));
        $test = var_export($_SESSION['id'],true);
        echo json_encode(["status" => "success"]);
    }

    public function getMessageCount($room){
        $messageCount = $this->db->prepare('SELECT salle_chat.nom,COUNT(message) as count FROM messages JOIN salle_chat ON messages.salon = salle_chat.id WHERE salon = :room GROUP BY salon');
        $messageCount->execute([':room' => $room]);
        return $messageCount->fetch();
    }
}