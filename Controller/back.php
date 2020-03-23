<?php
require('Models/userManager.php');
require('Models/ClassManager.php');

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
    $success = $classManager->addClass();
    if($success){
        header('Location: index.php?action=myPage&ajout=succes&type=classe');
    }else{
        header('Location: index.php?action=myPage&ajout=echec');
    }
}

function getProfs(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager-> searchTeacher();
}

function getClasses(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->searchClasses();
}

function implantTeacher(){
    $userManager = new CESI\ProjetDiscord\UserManager();
    $userManager->implantTeacher();
}