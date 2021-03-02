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
    <script src="https://kit.fontawesome.com/ce45170c32.js"></script>

    <script src="view/ajax/xhr_object.js"></script>

    <script src="view/ajax/v-menus_categorie.js"></script>
    <script src="view/ajax/v-search.js"></script>
    <script src="view/ajax/v-menus_add.js"></script>
    <script src="view/ajax/v-ancien_menu.js"></script>
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
                            <input class="form-control" type="date" name="dateMenu" id="dateMenu" required/>
                        </div>

                        <div class="cell_date pt-2">
                            <label class="font-weight-bold">Nombre de convives :</label>
                            <input class="form-control" type="number" name="nbConvives" id="nbConvives" required/>
                        </div>
                        <!-- Gestion du menu déroulant pour le choix de la catégorie du plat  -->
                        <div class="pt-4">
                            <label class="font-weight-bold">Catégorie du plat</label>
                            <select class="form-control" name="categoriesPlat" id="categoriesPlat" onchange="searchPlats()" required>
                                <option value="">Choisir une catégorie du plat</option>
                                <?php
                                    for ($i=0; $i < count($listCategoriesPlats); $i++) 
                                    { 
                                        echo '<option value="' . $listCategoriesPlats[$i]->get_id() . '">' . $listCategoriesPlats[$i]->get_nom() . '</option>';
                                    }                    
                                ?>
                            </select>
                            <span class="text-danger">Si la catégorie du plat n'existe pas : </span>
                            <button type="button" class="btn" onclick="openPopupCategoriePlat()"><i class="fas fa-folder-plus"></i></button>
                             <!-- Popup Catégorie -->
                            <div id="popupCategoriePlat"  style="display: none;">
                                <div>
                                    <p>Avant d'ajouter une nouvelle catégorie, pensez à bien vérifier si elle n'existe pas déjà.</p>
                                </div>
                                <div>
                                    <input type="text" class="form-control w-50" name="categoriePlat" id="categoriePlat" placeholder="Saisir nouvelle catégorie"/>
                                </div>
                                <br>
                                <div>
                                    <button type="button" class="btn btn-primary" onclick="addCategoriePlat()">Valider</button>
                                    <button type="button" class="btn btn-secondary" onclick="closePopupCategoriePlat()">Fermer</button>
                                </div>
                            </div>
                        </div>
                        <!-- Gestion du menu déroulant pour le choix du plat -->
                        <div class="py-4">
                            <label class="font-weight-bold">Plat </label>
                            <select class="form-control" name="plat" id="plat" required>
                                    <?php
                                    for ($i=0; $i < count($listPlats); $i++) 
                                    { 
                                        echo '<option value="' . $listPlats[$i]->get_id() . '">' . $listPlats[$i]->get_nom() . '</option>';
                                    }
                                    ?>
                            </select>  
                            <span class="text-danger"><a href="./index.php?action=creationPlat">Cliquez ici, si le plat n'existe pas</a></span>
                        </div>
                        
                        <div class="pt-3 text-center">
                            <!-- Buttons -->
                            <input class="btn btn-primary" type="button" value="Créer un menu" onclick="addMenus()">
                            <input class="btn btn-primary" type="button" value="Ancien menu" onclick="ancien_menu()">
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
                            <th>Plat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- Millieu de tableau qui réference les tickets -->
                    <tbody id="tbody">
                        <!--Remplissage en PHP-->
                        <?php
                            for ($i=0; $i < count($listContenants); $i++) 
                            { 
                                ?>
                                    <tr>
                                        <td><?php echo $listContenants[$i]->get_leMenu()->get_dateMenu(); ?></td>
                                        <td><?php echo $listContenants[$i]->get_leMenu()->get_nbConvive(); ?></td>
                                        <td><?php echo $listContenants[$i]->get_lePlat()->get_nom(); ?></td>
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

            <!-- Tableau ancien menu -->
            <div class="col-md-8 table-responsive-md float-right">
                <table id="tableAncienMenu" class="table table-bordered table-striped table-hover text-center">

        </div>
        <!--End container_fluid-->
    </body>

</html>
