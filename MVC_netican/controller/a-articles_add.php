<?php
    session_start();

    if (
            isset($_REQUEST['code']) && 
            isset($_REQUEST['ingredient']) &&
            isset($_REQUEST['marque']) &&
            isset($_REQUEST['pays']) &&
            isset($_REQUEST['typeC']) &&
            isset($_REQUEST['quantiteC']) &&
            isset($_REQUEST['unite']) &&
            isset($_REQUEST['nbArticles']) &&
            isset($_REQUEST['dateP']) 
        ) 
    {
        include_once '../model/tickets.php';
        include_once '../model/marques.php';
        include_once '../model/pays.php';
        include_once '../model/unites.php';
        include_once '../model/ingredients.php';
        include_once '../model/typesConditionnements.php';
        include_once '../model/produitsAchetes.php';
        include_once '../model/produits.php';
    
        $leTicket = new Tickets();
        $leTicket->retrieve($_SESSION['idTicket']);
    
        // Risque changer, si résolution du problème "Code-Barre".
        $leProduit = new Produits();

        if (strlen($_REQUEST['code'] > 0)) 
        {
            $leProduit->retrieveByCodeBarre($_REQUEST['code']);  
        }
        
        if (strlen($leProduit->get_id()) > 0) 
        {
            $leProduitAchete = new ProduitsAchetes("", $leTicket, $leProduit, "", $_REQUEST['dateP'], "", "");
            $leProduitAchete->create();
        }
            else 
            {
                $lePays = new Pays();
                $lePays->retrieve($_REQUEST['pays']);

                $laMarque = new Marques();
                if (strlen($_REQUEST['marque']) > 0) 
                {
                    $laMarque->retrieve($_REQUEST['marque']);
                }
                
                $laUnite = new Unites();
                $laUnite->retrieve($_REQUEST['unite']);

                $leTypeConditionnement = new TypesConditionnements();
                $leTypeConditionnement->retrieve($_REQUEST['typeC']);

                $leIngredient = new Ingredients();
                $leIngredient->retrieve($_REQUEST['ingredient']);

                $leProduit = new Produits("", $lePays, $laMarque, $laUnite, $leTypeConditionnement, $leIngredient, $_REQUEST['code'], $_REQUEST['quantiteC']);
                $leProduit->create();
                $leProduit->retrieveByCodeBarre($_REQUEST['code']);

                $leProduitAchete = new ProduitsAchetes("", $leTicket, $leProduit, "", $_REQUEST['dateP'], "", "");
                $leProduitAchete->create();
            }

            $listProduitsAchetes = array();

            $listProduitsAchetes = $leProduitAchete->findByTicket($_SESSION['idTicket']);
            for ($i=0; $i < count($listProduitsAchetes); $i++) 
            { 
                echo '<tr>';
                    echo '<td>'.$listProduitsAchetes[$i]->get_leProduit()->get_leIngredient()->get_nom().'</td>';
                    echo '<td>'.$listProduitsAchetes[$i]->get_leProduit()->get_laMarque()->get_nom().'</td>';
                    echo '<td>'.$listProduitsAchetes[$i]->get_leProduit()->get_lePays()->get_nom().'</td>';
                    echo '<td>'.$listProduitsAchetes[$i]->get_leProduit()->get_leTypeConditionnement()->get_nom().'</td>';
                    echo '<td>'.$listProduitsAchetes[$i]->get_leProduit()->get_quantiteConditionnement().'</td>';
                    echo '<td>'.$listProduitsAchetes[$i]->get_leProduit()->get_laUnite()->get_nom().'</td>';
                    echo '<td>'.$listProduitsAchetes[$i]->get_datePeremption().'</td>';
                    echo '<td><button type="button" onclick="delArticle('.$listProduitsAchetes[$i]->get_id().')"><i class="fas fa-trash"></i>Supprimer</button></td>';
                echo '</tr>';
            }
    }
?>