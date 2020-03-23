<?php


namespace CESI\ProjetDiscord;


class ClassManager
{
    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=discord;charset=utf8','root','');
    }


    public function addClass(){
        $addClassReq = $this->db->prepare('INSERT INTO classe VALUES (id_classe,:nomClasse,:niveauClasse)');
        $success = $addClassReq->execute(array(
            ':nomClasse' => $_POST['nomClasse'],
            ':niveauClasse' => $_POST['niveauClasse']
        ));
        return $success;
    }
}