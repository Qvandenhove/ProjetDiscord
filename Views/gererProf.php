<?php
ob_start();
$stylesheets = ['formulaire','tableaux'];
?>
    <form class = "col-10 d-flex flex-column justify-content-center align-items-center" method = "POST">
        <div class = "row d-flex justify-content-center">
            <input class=" col-7 form-control mr-sm-2" type="search" placeholder="Nom du professeur" name ="nomProfesseur" aria-label="Search">
            <button class="col-3 btn btn-primary my-2 my-sm-0" type="submit">Search</button>
        </div>
        <div id="nomProfesseurVide" class = "alert alert-danger hidden">Merci de remplir ce champ</div>
        <div class = "row" style = "margin-top: 10px">
            <table class = "col-12 resultatRecherche" id = "resultatRecherche">
                <tr>
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Mail</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </form>


    <script src = "JS/rechercherProf.js"></script>
<?php
$content = ob_get_clean();
require('template.php');
