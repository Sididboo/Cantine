<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        
        <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>

        <script src="view/ajax/xhr_object.js"></script>

    </head>

    <body>

        <!--header-->
        <?php include "./header.html" ?>

        <div class="col-md-8 table-responsive-md">

        <!--titre-->
        <h3>
            <p>
            <i style="color: #7BED8D; vertical-align: middle;">
            </i> Gestion des stocks</p>
        </h3>

        <!--tableau des stocks-->
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Produit</th>
                        <th>Marque</th>
                        <th>Origine</th>
                        <th>Conditionnement</th>
                        <th>Volume unité</th>
                        <th>Péremption (AAAA/MM/JJ)</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="tbody">
                    <?php 
                        for ($i=0; $i < count($listProduitsAchetes); $i++) 
                        {
                    ?>
                        <tr>
                            <td><?php echo $listProduitsAchetes[$i][0]->get_leProduit()->get_leIngredient()->get_nom(); ?></td>
                            <td><?php echo $listProduitsAchetes[$i][0]->get_leProduit()->get_laMarque()->get_nom(); ?></td>
                            <td><?php echo $listProduitsAchetes[$i][0]->get_leProduit()->get_lePays()->get_nom(); ?></td>
                            <td><?php echo $listProduitsAchetes[$i][0]->get_leProduit()->get_leTypeConditionnement()->get_nom(); ?></td>
                            <td><?php echo $listProduitsAchetes[$i][0]->get_leProduit()->get_quantiteConditionnement(), 
                                " ", $listProduitsAchetes[$i][0]->get_leProduit()->get_laUnite()->get_nom(), "(s)"; ?></td>
                            <td><?php echo $listProduitsAchetes[$i][0]->get_datePeremption(); ?></td>
                            <td></td>
                            <td><button class="buttonItemExit" type="button" onclick=""><i class="fas fa-trash"></i>Supprimer</button></td>
                        </tr>
                    <?php
                        }
                    ?>

        <!--Actualiser le tableau (pas encore de méthode)-->
            <button class="btn btn-secondary" onclick=""><i class="fas fa-circle-notch"></i> Actualiser</button>
            <?php echo "à faire: bouton actualiser et colonne 'Stock'"?>
                    
                </tbody>
            </table>
        
        </div>
    </body>

</html>