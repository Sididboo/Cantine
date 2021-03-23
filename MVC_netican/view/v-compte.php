<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Netican/Compte</title>

    <!--CSS-->
    <link rel="stylesheet" href="./habillage/styles/css-global.css">
    <link rel="stylesheet" href="./habillage/styles/css-compte.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./view/ajax/xhr_object.js"></script>
    <script src="./view/ajax/v-compte_update.js"></script>

    <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include './header.html'; ?>
    
    <!-- Container -->
    <div class="divTitle">
        <button class="back" onclick="window.history.back()"><i class="fas fa-arrow-left fa-fw fa-2x"></i></button>
        <h1 class="title">Compte</h1>
        <button class="valid" type="button" onclick="update()"><i class="fas fa-check fa-fw fa-2x"></i></button>
    </div>
    
    <form action="index.php?action=compte" method="POST" class="containerCompte">
    <p style="color:red;" id="error"></p>
        <div class="divForm">
            <p class='titleForm'>Your Information</p>
            <div class="divUser">
                <p class="txt">Username</p>
                <input id="username-field" name="username" type="text" value="<?php echo $_SESSION['user']; ?>" disabled/>
                <button class="btnUser" type="button" onclick="editUser()"><i class="fas fa-edit"></i></button>
            </div>
            <div class="divPassword">
                <p class="txt">Password</p>
                <input id="password-field" type="password" class="field" name="password" value="*******" disabled>
                <button type="button" id="eye" class="far fa-eye-slash field" onclick="seePassword()"></button>
                <button type="button" class="btnPassword" onclick="editPass()"><i class="fas fa-edit"></i></button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function seePassword() {
            let x = document.getElementById("password-field");
            if (!x.disabled) {
                var y = document.getElementById("eye");
                if (x.type == "password") {
                    x.type = "text";
                    y.className = "far fa-eye field";
                } else {
                    x.type = "password";
                    y.className = "far fa-eye-slash field";
                }
            }
        }
        function editUser() {
            let user = document.getElementById('username-field');
            user.disabled = false;
            user.style.backgroundColor = '#fff';
            user.value = '';
        }
        function editPass() {
            let pass = document.getElementById('password-field');
            pass.disabled = false;
            pass.style.backgroundColor = '#fff';
            pass.value = '';
        }
    </script>
</body>
</html>