<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./habillage/styles/css-global.css">
    <link rel="stylesheet" href="./habillage/styles/css-init.css">
    
    <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="containerInit">

        <div class="divTitle">
            <i class="fas fa-seedling fa-fw fa-2x logo"></i>
            <p class="title">Connexion</p>
        </div>

        <!-- Formulaire de connexion -->
        <form class="containerForm" action="./index.php?action=dashboard" method="post">

            <div class="error">
                <?php
                    // Si en méthode GET il y a "erreur", on l'affiche
                    if (isset($_GET['error'])) 
                    {
                        echo $_GET['error'];
                    }
                ?>
            </div>
            
            <div class="divInput">
                <i class="fas fa-user"></i>
                <input class="input" type="text" name="username" placeholder="Identifiant" required>
            </div>
            <div class="divInput">
                <i class="fas fa-key"></i>
                <input class="input" type="password" name="password" placeholder="Mot de passe" required>
            </div>
            
            <input class="button" type="submit" name="submit" value="-> Se connecter"/>
        </form>
        <!-- End formulaire de connexion -->

    </div>
</body>

</html>