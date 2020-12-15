<?php
    // On vérifie que le code (codeBarre) est passé en methode GET
    if (isset($_REQUEST['code'])) 
    {
        // On inclus les models :
        include_once '../model/produits.php';
        include_once '../model/marques.php';
        include_once '../model/pays.php';
        include_once '../model/typesConditionnements.php';
        include_once '../model/unites.php';
        include_once '../model/categoriesIngredients.php';

        // On recherche le produit avec le code (codeBarre) passé en methode GET
        $leProduit = new Produits();
        $leProduit->retrieveByCodeBarre($_REQUEST['code']);

        // On créé une varible qui va récupéré les données du produit qui a ce code (codeBarre)
        $dataProduit = '<option value="'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_laCategorie()->get_id().'" selected>'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_laCategorie()->get_nom().'</option>;';
        $dataProduit .= '<option value="'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_id().'" selected>'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_nom().'</option>;';
        $dataProduit .= '<option value="'.$leProduit->get_leIngredient()->get_id().'" selected>'.$leProduit->get_leIngredient()->get_nom().'</option>;';
        $dataProduit .= '<option value="'.$leProduit->get_laMarque()->get_id().'" selected>'.$leProduit->get_laMarque()->get_nom().'</option>;';
        $dataProduit .= '<option value="'.$leProduit->get_lePays()->get_id().'" selected>'.$leProduit->get_lePays()->get_nom().'</option>;';
        $dataProduit .= '<option value="'.$leProduit->get_leTypeConditionnement()->get_id().'" selected>'.$leProduit->get_leTypeConditionnement()->get_nom().'</option>;';
        $dataProduit .= $leProduit->get_quantiteConditionnement().';';
        $dataProduit .= '<option value="'.$leProduit->get_laUnite()->get_id().'" selected>'.$leProduit->get_laUnite()->get_nom().'</option>;';

        // Si l'id du produit nest pas vide,
        if (!empty($leProduit->get_id())) 
        {
            // on ajoute 1 (pourrait être une autre valeur) pour le fichier js traite cette information
            $dataProduit .= '1';
        } // Sinon on donne les list completes (marques, pays ...) pour remetre par default les champs du formulaire
        else
        {
            // Listes des différentes listes déroulante du formulaire
            $listCategoriesIngredients = array();
            $listMarques = array();
            $listPays = array();
            $listTypesConditionnements = array();
            $listUnites = array();

            // List catégories ingredients
            $laCategorieIngredient = new CategoriesIngredients();
            $listCategoriesIngredients = $laCategorieIngredient->findAll();
            $dataProduit .= '<option value="0">Choisir une catégorie</option>';
            for ($i=0; $i < count($listCategoriesIngredients); $i++) 
            { 
                $dataProduit .= '<option value="'.$listCategoriesIngredients[$i]->get_id().'">'.$listCategoriesIngredients[$i]->get_nom().'</option>';
            }
            // Ajouter le ";" permet ensuite de le séparer dans un tableau en JS
            // (On aurait pu mettre une autre valeur mais)
            $dataProduit .= ';';

            // List marques
            $laMarque = new Marques();
            $listMarques = $laMarque->findAll();
            $dataProduit .= '<option value="0">Choisir la marque</option>';
            for ($i=0; $i < count($listMarques); $i++) 
            { 
                $dataProduit .= '<option value="'.$listMarques[$i]->get_id().'">'.$listMarques[$i]->get_nom().'</option>';
            }
            $dataProduit .= ';';

            // List pays
            $lePays = new Pays();
            $listPays = $lePays->findAll();
            for ($i=0; $i < count($listPays); $i++) 
            { 
                if ($listPays[$i]->get_nom() == 'France') 
                {
                    $dataProduit .= '<option value="'.$listPays[$i]->get_id().'" selected>'.$listPays[$i]->get_nom().'</option>';
                }
                else 
                {
                    $dataProduit .= '<option value="'.$listPays[$i]->get_id().'">'.$listPays[$i]->get_nom().'</option>';
                }
            }
            $dataProduit .= ';';

            // List typesConditionnements
            $leTypeConditionnement = new TypesConditionnements();
            $listTypesConditionnements = $leTypeConditionnement->findAll();
            $dataProduit .= '<option value="0">Choisir le type de conditionnement</option>';
            for ($i=0; $i < count($listTypesConditionnements); $i++) 
            { 
                $dataProduit .= '<option value="'.$listTypesConditionnements[$i]->get_id().'">'.$listTypesConditionnements[$i]->get_nom().'</option>';
            }
            $dataProduit .= ';';

            // List unites
            $laUnite = new Unites();
            $listUnites = $laUnite->findAll();
            $dataProduit .= '<option value="0">Choisir une unité</option>';
            for ($i=0; $i < count($listUnites); $i++) 
            { 
                $dataProduit .= '<option value="'.$listUnites[$i]->get_id().'">'.$listUnites[$i]->get_nom().'</option>';
            }
        }

        echo $dataProduit;
    }
?>