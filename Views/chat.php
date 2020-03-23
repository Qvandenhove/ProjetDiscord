<?php
ob_start();
$stylesheets = ['formulaire']
?>
<div class="container">
    <form action="index.php?action=postMessage" method="post" id="envoiMessage" class="form d-flex flex-column">
        <div id="contenuMessages" class="mt-4 boxMessages" style="max-height: 65%; overflow: auto">

        </div>
        <textarea class="mt-2" name="message" maxlength="500" placeholder="Message" style="resize: none" autofocus></textarea>
        <input type="submit" value="Envoyer" class="mt-2 btn btn-primary">
    </form>
</div>

    <script src = 'JS/chat.js'></script>
<?php
$content = ob_get_clean();
require('Views/template.php');