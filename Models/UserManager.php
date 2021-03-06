<?php


namespace CESI\ProjetDiscord;

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
            ':nom' => htmlspecialchars($_POST['nom']),
            ':prenom' => htmlspecialchars($_POST['prenom']),
            ':mail' => htmlspecialchars($_POST['mail']),
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
            $_SESSION['id'] = intval($user['id']);
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            if($user['est_admin']){
                $_SESSION['role'] = 2;
            }elseif ($user['est_professeur']){
                $_SESSION['role'] = 1;
            }else{
                $_SESSION['role'] = 0;
            }
            header('Location: index.php?action=myPage');
        }else{
            header('Location: index.php?error=wrongLog');
        }
    }
    public function searchUsers(){
        $data = file_get_contents('php://input');
        $data = json_decode($data,true);
        $searchUsers = $this->db->prepare('SELECT id,nom,prenom,mail FROM utilisateur WHERE est_professeur = :teacher AND est_admin = false AND prenom LIKE :nom');

        $searchUsers->execute(array(':nom' => '%'.htmlspecialchars($data['nom']).'%', ':teacher' => htmlspecialchars($data['isTeacher'])));
        $users = [];
        $count = 1;
        while ($user = $searchUsers->fetch()){
            for($i = 0; $i <= 3;$i ++){
                unset($user[strval($i)]);
            }
            sort($user);
            $users['professeur'.strval($count)] = $user;
            $count++;
        }

        echo json_encode($users,JSON_UNESCAPED_UNICODE);
    }



    public function implantUser(){
        $implanterProf = $this->db->prepare('INSERT INTO appartient VALUES (:prof,:classe)');
        $success = $implanterProf->execute(array(
            ':prof' => $_GET['userId'],
            ':classe' => $_GET['classId']
        ));

        if($success){
            header('Location: index.php?action=myPage&ajout=succes&type=implanterProf');
        }else{
            header('Location: index.php?action=myPage&ajout=echec');
        }
    }

    public function disconnect(){
        session_destroy();
        header('Location:index.php');
    }

    public function updateWritingStatus($user, $class, $room){
        $update = $this->db->prepare('UPDATE utilisateur SET isWriting = true WHERE id = :user');
        $update->execute([':user' => $user]);
        $data = file_get_contents('php://input');
        if(!is_dir('MediaContent/userCurrentMessages/'.$class.'/'.$room)){
            mkdir('MediaContent/userCurrentMessages/'.$class.'/'.$room, 0777, true);
        }
        file_put_contents('MediaContent/userCurrentMessages/'.$class.'/'.$room.'/'.$_SESSION['id'].'currentMessage.json',$data);
    }

    public function getWritingStatus($users, $class, $room){
        $writingStatuses = [];
        foreach ($users as $user) {
            $writingStatus = $this->db->prepare('SELECT id, isWriting FROM utilisateur WHERE id = :user');
            $writingStatus->execute([':user' => $user['id']]);
            $userStatus = $writingStatus->fetch();
            if($userStatus['isWriting'] && $userStatus['id'] != $_SESSION['id']){
                $userCurrentMessage = file_get_contents('MediaContent/userCurrentMessages/'.$class.'/'.$room.'/'.$user['id'].'currentMessage.json');
                $userCurrentMessage = json_decode($userCurrentMessage,true,JSON_UNESCAPED_UNICODE);
                $userStatus['currentMessage'] = $userCurrentMessage;
            }
            $writingStatuses['user' . $user['id']] = $userStatus;
        }
        echo json_encode($writingStatuses,JSON_UNESCAPED_UNICODE);
    }

    public function removeWritingStatus($user, $class, $room){
        $update = $this->db->prepare('UPDATE utilisateur SET isWriting = false WHERE id = :user');
        $update->execute([':user' => $user]);
        unlink('MediaContent/userCurrentMessages/'.$class.'/'.$room.'/'.$_SESSION['id'].'currentMessage.json');
    }
}