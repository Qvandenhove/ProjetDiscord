<?php
session_start();
require('Controller/back.php');
require ('Controller/front.php');
$action = isset($_GET['action']) ? $_GET['action'] : null;
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
    case 'myPage':
        home();
        break;

    case 'addClassForm':
        addClassForm();
        break;
    case 'addClass':
        addClass();
        break;

    case 'searchTeachersForm':
        searchTeachersForm();
        break;
    case 'getProfs':
        getProfs();
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

    default:
        connectionForm();
}