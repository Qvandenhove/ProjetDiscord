<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=discord;charset=utf8','root','');

$userReq = $db->prepare('SELECT id,nom,prenom,mdp,est_professeur,est_admin FROM utilisateur WHERE mail = :mail');
$userReq->execute(array(':mail' => $_POST['mail']));
$user = $userReq->fetch();
if (password_verify($_POST['pass'],$user['mdp'])){
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['prenom'] = $user['prenom'];
    if($user['est_admin']){
        $_SESSION['role'] = 'admin';
    }elseif ($user['est_professeur']){
        $_SESSION['role'] = 'professeur';
    }else{
        $_SESSION['role'] = 'élève';
    }
    header('Location: pageUtilisateur.php');
}else{
    echo'Mauvais identifiants.';
}