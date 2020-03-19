<?php
session_start();
ob_start();
?>
    <div class="container formConnexion d-flex align-items-center justify-content-center">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
                <form action="testClasse.php" method="post" class="d-flex flex-column justify-content-center">
                    <div class="form-row d-flex justify-content-center">
                        <input type="text" name = "nomClasse" class="form-control" placeholder="Nom de la classe">
                        <div class="col-6 text-center alert alert-danger hidden" id = "nomClasseVide">Merci de remplir ce champ</div>
                    </div>
                    <div class="form-row d-flex justify-content-center">
                        <input type="text" name = "niveauClasse" class="form-control" placeholder = "Niveau de la classe">
                        <div class="col-6 text-center alert alert-danger hidden" id = "niveauClasseVide">Merci de remplir ce champ</div>
                    </div>
                    <input type="submit" class = "btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <script src = "JS/formulaire.js"></script>

<?php
$content = ob_get_clean();
require('template.php');
