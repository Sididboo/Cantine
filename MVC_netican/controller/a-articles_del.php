<?php
    // On récupère la session en cours
    session_start();

    // On vérifie que l'idProduitAchete est présent en methode GET
    if (isset($_REQUEST['idProduitAchete']))
    {
        // On inclut les models :
        include_once '../model/produitsAchetes.php';
        include_once '../model/produits.php';
        
        // On recherche le ticket avec l'idTicket stocké en variable de session
        $leTicket = new Tickets();
        $leTicket->retrieve($_SESSION['idTicket']);
    
        // On recherche le produitAchete avec l'idProduitAchete passé en methode GET
        $leProduitAchete = new ProduitsAchetes();
        $leProduitAchete->retrieve($_REQUEST['idProduitAchete']);
        // On le supprime
        $leProduitAchete->delete();

        $lesProduitsAchetes = $leProduitAchete->findByIdProduit($leProduitAchete->get_leProduit()->get_id());
        if (count($lesProduitsAchetes) < 1) 
        {
            $leProduit = new Produits();
            $leProduit->retrieve($leProduitAchete->get_leProduit()->get_id());
            $leProduit->delete($leProduit->get_id());
        }

        // liste des produits achetés
        $listProduitsAchetes = array();

        // On renseigne la liste des produits achetés qui on l'idTicket récupéré en variable de session
        $listProduitsAchetes = $leProduitAchete->findByTicket($_SESSION['idTicket']);
        // On parcours la liste pour générer les lignes du tableau
        for ($i=0; $i < count($listProduitsAchetes); $i++) 
        { 
            ?>
                <tr>
                    <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_leIngredient()->get_nom(); ?></td>
                    <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_laMarque()->get_nom(); ?></td>
                    <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_lePays()->get_nom(); ?></td>
                    <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_leTypeConditionnement()->get_nom(); ?></td>
                    <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_quantiteConditionnement(); ?></td>
                    <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_laUnite()->get_nom(); ?></td>
                    <td><?php echo $listProduitsAchetes[$i]->get_datePeremption(); ?></td>
                    <td><button class="buttonItemExit" type="button" onclick="delArticle(<?php echo $listProduitsAchetes[$i]->get_id(); ?>)"><i class="fas fa-trash"></i>Supprimer</button></td>
                </tr>
            <?php
        }
    }
?>