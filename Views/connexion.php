<?php
ob_start();
$stylesheets = ['formulaire'];
if(!empty($_SESSION)){
    session_destroy();
}
?>

    <div class="col">
        <form action="index.php?action=connection" method="post" class="d-flex flex-column justify-content-center">
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
    <script src="JS/formulaire.js"></script>
<?php
$content = ob_get_clean();
require('template.php');
