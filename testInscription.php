<?php
$db = new PDO('mysql:host=localhost;dbname=discord;charset=utf8','root','');

$addReq = $db->prepare('INSERT INTO utilisateur VALUES (id,:nom,:prenom,:mail,:estAdmin,:estProf,:pass)');
$prof = false;
$admin = false;
switch($_POST['role']){
    case 'admin':
        $admin = true;
        break;
    case 'prof':
        $prof = true;
        break;
}

$success = $addReq->execute(array(
    ':nom' => $_POST['nom'],
    ':prenom' => $_POST['prenom'],
    ':mail' => $_POST['mail'],
    ':estAdmin' => $admin,
    ':estProf' => $prof,
    ':pass' => password_hash($_POST['pass'], PASSWORD_DEFAULT)
));

if($success){
    header('Location: pageUtilisateur.php?ajout=succes');
}else{
    header('Location: pageUtilisateur.php?ajout=echec');
}

