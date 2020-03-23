<?php


namespace CESI\ProjetDiscord;
require('Models/Manager.php');

class UserManager extends Manager
{
    public function __construct()
    {
        $this->db = $this->DbConnect();
    }

    public function addUser(){
        $addReq = $this->db->prepare('INSERT INTO utilisateur VALUES (id,:nom,:prenom,:mail,:estAdmin,:estProf,:pass)');
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
        return $success;
    }

    public function connectUser(){
        $userReq = $this->db->prepare('SELECT id,nom,prenom,mdp,est_professeur,est_admin FROM utilisateur WHERE mail = :mail');
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
            header('Location: index.php?action=myPage');
        }else{
            echo'Mauvais identifiants.';
        }
    }

    public function searchTeacher(){
        $data = file_get_contents('php://input');
        $data = json_decode($data,true);

        $rechercheProf = $this->db->prepare('SELECT id,nom,prenom,mail FROM utilisateur WHERE est_professeur = true AND nom LIKE :nom');

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
    }

    public function searchClasses(){
        $data = file_get_contents('php://input');
        $data = json_decode($data,true);

        $rechercheClasses = $this->db->prepare('SELECT * FROM classe WHERE nom_classe LIKE :nom AND niveau_classe LIKE :niveau');
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
    }

    public function implantTeacher(){
        $implanterProf = $this->db->prepare('INSERT INTO appartient VALUES (:prof,:classe)');
        $success = $implanterProf->execute(array(
            ':prof' => $_GET['idProf'],
            ':classe' => $_GET['idClasse']
        ));

        if($success){
            header('Location: index.php?action=myPage&ajout=succes&type=implanterProf');
        }else{
            header('Location: index.php?action=myPage&ajout=echec');
        }
    }
}