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

function chat($usersInRoom,$reverse){
    if($reverse){
        header('Location: index.php?action=chat&class='.$_GET['class'].'&room='.explode('_',$_GET['room'])[1].'_'.explode('_',$_GET['room'])[0]);
    }

    $users = [];
    foreach ($usersInRoom->fetchAll() as $user){
        $users[] = $user;
    }
    $access = false;
    foreach ($users as $user){
        if ($user['id'] == $_SESSION['id']){
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