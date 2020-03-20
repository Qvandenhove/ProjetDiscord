<?php
$db = new PDO('mysql:host=localhost;dbname=discord;charset=utf8', 'root', '');
$data = file_get_contents('php://input');
$data = json_decode($data,true);

$rechercheProf = $db->prepare('SELECT id,nom,prenom,mail FROM utilisateur WHERE est_professeur = true AND nom LIKE :nom');

$rechercheProf->execute(array(':nom' => '%'.$data['nom'].'%'));
$professeurs = [];
$count = 1;
while ($professeur = $rechercheProf->fetch()){
    for($i = 0; $i <= 3;$i ++){
        unset($professeur[strval($i)]);
    }
    sort($professeur);
    $professeurs['professeur'.strval($count)] = $professeur;
    $count++;
}

echo json_encode($professeurs,JSON_UNESCAPED_UNICODE);