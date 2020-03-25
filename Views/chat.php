<?php
$students = [];
ob_start();
$stylesheets = ['chat']
?>

<div class="col-12 d-flex row justify-content-center section containerMessage">
    <div class="col-9 p-0 card">
        <div class="card-header">
            <h1 class="text-center titleCard"><?=str_replace('-',' ',$_GET['room']) ?></h1>
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

    <div class="col-3 p-0 nav">
        <div class="col-6 professeur">
            <h3 class="titlePerson">Professeur</h3>
            <?php foreach($users as $user) :?>
                <?php if($user['est_professeur']): ?>
                    <a href="index.php?action=chat&class=<?=$_GET['class']?>&room=<?= str_replace(' ','-',$_SESSION['nom'].'_'.$user['nom']) ?>&targetUser=<?=$user['id'] ?>" target="_blank" class="namePerson"><?= $user['nom']?> - <?= $user['prenom'] ?></a>
                <?php else :
                    $students[] = $user;
                endif;
             endforeach;?>
        </div>
        <div class="col-6 eleves">
            <?php foreach ($students as $student): ?>
                <h3 class="titlePerson">Étudiant</h3>
            <a href="index.php?action=chat&class=<?=$_GET['class']?>&room=<?= str_replace(' ','-',$_SESSION['nom'].'_'.$user['nom']) ?>&targetUser=<?=$user['id'] ?>" class="namePerson"><?= $student['nom']?> - <?= $student['prenom'] ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

    <script src = 'JS/chat.js'></script>
<?php

$content = ob_get_clean();
require('Views/template.php');







