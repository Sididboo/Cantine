function update() {
    let username = document.getElementById('username-field').value;
    let password = document.getElementById('password-field').value;
    let error = document.getElementById('error');

    let match = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,}$/;

    if (username) {
        if(password) {
            if(password.match(match)) {
                error.value = '';
                $.ajax({
                    url : 'controller/a-compte_update.php',
                    type : 'POST',
                    data : {username: username, password: password},
                    dataType : 'text',
                    success : function(text, statut) { 
                        error.innerHTML = text;
                    },
                    error : function(resultat, statut, erreur) {
                        console.log(erreur);
                    }
                });
            }
            else {
                error.innerHTML = 'Votre mot de passe doit contenir au moins : 8 caractères, 1 majuscule, 1 minuscule, un chiffre et un caractère spécial.';
            }
        }
        else {
            error.innerHTML = 'Valeur manquante dans le champ password.';
        }
    }
    else {
        error.innerHTML = 'Valeur manquante dans le champ username.';
    }
}