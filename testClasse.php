<?php
$db = new PDO('mysql:host=localhost;dbname=discord;charset=utf8','root','');

$addClassReq = $db->prepare('INSERT INTO classe VALUES (id_classe,:nomClasse,:niveauClasse)');

$success = $addClassReq->execute(array(
    ':nomClasse' => $_POST['nomClasse'],
    ':niveauClasse' => $_POST['niveauClasse']
));

if($success){
    header('Location: pageUtilisateur.php?ajout=succes&type=classe');
}else{
    header('Location: pageUtilisateur.php?ajout=echec');
}