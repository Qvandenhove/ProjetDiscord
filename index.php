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
        case 'implantTeacher':
            implantTeacher();
            break;

        case 'disconnect':
            disconnect();
            break;

        case 'chat':
            $usersInClass = getUsersInClass($_GET['class']);
            chat($usersInClass);
            break;
        case 'postMessage':
            postMessage();
            break;
        case 'getMessages':
            getMessage();
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
