<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS-->
    <link rel="stylesheet" href="./habillage/styles/css-tickets.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

        <!-- Header -->
        <?php include './header.html'; ?>

        <div class="containerTickets">

            <h1 class="title">Insertion du menu journalier</h1>

            <div class="containerFormTab">

                <!--form-->
                <form class="formulaire" action="" method="POST" enctype="multipart/form-data" id="form">
                    
                    <h4 class="titleForm">Formulaire</h4>

                    <!-- Message erreur si champ non remplie -->
                    <p class="error" id="erreur"></p>

                    <!-- Message erreur si champ non remplie -->
                    <p class="text-warning" id="erreur"></p>

                    <div class="divForm">
                    <div class="divForm">
                        <label class="">Date du service</label>
                        <input class="field" type="date" name="date" id="date" required/>
                    </div>

                        
                        <div class="divForm">
                            <label class="">nombre de convives :</label>
                            <input class="field" type="number" name="nbConvives" id="nbConvives" required/>
                        </div>
                        <!-- Gestion du menu déroulant pour le choix de la catégorie du plat  -->
                        <div class="divForm">
                            <label class="">Catégorie du plat</label>
                            <select class="field" name="categoriesPlat" id="categoriesPlat" onchange="searchPlats()" required>
                                <option value="">Choisir une catégorie du plat</option>
                                <?php
                                    for ($i=0; $i < count($listCategoriesPlats); $i++) 
                                    { 
                                        echo '<option value="' . $listCategoriesPlats[$i]->get_id() . '">' . $listCategoriesPlats[$i]->get_nom() . '</option>';
                                    }                    
                                ?>
                            </select>
                            <p class="">Si la catégorie du plat n'existe pas : </p>
                            <button type="itemAdd" type="button" onclick="openPopupCategoriePlat()"><i class="fas fa-folder-plus"></i></button>
                            
                             <!-- Popup Catégorie -->
                            <div id="popupCategoriePlat"  style="display: none;">
                                <div>
                                    <p>Avant d'ajouter une nouvelle catégorie, pensez à bien vérifier si elle n'existe pas déjà.</p>
                                </div>
                                <div>
                                <input class="field" type="text" name="categorie" id="categorie" placeholder="Nouvelle catégorie..."/>
                                </div>
                                <br>
                                <div>
                                    <button class="buttonItemExit" type="button" onclick="addCategoriePlat()">Valider</button>
                                    <button class="buttonItemAdd" type="button" onclick="closePopupCategoriePlat()">Fermer</button>
                                </div>
                            </div>
                        </div>

                        <!-- Gestion du menu déroulant pour le choix du plat -->
                        <div class="divForm">
                        <label class="">Plat </label>
                            <select class="field" name="plat" id="plat" required>
                                    <?php
                                    for ($i=0; $i < count($listPlats); $i++) 
                                    { 
                                        echo '<option value="' . $listPlats[$i]->get_id() . '">' . $listPlats[$i]->get_nom() . '</option>';
                                    }
                                    ?>
                            </select>  
                            <p class=""><a href="./index.php?action=creationPlat">Cliquez ici, si le plat n'existe pas</a></span>
                        </div>

                        <div class="">
                            <!-- Buttons -->
                            <input class="buttonAdd" type="button" value="Ajouter" onclick="addRecap()">
                                    
                            <input class="buttonAdd" type="button" value="Créer le menu " onclick="addMenus()">
                            <!-- End buttons -->
                        </div>
                    </div>
                    <!--End form-group-->
                </form>
                <!--End form-->
            
                <!-- Tableau qui réference tout les tickets ajoutés dans la base de donnée -->
                <table class="">
                    <thead class="">
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
                                        <td class="actions">
                                            <button class="buttonItemExit" onclick="delMenus('<?php echo $listContenants[$i]->get_leMenu()->get_dateMenu(); ?>')"><i class="fas fa-trash"></i> Supprimer</button>
                            
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
            
        <!--End container_fluid-->
    </body>

</html>
