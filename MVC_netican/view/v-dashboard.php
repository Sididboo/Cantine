<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netican/Dashboard</title>

    <!--CSS-->
    <link rel="stylesheet" href="./habillage/styles/css-dashboard.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
    <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include './header.html'; ?>

    <!-- Contained -->
    <div class="containerDashboard">
        <div class="containerImg">
            <img class="img" src="./habillage/images/23154-ARS.jpg" alt="école d'Ars">
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="3">Menu du jour</th> 
                    </tr>
                </thead>

                <tbody id="tbody">
                    <?php
                    $categ = 0;
                    
                    for ($i=0; $i < count($mesContenants); $i++) { 
                        if($mesContenants[$i]->get_lePlat()->get_laCategorie()->get_id() != $categ){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $mesContenants[$i]->get_lePlat()->get_nom(); ?>
                                </td>
                            </tr>
                            <?php
                        }
                        $categ = $mesContenants[$i]->get_lePlat()->get_laCategorie()->get_id();
                    }
                    ?>
                </tbody>
            </table>
        <div>
        <?php
            $categ = 0;
            for ($i=0; $i < count($mesContenants); $i++) { 
                if($mesContenants[$i]->get_lePlat()->get_laCategorie()->get_id() != $categ){
                   ?> <div>Séparation visuelle</div> <?php
                }
                ?> <p> <?php
                echo $mesContenants[$i]->get_lePlat()->get_nom();
                ?> </p> <?php
                $categ = $mesContenants[$i]->get_lePlat()->get_laCategorie()->get_id();
            }
        ?>
        </div>
</body>

</html>