<?php


namespace CESI\ProjetDiscord;


class MessageManager extends Manager
{
    public function __construct()
    {
        $this->db = $this->DbConnect();
    }

    public function getMessages($room){
        $afficherMessage = $this->db->prepare('SELECT utilisateur.nom, utilisateur.prenom, messages.message  FROM messages JOIN utilisateur ON utilisateur.id = messages.utilisateur WHERE messages.salon = :room ORDER BY messages.id desc');
        $success = $afficherMessage->execute(array(
           ':room' => $room
        ));
        $messages = $afficherMessage->fetchAll();
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
        file_put_contents('fichier.txt',$test);
        file_put_contents('fichier.txt',$test);
        echo json_encode(["status" => "success"]);
    }
}