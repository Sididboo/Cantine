<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS-->
        <link rel="stylesheet" href="./habillage/styles/css-header.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!--JS-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/ce45170c32.js"></script>

        <script src="view/ajax/xhr_object.js"></script>
    </head>

    <body>

        <!--header-->
        <?php include "./header.html" ?>


        
        <div class="col-md-8 table-responsive-md">
        <!--titre-->
        <h3>
            <p>
            <i class="fas fa-warehouse fa-fw fa-2x" style="color: #7BED8D; vertical-align: middle;">
            </i> Gestion des stocks</p>
        </h3>


        <!--tableau des stocks-->
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Marque</th>
                        <th>Date d'achat</th> 
                        <th>Péremption</th>
                        <th>Qte</th>
                    </tr>
                </thead>

                <tbody id="tbody">
                    <?php 
                        for ($i=0; $i < count($listProduitsAchetes); $i++) 
                        {
                    ?>
                            <tr>
                                <td><?php echo $listProduitsAchetes[$i][0]->get_leProduit()->get_id(); ?></td>
                                <td><?php echo $listProduitsAchetes[$i][0]->get_leProduit()->get_laMarque()->get_nom(); ?></td>
                                <td><?php echo $listProduitsAchetes[$i][0]->get_dateAchat(); ?></td>
                                <td><?php echo $listProduitsAchetes[$i][0]->get_datePeremption(); ?></td>
                                <td><?php echo $listProduitsAchetes[$i][0]->get_leProduit()->get_quantiteConditionnement(), $listProduitsAchetes[$i][0]->get_leProduit()->get_laUnite()->get_nom(); ?></td>
                    <?php
                        }  
                    ?>
                    
                </tbody>
            </table>
        
        </div>
    </body>

</html>