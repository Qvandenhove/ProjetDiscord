<?php


namespace CESI\ProjetDiscord;

class ClassManager extends Manager
{
    public function __construct()
    {
        $this->db = $this->DbConnect();
    }


    public function addClass(){
        $addClassReq = $this->db->prepare('INSERT INTO classe VALUES (id_classe,:nomClasse,:niveauClasse)');
        $success = $addClassReq->execute(array(
            ':nomClasse' => $_POST['nomClasse'],
            ':niveauClasse' => $_POST['niveauClasse']
        ));

        $reqClassId = $this->db->query('SELECT id_classe FROM classe ORDER BY id_classe DESC LIMIT 1');
        $classId = $reqClassId->fetch()['id_classe'];

        return [$success,$classId];
    }

    public function searchClasses(){
        $data = file_get_contents('php://input');
        $data = json_decode($data,true);
        if($_SESSION['role'] == 2){
            $rechercheClasses = $this->db->prepare('SELECT * FROM classe WHERE nom_classe LIKE :nom AND niveau_classe LIKE :niveau');
            $rechercheClasses->execute(array(
                ':nom' => '%'.$data['nomClasse'].'%',
                ':niveau' => '%'.$data['niveauClasse'].'%'
            ));
        }else{
            $rechercheClasses = $this->getUserClasses();
        }

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
    }

    public function getUserClasses(){
        $data = file_get_contents('php://input');
        $data = json_decode($data,true);
        $rechercheClasses = $this->db->prepare('SELECT * FROM classe JOIN appartient ON appartient.classe = classe.id_classe WHERE nom_classe LIKE :nom AND niveau_classe LIKE :niveau AND appartient.utilisateur = :userId');
        $rechercheClasses->execute(array(
            ':nom' => '%'.$data['nomClasse'].'%',
            ':niveau' => '%'.$data['niveauClasse'].'%',
            ':userId' => $_SESSION['id']
        ));
        return $rechercheClasses;
    }
}