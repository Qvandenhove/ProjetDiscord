<?php
require('Models/Manager.php');
require('Models/userManager.php');
require('Models/ClassManager.php');
require('Models/ChatRoomManager.php');
require('Models/MessageManager.php');

function addUser(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $success = $userManager->addUser();
    if($success){
        header('Location: index.php?action=myPage&ajout=succes&type=user');
    }else{
        header('Location: index.php?action=myPage&ajout=echec');
    }
}

function connectUser(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->connectUser();
}

function addClass(){
    $classManager = new CESI\ProjetDiscord\ClassManager();
    $success1 = $classManager->addClass();
    $success2 = addChatRoom(intval($success1[1]),'général');
    if($success1[0] and $success2){
        header('Location: index.php?action=myPage&ajout=succes&type=classe');
    }else{
        header('Location: index.php?action=myPage&ajout=echec');
    }
}

function addChatRoom($class, $name){
    $charRoomManger = new CESI\ProjetDiscord\ChatRoomManager();
    $success = $charRoomManger->createChatRoom($class,$name);
    return $success;
}

function getUsers(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager-> searchUsers();
}

function getClasses(){
    $ClassManager = new CESI\ProjetDiscord\ClassManager();
    $ClassManager->searchClasses();
}

function implantUser(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->implantUser();
}

function disconnect(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->disconnect();
}

function postMessage(){
    $room = getChatRoom($_GET['class'],$_GET['room']);
    $messageManager = new CESI\ProjetDiscord\MessageManager();
    $messageManager->postMessage($room);
}

function getMessage(){
    $room = getChatRoom($_GET['class'],$_GET['room']);
    $messageManager = new CESI\ProjetDiscord\MessageManager();
    $messageManager->getMessages($room);
}

function getChatRoom($class, $name){
    $ChatRoomManager = new CESI\ProjetDiscord\ChatRoomManager();
    $room = $ChatRoomManager->getChatRoom($class,$name);
    return $room;
}

function getUsersInClass($class){
    $classManager = new CESI\ProjetDiscord\ClassManager();
    $usersInClass = $classManager->getUserInClass($class);
    return $usersInClass;
}

function getClassChatRooms($class){
    $roomManager = new CESI\ProjetDiscord\ChatRoomManager();
    return $roomManager->getClassChatRooms($class);
}

function addUserInRoom($user,$roomName,$class){
    $room = getChatRoom($class, $roomName);
    $roomManager = new CESI\ProjetDiscord\ChatRoomManager();
    $roomManager->addUserToChat($user,$room);
}

function getRoomUsers($roomName,$class){
    $room = getChatRoom($class, $roomName);
    $roomManager = new CESI\ProjetDiscord\ChatRoomManager();
    $users = $roomManager->getUserInRoom($room);
    return $users;
}

function writeStatus($user){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->updateWritingStatus($user);
}

function getWritingStatus($class, $room){
    if ($room != 'general') {
        $users = getRoomUsers($room, $class);
    } else {
        $users = getTeacherInClass($class);
    }
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->getWritingStatus($users->fetchAll());
}

function removeWritingStatus($user){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->removeWritingStatus($user);
}

function getUserRooms($user){
    $roomManager = new CESI\ProjetDiscord\ChatRoomManager();
    $rooms = $roomManager->getUserRooms($user);
    return $rooms;
}

function getMessageCount($user){
    $rooms = getUserRooms($user)->fetchAll();
    $messageManager = new CESI\ProjetDiscord\MessageManager();
    $messageCount = [];
    $roomCount = 1;
    foreach ($rooms as $room){
        $count = $messageManager->getMessageCount($room['salle']);
        if(isset($count['count'])){
            $messageCount['room'.$roomCount] = [$count['nom'],$count['count']];
        }
    }
    echo json_encode($messageCount, JSON_UNESCAPED_UNICODE);
}

function getTeacherInClass($class){
    $classManager = new CESI\ProjetDiscord\ClassManager();
    $teacherInClass = $classManager->getTeacherInClass($class);
    return $teacherInClass;
}