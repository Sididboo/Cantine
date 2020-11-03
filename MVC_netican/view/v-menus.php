<!DOCTYPE html>
<html lang="fr">
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
    <script src="https://kit.fontawesome.com/390bd29166.js"></script>
    <script src="view/js/xhr_object.js"></script>
    <script src="view/js/v-menu_add.js"></script>
  </head>
    <body>
        
        <!-- Header -->
        <?php include './header.html'; ?>

        <div class="container-fluid">

            <h3 class="text-center font-weight-bold py-3">Insertion du menu journalier </h3>

            <div class="row p-4">

                <div class="col-md-4 bg-light">

                <!--form-->
                <form action="" method="POST" enctype="multipart/form-data">
                    <!--title-->
                    <h4 class="pt-3 text-center font-weight-bold">Formulaire</h4>

                    <!-- Message erreur si champ non remplie -->
                    <p class="text-warning" id="erreur"></p>

                    <div class="form-group">

                        <div class="cell_date pt-2">
                            <label class="font-weight-bold">Date du service :</label>
                            <input class="form-control" type="date" name="dateService" id="dateService" required/>
                        </div>

                        <div class="cell_date pt-2">
                            <label class="font-weight-bold">nombre de convives :</label>
                            <input class="form-control" type="number" name="nbConvives" id="nbConvives" required/>
                        </div>
                        <!-- Gestion du menu déroulant pour le choix de la catégorie du plat  -->
                        <div class="pt-4">
                            <label class="font-weight-bold">Catégorie du plat</label>
                            <select class="form-control" name="categoriePlat" id="categoriePlat" required>
                                <option value="">Choisir une catégorie du plat</option>
                                <?php
                                    for ($i=0; $i < count($listCategoriesPlats); $i++) 
                                    { 
                                        echo '<option value="' . $listCategoriesPlats[$i]->get_id() . '">' . $listCategoriesPlats[$i]->get_nom() . '</option>';
                                    }                    
                                ?>
                            </select>
                            <span class="text-danger">Si la catégorie du plat n'existe pas : </span>
                            <a href="./index.php?action=AddCatPlat"><button type="button" class="btn"><i class="fas fa-folder-plus"></i></button></a>
                        </div>
                        <!-- Gestion du menu déroulant pour le choix du commerce -->
                        <div class="py-4">
                            <label class="font-weight-bold">Plat </label>
                            <select class="form-control" name="plat" id="plat" required>
                                <option value="">Choisir un plat : </option>
                                    <?php
                                    for ($i=0; $i < count($listPlats); $i++) 
                                    { 
                                        echo '<option value="' . $listPlats[$i]->get_id() . '">' . $listPlats[$i]->get_nom() . '</option>';
                                    }
                                    ?>
                                
                            </select>
                            <span class="text-danger">Si le plat n'existe pas : </span>
                            <a href="./index.php?action=addPlat"><button type="button" class="btn"><i class="fas fa-folder-plus"></i></button></a>
                        </div>
                        <div class="pt-3 text-center">
                            <!-- Buttons -->
                            <input class="btn btn-primary" type="button" value="Ajouter" onclick="addMenus()">
                            <!-- End buttons -->
                        </div>
                    </div>
                    <!--End form-group-->
                </form>
                <!--End form-->
            </div>

            <div class="col-md-8 table-responsive-md">
                <!-- Tableau qui réference tout les tickets ajoutés dans la base de donnée -->
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date du service</th>
                            <th>Nombre de convives</th>
                            <th>Catégorie du plat</th>
                            <th>Plat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- Millieu de tableau qui réference les tickets -->
                    <tbody id="tbody">
                        <!--Remplissage en PHP-->
                        <?php
                            for ($i=0; $i < count($listMenus); $i++) 
                            { 
                                ?>
                                    <tr>
                                        <td><?php echo $listMenus[$i]->get_dateMenu(); ?></td>
                                        <td><?php echo $listMenus[$i]->get_nbConvives();?></td>
                                        <td><?php echo $listMenus[$i]->get_lePlat()->get_nom(); ?></td>
                                        <td><?php echo $listMenus[$i]->get_laCategorie()->get_nom(); ?></td>
                                     <!--   <td>
                                            <button class="btn btn-primary" onclick="deleteTicket('<?php echo $listTickets[$i]->get_id(); ?>', '<?php echo $listTickets[$i]->get_pieceJointe(); ?>')"><i class="fas fa-trash"></i> Supprimer</button>
                                            <a href="./index.php?action=articles&idTicket=<?php echo $listTickets[$i]->get_id(); ?>"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter articles</button></a>
                                        </td> -->
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            <!-- Fin de tableau -->
            </div>

            </div>
            <!--End row-->
        </div>
        <!--End container_fluid-->
    </body>
</html>