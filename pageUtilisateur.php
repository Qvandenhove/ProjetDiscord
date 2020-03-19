<?php
session_start();
ob_start();
?>
<div class="container messageBienvenue d-flex flex-column align-items-center justify-content-center">
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
        <div class="col-12 alert alert-success">L'utilisateur à bien été ajouté</div>
    </div>
    <?php endif; ?>
</div>


<?php
$content = ob_get_clean();
require('template.php');