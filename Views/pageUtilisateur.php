<?php
ob_start();
$stylesheets = []
?>

    <div class="row">
        <div class="col-12 text-center">
            <h1>Bonjour <?=$_SESSION['role'] ?></h1>
        </div>
    </div>
    <?php if(isset($_GET['ajout']) and $_GET['ajout'] == 'echec'): ?>
    <div class="row">
        <div class="col-12 alert alert-danger">Une erreur est survenue de notre côté merci de réessayer utlérieurement</div>
    </div>
    <?php elseif (isset($_GET['ajout']) and $_GET['ajout'] == 'succes'): ?>
    <div class="row">
        <?php
        switch ($_GET['type']){
            case 'classe':
                $message = 'La classe à bien été ajouté';
                break;
            case 'user':
                $message = 'L\'utilisateur à bien été ajouté';
                break;
            case 'implanterProf':
                $message = 'Le professeur à bien été implanté';
        }
        ?>
        <div class="col-12 alert alert-success"><?= $message ?></div>
    </div>
    <?php endif; ?>


<?php
$content = ob_get_clean();
require('template.php');