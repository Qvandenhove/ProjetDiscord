<?php
session_start();
require('Controller/back.php');
require ('Controller/front.php');
$action = isset($_GET['action']) ? $_GET['action'] : null;

if(!empty($_SESSION) || $action == 'connection'){
    switch($action){
        case 'addUser':
            addUser();
            break;
        case 'subscribeForm':
            subscribeForm();
            break;
        case 'connection':
            connectUser();
            break;

        case 'addClassForm':
            addClassForm();
            break;
        case 'addClass':
            addClass();
            break;

        case 'searchUsersForm':
            searchTeachersForm();
            break;
        case 'getUsers':
            getUsers();
            break;
        case 'chooseClass':
            searchClassesForm();
            break;
        case 'getClasses':
            getClasses();
            break;
        case 'implantUser':
            implantUser();
            break;

        case 'disconnect':
            disconnect();
            break;

        case 'chat':
            $allRooms = getClassChatRooms($_GET['class']);
            $allRooms = $allRooms->fetchAll();
            if($_GET['room'] == 'general'){
                $usersInClass = getUsersInClass($_GET['class']);
                chat($usersInClass,getChatRoom($_GET['class'],false));
            }else {
                $roomExists = false;
                $reverse = false;
                foreach ($allRooms as $room){

                    if ($room['nom'] == $_GET['room']){
                        $chatRoom = $room['nom'];
                        $roomExists = true;
                        break;
                    }elseif (explode('_',$_GET['room'])[1].'_'.explode('_',$_GET['room'])[0] == $room['nom']){

                        $roomExists = true;
                        $chatRoom = explode('_',$_GET['room'])[1].'_'.explode('_',$_GET['room'])[0];
                        $reverse = true;
                    }
                }
                if ($roomExists){
                    $userInRoom = getRoomUsers($chatRoom,$_GET['class']);
                    chat($userInRoom,$reverse);
                }else{
                    addChatRoom($_GET['class'],str_replace(' ','-',$_GET['room']));
                    addUserInRoom($_SESSION['id'],$_GET['room'],$_GET['class']);
                    addUserInRoom($_GET['targetUser'],$_GET['room'],$_GET['class']);
                    $userInRoom = getRoomUsers($_GET['room'],$_GET['class']);
                    $chatRoom = getChatRoom($_GET['room'],$_GET['class']);

                    chat($userInRoom,false);
                }
            }


            break;
        case 'postMessage':
            postMessage();
            break;
        case 'getMessages':
            getMessage();
            break;

        case 'writing':
            writeStatus($_SESSION['id']);
            break;

        case 'notWriting':
            removeWritingStatus($_SESSION['id']);
            break;
        case 'getWritingStatus':
            getWritingStatus();
            break;
        default:
            if(!empty($_SESSION)){
                home();
            }else{
                connectionForm();
            }
    }
}else{
    connectionForm();
}
