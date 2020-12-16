<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Netican/Compte</title>

    <!--CSS-->
    <link rel="stylesheet" href="./habillage/styles/css-compte.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
    <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function seePassword() {
            var x = document.getElementById("password-field");
            var y = document.getElementById("eye");
            if (x.type == "password") {
                x.type = "text";
                y.className = "far fa-eye field";
            } else {
                x.type = "password";
                y.className = "far fa-eye-slash field";
            }
        }
    </script>
</head>
<body>
    <?php include './header.html'; ?>
    
    <!-- Container -->
    <div class="containerCompte">
        <div class="divTitle">
            <h1 class="title">Compte</h1>
        </div>
        <div>
            <div>
                <div>
                    <input type="text" value="<?php echo $_SESSION['user']; ?>" disabled/>
                    <button><i class="fas fa-edit"></i></button>
                </div>
                <div>
                    <input id="password-field" type="password" class="field" name="password" value="">
                    <span id="eye" class="far fa-eye-slash field" onclick="seePassword()"></span>
                    <button><i class="fas fa-edit"></i></button>
                </div>
            </div>
            <div>
                <button>Enregistrer</button>
            </div>
        </div>
    </div>
</body>
</html>