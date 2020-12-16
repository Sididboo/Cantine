#NETICAN---Cantine

BDD = "cantine_ppe"

username = "user"
password = "caribou"

Problème à résoudre :
    - Objectif
        Uploader l'image en AJAX
            - Problème 
                Erreur venant le l'object FormData, "undefined index : file" dès que l'on souhaite récupérer "$_FILES['file']" dans le controller "a-tickets_upload.php".
            - Réponse
                Erreur résolu en enlevant le "xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");"
        Code-Barre
            - Problème
                Un code-barre n'est pas unique (dans une boutique oui, mais il se peut qu'une autre boutique utilise le même).
            - Réponse
                Un fabricant de produits courant, utilise le même code-barre (reste à confirmer).

Proposition : 
    - Pour la page des tickets peut-être faire un récapitulatif des aliments ajoutés.
    
Missions :
    - Design à faire sur toutes les pages pour la personne qui souhaite le faire.
    - Classe global à créer pour notamment les lists complète (listUnites, listPays ...).

Questions pour la cantinière :
    - Êtes-vous la seule qui utilisera l'application web ?
        - Enjeux -> création des utilisateurs à l'avance.
    - Avez-vous une liste des catégories de ticket ?
        - Enjeux -> création à l'avance des catégories tickets.
    - 
