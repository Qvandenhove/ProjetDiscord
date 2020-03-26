<?php
$students = [];
ob_start();
$stylesheets = ['chat']
?>

<div class="col-12 d-flex row justify-content-center section containerMessage">
    <div class="col-9 p-0 card">
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
            <?php foreach($users as $user) :?>
                <?php if($user['est_professeur']): ?>
                    <div class = "d-flex flex-inline"><a href="index.php?action=chat&class=<?=$_GET['class']?>&room=<?= str_replace(' ','-',$_SESSION['nom'].'_'.$user['nom']) ?>&targetUser=<?=$user['id'] ?>" target="_blank" class="namePerson"><?= $user['nom']?> - <?= $user['prenom'] ?></a><div data-id="<?= $user['id'] ?>" id = "" class="hidden messageEnCours">Est en train d'écrire</div></div>
                <?php else :
                    $students[] = $user;
                endif;
             endforeach;?>
        </div>
        <div class="eleves d-flex flex-column">
            <h3 class="titlePerson">Étudiant</h3>
            <?php foreach ($students as $student): ?>
                <a href="index.php?action=chat&class=<?=$_GET['class']?>&room=<?= str_replace(' ','-',$_SESSION['nom'].'_'.$student['nom']) ?>&targetUser=<?=$student['id'] ?>" target="_blank" class="namePerson"><?= $student['nom']?> - <?= $student['prenom'] ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

    <script src = 'JS/chat.js'></script>
<?php

$content = ob_get_clean();
require('Views/template.php');







