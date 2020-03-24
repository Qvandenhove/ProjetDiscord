<?php
ob_start();
$stylesheets = ['chat']
?>

<div class="col-12 d-flex row justify-content-center section containerMessage">
    <div class="col-9 p-0 card">
        <div class="card-header">
            <h1 class="text-center titleCard">Tous</h1>
        </div>

        <div id="contenuMessages" class="card-body boxMessages">

        </div>

        <div class="card-footer">
            <form action="index.php?action=postMessage" method="post" id="envoiMessage" class="form d-flex flex-column">
                <div class="row">
                    <input type="text" class="mt-2 p-1 inputMessage" name="message" maxlength="500" placeholder="Message" autofocus>
                    <button type="submit" class="fas fa-paper-plane mt-2 border-0 btnMessage"></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-3 p-0 nav">
        <div class="professeur">
            <h3 class="titlePerson">Professeur</h3>
            <p class="namePerson">CAFLERS - Frédéric</p>
        </div>
        <div class="eleves">
            <h3 class="titlePerson">Élèves</h3>
            <p class="namePerson">ANDRIEU - Quentin</p>
            <p class="namePerson">CREPIN - Benoit</p>
            <p class="namePerson">LACOUR - Valentin</p>
            <p class="namePerson">LANCRY - Arno</p>
            <p class="namePerson">LE GALL - Martin</p>
            <p class="namePerson">LECOLIER - Louis</p>
            <p class="namePerson">LEJOSNE - Thomas</p>
            <p class="namePerson">POTEZ - Martin</p>
            <p class="namePerson">VANDAMME - Kevin</p>
            <p class="namePerson">VANDENHOVE - Quentin</p>
        </div>
    </div>
</div>

    <script src = 'JS/chat.js'></script>
<?php
$content = ob_get_clean();
require('Views/template.php');







