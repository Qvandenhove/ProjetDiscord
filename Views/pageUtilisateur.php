<?php
ob_start();
$stylesheets = ['tableaux','formulaire']
?>
    <div class="row d-flex justify-content-center"><h1 class = "text-center">Bonjour <?=$_SESSION['prenom'] ?> voici la liste de vos salons de discussion.</h1></div>
    <?php if($_SESSION['role'] != 2): ?>
    <div class="row d-flex justify-content-center">
        <form class = "col-10 d-flex flex-column justify-content-center align-items-center" method = "POST">
            <div class = "form-row d-flex justify-content-center">
                <input class=" col-3 form-control mr-sm-2" type="search" placeholder="Nom de la classe" name ="nomClasse" aria-label="Search">
                <input class=" col-3 form-control mr-sm-2" type="search" placeholder="Niveau de la classe" name ="niveauClasse" aria-label="Search">
                <button class="col-3 btn btn-primary my-2 my-sm-0" type="submit">Search</button>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-3 alert alert-danger mr-sm-2 hidden" id = "nomClasseVide">Merci de remplir ce champ</div>
                <div class="col-3 alert alert-danger mr-sm-2 hidden" id = "niveauClasseVide">Merci de remplir ce champ</div>
                <div class="col-3"></div>
            </div>
            <div id="nomProfesseurVide" class = "alert alert-danger hidden">Merci de remplir ce champ</div>
            <div class = "row" style = "margin-top: 10px">
                <table class = "col-12 resultatRecherche">
                    <thead>
                    <tr>
                        <td>Nom</td>
                        <td>Niveau</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody id = "resultatRecherche"></tbody>
                </table>
            </div>
        </form>
    </div>
    <?php endif; ?>
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
                $message = 'L\' utilisateur à bien été implanté';
        }
        ?>
        <div class="col-12 alert alert-success"><?= $message ?></div>
    </div>
    <?php endif; ?>
    <script src = "JS/rechercherClasse.js"></script>

<?php
$content = ob_get_clean();
require('template.php');