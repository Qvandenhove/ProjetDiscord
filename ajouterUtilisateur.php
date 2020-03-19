<?php
session_start();
ob_start();
?>
<div class="container formInscription d-flex align-items-center justify-content-center">
    <form action="testInscription.php" method="post" class="d-flex flex-column justify-content-center align-items-center text-center col-12">
        <div class="form-row">
            <div class="input">
                <input type="text" class="form-control" name = "nom" placeholder="Nom">
                <div class="text-center alert alert-danger hidden" id = "nomVide">Merci de remplir ce champ</div>
            </div>

            <div class="input">
                <input type="text" class="form-control" name = "prenom" placeholder="Prenom">
                <div class="text-center alert alert-danger hidden" id = "prenomVide">Merci de remplir ce champ</div>
            </div>
        </div>
        <div class="form-row">
            <div class="input">
                <input type="email" class="form-control" name = "mail" placeholder="Mail">
                <div class="text-center alert alert-danger hidden" id = "mailVide">Merci de remplir ce champ</div>
            </div>
            <div class="input">
                <input type="password" class="form-control" name = "pass" placeholder="Mot de passe">
                <div class="text-center alert alert-danger hidden" id = "passVide">Merci de remplir ce champ</div>
            </div>
        </div>
        <div class="form-row d-flex justify-content-center">
            <select type="text" class="form-control" name = "role">
                <option value="eleve">Élève</option>
                <option value="prof">Professeur</option>
                <option value="admin">Administrateur</option>
            </select>
        </div>
        <input type="submit" class = "btn btn-primary text-center">
    </form>
    <script src="JS/ajouterUtilisateur.js"></script>
</div>





<?php
$content = ob_get_clean();
require('template.php');
?>
