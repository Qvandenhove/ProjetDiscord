<!DOCTYPE html>
<html>
<head>
    <title>DiscordChat</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php
    array_push($stylesheets,'main');
    foreach ($stylesheets as $stylesheet) :?>
        <link rel="stylesheet" type="text/css" href="CSS/<?=$stylesheet ?>.css">
    <?php endforeach; ?>
</head>
<body>
<header>
    <div class="row d-flex align-items-center">
        <div class="col-3 d-flex flex-inline align-items-end menu">
            <?php if(!empty($_SESSION)): ?>
                <a href="index.php?action=myPage" class="btn btn-info  lienMenu">Accueil</a>
                <?php if($_SESSION['role'] > 0):?>
                <div class="dropdown">
                    <a class="btn btn-info dropdown-toggle" href = "" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 5px">
                        Ajouter
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                        <a class = "dropdown-item lienMenu" href="index.php?action=subscribeForm">Utilisateur</a>
                        <?php if($_SESSION['role'] == 2):?>
                        <a class = "dropdown-item lienMenu" href="index.php?action=addClassForm">Classe</a>
                        <?php endif;?>
                    </div>
                </div>
                <a href="index.php?action=searchUsersForm" class = "btn btn-info lienMenu">Gestion</a>
                <?php endif;?>
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
                    <img src="MediaContent/Images/<?=['etudiant','professeur','admin'][$_SESSION['role']] ?>.png">
                </a>
                <div class="dropdown-menu disconnect" aria-labelledby="dropdownMenuLink">
                    <a class = "dropdown-item disconnect" href="index.php?action=disconnect">Déconnexion</a>
                </div>
            </div>
            <?php endif;?>
        </div>

    </div>
</header>

<div class="container d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center">
        <?= $content ?>
    </div>
</div>

<footer class = "text-center">
    <h1>Dernière Modification : 19/03/2020</h1>
    <h3>Mentions légales</h3>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>