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
}