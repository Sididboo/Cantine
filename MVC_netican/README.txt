#NETICAN---Cantine

BDD = "cantine_ppe"

username = "user"
password = "caribou"

Problème à résoudre :
    - Objectif
        Uploader l'image en AJAX
            - Problème 
                Erreur venant le l'object FormData, "undefined index : file" dès que l'on souhaite récupérer "$_FILES['file']" dans le controller "a-tickets_upload.php".
        Code-Barre
            - Problème
                Un code-barre n'est pas unique (dans une boutique oui, mais il se peut qu'une autre boutique utilise le même).
                
Missions :
    - Design à faire sur toutes les pages pour la personne qui souhaite le faire.

Questions pour la cantinière :
    - Êtes-vous la seule qui utilisera l'application web ?
        - Enjeux -> création des utilisateurs à l'avance.
    - 
