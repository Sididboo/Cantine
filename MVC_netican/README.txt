#NETICAN---Cantine

BDD = "cantine_ppe"

username = "user"
password = "caribou"

Problème à résoudre :
    - Objectif
        Uploader l'image en AJAX
            - Problème 
                Erreur venant le l'object FormData, "undefined index : file" dès que l'on souhaite récupérer "$_FILES['file']" dans le controller "a-tickets_upload.php".