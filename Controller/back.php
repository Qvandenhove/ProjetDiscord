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
    $charRoomManger = new CESI\ProjetDiscord\ChatRoomManager();
    $success2 = $charRoomManger->createChatRoom(intval($success1[1]),'général');
    if($success1[0] and $success2){
        header('Location: index.php?action=myPage&ajout=succes&type=classe');
    }else{
        header('Location: index.php?action=myPage&ajout=echec');
    }
}

function getUsers(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager-> searchUsers();
}

function getClasses(){
    $ClassManager = new CESI\ProjetDiscord\ClassManager();
    $ClassManager->searchClasses();
}

function implantTeacher(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->implantTeacher();
}

function disconnect(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->disconnect();
}

function postMessage(){
    $ChatRoomManager = new CESI\ProjetDiscord\ChatRoomManager();
    $room = $ChatRoomManager->getChatRoom($_GET['class'],$_GET['room']);
    $messageManager = new CESI\ProjetDiscord\MessageManager();
    $messageManager->postMessage($room);
}

function getMessage(){
    $ChatRoomManager = new CESI\ProjetDiscord\ChatRoomManager();
    $room = $ChatRoomManager->getChatRoom($_GET['class'],$_GET['room']);
    $messageManager = new CESI\ProjetDiscord\MessageManager();
    $messageManager->getMessages($room);
}

function getUserClasses(){
    $classsManager = new CESI\ProjetDiscord\ClassManager();
    $userClasses = $classsManager->getUserClasses();
}