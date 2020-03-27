<?php
$students = [];
ob_start();
$stylesheets = ['chat'];
$teachers = [];
foreach($users as $user){
    if($user['est_professeur']){
        $teachers[] = $user;
    }else{
        $students[] = $user;
    }
}
$extension = $_SESSION['role'] != 1 || sizeof($teachers) > 1 || $_GET['room'] != 'general';
?>
<div class="col-12 d-flex row justify-content-center section containerMessage">
    <?php if($extension): ?>
    <div class="col-3 p-0">
        <div class="card-header d-flex justify-content-around align-items-center">
            <h1 class = "titleCard">Correspondant</h1>
        </div>
        <div class="card-body boxMessages">
            <?php if($_GET['room'] == 'general'):
                foreach ($teachers as $teacher): ?>
                <div data-id = "<?=$teacher['id'] ?>" class="col-12 mt-3 mb-1 general contenuMessage" id ="currentMessage">
                </div>
            <?php endforeach; else:
                foreach ($users as $user):
                    if($user['id'] != $_SESSION['id']):
                    ?>
                    <div data-id = "<?=$user['id'] ?>" class="col-12 mt-3 mb-1 prive contenuMessage" id ="currentMessage">
                    </div>
            <?php endif; endforeach; endif; ?>
        </div>
        <div class="card-footer">Voici le message de votre correspondant</div>
    </div>
    <?php endif ?>
    <div class="col-<?= $extension ? 6 : 9 ?> p-0 card">
        <div class="card-header d-flex justify-content-around align-items-center">
            <?php if($_GET['room'] != 'general'): ?>
            <a href = 'index.php?action=chat&class=<?= $_GET['class']?>&room=general' class = "btn btn-primary" ><i class="fas fa-arrow-left"></i></a>
            <?php endif; ?>
            <h1 class="text-center titleCard"><?=str_replace('-',' ',$_GET['room']) ?></h1>
            <?php if($_GET['room'] != 'general'): ?>
                <div></div>
            <?php endif; ?>
        </div>

        <div id="contenuMessages" class="card-body boxMessages">

        </div>

        <div class="card-footer">
            <form action="index.php?action=postMessage" method="post" id="envoiMessage" class="form d-flex flex-column">
                <div class="row">
                    <input type="text" class="mt-2 p-1 inputMessage" name="message" maxlength="500" placeholder="Message" autofocus>
                    <button type="submit" class="fas fa-paper-plane mt-2 border-0 btnMessage"></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-3 d-flex flex-column p-0 nav">
        <div class="professeur">
            <h3 class="titlePerson">Professeur</h3>
            <?php foreach($teachers as $teacher) :?>
                <div class = "d-flex flex-inline">
                    <div data-roomName = "<?= str_replace(' ','-',$_SESSION['nom'].'_'.$teacher['nom']) ?>" data-roomNameReverse = "<?= str_replace(' ','-',$teacher['nom'].'_'.$_SESSION['nom'])?>" class="newMessage text-center hidden"><i class="fas fa-envelope-square"></i></div>
                    <a href="index.php?action=chat&class=<?=$_GET['class']?>&room=<?= str_replace(' ','-',$_SESSION['nom'].'_'.$teacher['nom']) ?>&targetUser=<?=$teacher['id'] ?>" class="namePerson"><?= $teacher['nom']?> - <?= $teacher['prenom'] ?></a><div data-id="<?= $teacher['id'] ?>" id = "" class="hidden messageEnCours">
                        Est en train d'écrire
                    </div>
                </div>
             <?php endforeach;?>
        </div>
        <div class="eleves d-flex flex-column">
            <h3 class="titlePerson">Étudiant</h3>
            <?php foreach ($students as $student): ?>
                <div class = "d-flex flex-inline"><div data-roomName = "<?= str_replace(' ','-',$_SESSION['nom'].'_'.$student['nom']) ?>" data-roomNameReverse = "<?= str_replace(' ','-',$student['nom'].'_'.$_SESSION['nom'])?>" class="newMessage text-center hidden"><i class="fas fa-envelope-square"></i></div><a href="index.php?action=chat&class=<?=$_GET['class']?>&room=<?= str_replace(' ','-',$_SESSION['nom'].'_'.$student['nom']) ?>&targetUser=<?=$student['id'] ?>" target="_blank" class="namePerson"><?= $student['nom']?> - <?= $student['prenom'] ?></a><div data-id="<?= $student['id'] ?>" id = "" class="hidden messageEnCours">
                        Est en train d'écrire
                    </div></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

    <script src = 'JS/chat.js'></script>
    <script src = 'JS/refreshPrivateChat.js'></script>
<?php

$content = ob_get_clean();
require('Views/template.php');







