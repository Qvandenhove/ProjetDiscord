<!DOCTYPE html>
<html>
    <head>
        <title>DiscordChat</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/main.css">
    </head>
    <body>
        <header>
            <div class="row d-flex justify-content-center">
                <div class="col-12 text-center"><h1>Bonjour et bienvenue sur le discordChat</h1></div>
            </div>
        </header>
        <div class="container formConnexion d-flex align-items-center justify-content-center">
            <div class="row d-flex justify-content-center">
                <div class="col">
                    <form action="testConnexion.php" method="post" class="form-control d-flex flex-column justify-content-center">
                        <div class="form-row d-column-flex justify-content-center align-items-center">
                            <input placeholder = "Votre mail" type="email" name = "mail" id = "mail">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-6 text-center alert alert-danger hidden" id = "erreurMail">Merci de remplir ce champ</div>
                        </div>
                        <div class="form-row d-column-flex justify-content-center align-items-center">
                            <input placeholder="Mot de passe" type="password" name = "pass" id ="pass">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-6 text-center alert alert-danger hidden" id = "erreurPass">Merci de remplir ce champ</div>
                        </div>
                        <div class="form-row d-column-flex justify-content-center align-items-center">
                            <input type="submit" class = "btn btn-dark">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src = "JS/connexion.js"></script>
    </body>
</html>