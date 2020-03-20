<?php
$db = new PDO('mysql:host=localhost;dbname=discord;charset=utf8', 'root', '');

$implanterProf = $db->prepare('INSERT INTO appartient VALUES (:prof,:classe)');
$success = $implanterProf->execute(array(
    ':prof' => $_GET['idProf'],
    ':classe' => $_GET['idClasse']
));

if($success){
    header('Location: pageUtilisateur.php?ajout=succes&type=implanterProf');
}else{
    header('Location: pageUtilisateur.php?ajout=echec');
}