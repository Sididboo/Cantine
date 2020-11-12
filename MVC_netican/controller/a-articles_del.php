<?php
    session_start();

    if (isset($_REQUEST['idProduitAchete']))
    {
        include_once '../model/produitsAchetes.php';
        include_once '../model/produits.php';
    
        $leTicket = new Tickets();
        $leTicket->retrieve($_SESSION['idTicket']);
    
        $leProduitAchete = new ProduitsAchetes();
        $leProduitAchete->retrieve($_REQUEST['idProduitAchete']);
        $leProduitAchete->delete();

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