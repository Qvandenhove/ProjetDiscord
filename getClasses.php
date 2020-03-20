<?php
$db = new PDO('mysql:host=localhost;dbname=discord;charset=utf8', 'root', '');
$data = file_get_contents('php://input');
$data = json_decode($data,true);

$rechercheClasses = $db->prepare('SELECT * FROM classe WHERE nom_classe LIKE :nom AND niveau_classe LIKE :niveau');
$rechercheClasses->execute(array(
    ':nom' => '%'.$data['nomClasse'].'%',
    ':niveau' => '%'.$data['niveauClasse'].'%'
    ));
$classes = [];
$count = 1;
while ($classe = $rechercheClasses->fetch()){
    for($i = 0; $i <= 1;$i ++){
        unset($classe[$i]);
    }
    sort($classes);
    $classes['classe'.strval($count)] = $classe;
    $count++;
}
echo json_encode($classes,JSON_UNESCAPED_UNICODE);