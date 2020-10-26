<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./habillage/styles/css-header.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container_fluid">
        <div class="container">
            <h2 class="text-center pt-2">Connexion</h2>

            <!-- Formulaire de connexion -->
            <form class="pt-5" action="./index.php?action=dashboard" method="post">

                <div>
                    <?php
                    if (isset($_GET['error'])) {
                        echo $_GET['error'];
                    }
                    ?>
                </div>

                <div class="form-group">
                    <div>
                        <label class="font-weight-bold">Identifiant :</label>
                        <input class="form-control" type="text" name="username" placeholder="Identifiant" required>
                    </div>
                    <div class="pt-3">
                        <label class="font-weight-bold">Mot de passe :</label>
                        <input class="form-control" type="password" name="password" placeholder="Votre mot de passe" required>
                    </div>
                    <div class="pt-4 text-center">
                        <button class="btn btn-primary" type="submit" name="submit">Se connecter</button>
                    </div>
                </div>
            </form>
            <!-- End formulaire de connexion -->

        </div>
    </div>

</body>

</html>