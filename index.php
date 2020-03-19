<?php
session_start();
ob_start();
if(!empty($_SESSION)){
    session_destroy();
}
?>

<div class="container formConnexion d-flex align-items-center justify-content-center">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
            <form action="testConnexion.php" method="post" class="d-flex flex-column justify-content-center">
                <div class="form-row d-column-flex justify-content-center align-items-center">
                    <input class = "form-control" placeholder = "Votre mail" type="email" name = "mail" id = "mail">
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-12 text-center alert alert-danger hidden" id = "mailVide">Merci de remplir ce champ</div>
                </div>
                <div class="form-row d-column-flex justify-content-center align-items-center">
                    <input class = "form-control" placeholder="Mot de passe" type="password" name = "pass" id ="pass">
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-12 text-center alert alert-danger hidden" id = "passVide">Merci de remplir ce champ</div>
                </div>
                <div class="form-row d-column-flex justify-content-center align-items-center">
                    <input type="submit" class = "btn btn-dark">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="JS/formulaire.js"></script>
<?php
$content = ob_get_clean();
require('template.php');
