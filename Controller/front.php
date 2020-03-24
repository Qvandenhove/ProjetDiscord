<?php
function subscribeForm(){
    require('Views/ajouterUtilisateur.php');
}

function connectionForm(){
    require('Views/connexion.php');
}

function home(){
    require('Views/pageUtilisateur.php');
}

function addClassForm(){
    require('Views/addClass.php');
}

function searchTeachersForm(){
    require('Views/manageUser.php');
}

function searchClassesForm(){
    require('Views/choisirClasse.php');
}

function chat($userClasses){
    $classes = [];
    foreach ($userClasses->fetchAll() as $userClass){
        $classes[] = $userClass['id_classe'];
    }
    $access = false;
    foreach ($classes as $class){
        if ($class == $_GET['class']){
            $access = true;
            break;
        }
    }
    if($access){
        require('Views/chat.php');
    }else{
        header('Location: index.php?action=myPage&error=accessDenied');
    }

}