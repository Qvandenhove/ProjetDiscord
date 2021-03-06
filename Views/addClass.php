<?php
ob_start();
$stylesheets = ['formulaire'];
?>
            <div class="col-6">
                <form action="index.php?action=addClass" method="post" class="d-flex flex-column justify-content-center">
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
    <script src = "../JS/formulaire.js"></script>

<?php
$content = ob_get_clean();
require('template.php');
