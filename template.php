<!DOCTYPE html>
<html>
<head>
    <title>DiscordChat</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
</head>
<body>
<header>
    <div class="row d-flex align-items-center">
        <div class="col-3 d-flex flex-inline align-items-end menu">
            <?php if(!empty($_SESSION)): ?>
            <div class="dropdown">
                <a class="btn btn-info dropdown-toggle" href = "" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ajouter
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class = "dropdown-item" href="ajouterUtilisateur.php">Utilisateur</a>
                    <a class = "dropdown-item" href="addClass.php">Classe</a>
                </div>
            </div>
                <div class = "dropdown"><a href="#" class = "btn btn-info">Gestion</a></div>
            <?php endif;?>
        </div>
        <div class="col-6 text-center">
            <h1>Bonjour et bienvenue sur le discordChat</h1>
        </div>
        <div class="col-3 d-flex flex-inline justify-content-end align-items-center">
            <?php if(!empty($_SESSION)): ?>
            <h4><?=$_SESSION['prenom'].' '.$_SESSION['nom'] ?></h4>
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="MediaContent/Images/<?=$_SESSION['role'] ?>.png">
                </a>
                <div class="dropdown-menu disconnect" aria-labelledby="dropdownMenuLink">
                    <a class = "dropdown-item disconnect" href="deconnexion.php">Déconnexion</a>
                </div>
            </div>
            <?php endif;?>
        </div>

    </div>
</header>

<?= $content ?>

<footer class = "text-center">
    <h1>Dernière Modification : 19/03/2020</h1>
    <h3>Mentions légales</h3>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>