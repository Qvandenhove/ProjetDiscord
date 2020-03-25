<?php


namespace CESI\ProjetDiscord;

class ChatRoomManager extends Manager
{
    public function __construct()
    {
        $this->db = $this->DbConnect();
    }

    public function createChatRoom($class,$name){
        $addChatRoom = $this->db->prepare('INSERT INTO salle_chat VALUES(id,:roomName,:class)');
        $success = $addChatRoom->execute(array(':roomName' => $name, 'class' => $class));
        return $success;
    }

    public function getChatRoom($class,$name){
        $getRoom = $this->db->prepare('SELECT id FROM salle_chat WHERE classe = :class AND nom= :roomName');
        $success = $getRoom->execute(array(':class' => $class, ':roomName' => $name));
        return $getRoom->fetch()['id'];
    }

    public function getClassChatRooms($class){
        $allRooms = $this->db->prepare('SELECT * FROM salle_chat WHERE classe = :class');
        $allRooms->execute([':class' => $class]);
        return $allRooms;
    }

    public function addUserToChat($user,$room){
        $addUser = $this->db->prepare('INSERT INTO communique VALUES(:user,:room)');
        $addUser->execute([':user' => $user, ':room' => $room]);
    }

    public function getUserInRoom($room){
        $usersInRoom = $this->db->prepare('SELECT utilisateur.nom, utilisateur.prenom, utilisateur.id, utilisateur.est_professeur FROM communique JOIN utilisateur ON utilisateur.id = communique.utilisateur WHERE salle = :room');
        $usersInRoom->execute([':room' => $room]);
        return $usersInRoom;
    }
}