<?php
ob_start();
$stylesheets = ['formulaire','tableaux'];
?>
    <form class = "col-10 d-flex flex-column justify-content-center align-items-center" method = "POST">
        <div class = "row d-flex justify-content-center">
            <div class="form-row">
                <input class=" col-4 form-control mr-sm-2" type="search" placeholder="Nom" name ="nom" aria-label="Search">
                <select name="userType" id="userType" class = "col-4 form-control">
                    <option value="">Élève</option>
                    <?php if($_SESSION['role'] == 2):?>
                    <option value="true">Professeur</option>
                    <?php endif; ?>
                </select>
            </div>
            <button class="col-3 btn btn-primary my-2 my-sm-0" type="submit">Search</button>
        </div>
        <div id="nomVide" class = "alert alert-danger hidden">Merci de remplir le champ 'Nom'</div>
        <div class = "row" style = "margin-top: 10px">
            <table class = "col-12 resultatRecherche">
                <thead>
                    <tr>
                        <td>Nom</td>
                        <td>Prénom</td>
                        <td>Mail</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id = "resultatRecherche">

                </tbody>
            </table>
        </div>
    </form>


    <script src = "JS/searchUser.js"></script>
<?php
$content = ob_get_clean();
require('template.php');
