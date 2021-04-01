<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netican/Menus</title>
    <!--CSS-->
    <link rel="stylesheet" href="./habillage/styles/css-menus.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>
    <script src="view/ajax/xhr_object.js"></script>
    <script src="view/ajax/xhr_object.js"></script>
    <script src="view/ajax/v-menus_categorie.js"></script>
    <script src="view/ajax/v-search.js"></script>
    <script src="view/ajax/v-menus_add.js"></script>
    <script src="view/ajax/v-menus_del.js"></script>
    <script src="view/ajax/v-ancien_menu.js"></script>
  </head>
    <body>
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

                    <div class="divForm">
                        <label class="">Date du service : </label>
                        <input class="field" type="date" name="date" id="dateMenu" required/>
                    </div>
                        
                    <div class="divForm">
                        <label class="">Nombre de convives :</label>
                        <input class="field" type="number" name="nbConvives" id="nbConvives" required/>
                    </div>
                        <!-- Gestion du menu déroulant pour le choix de la catégorie du plat  -->
                        <div class="divForm">
                            <label class="">Catégorie du plat :</label>
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
                                    <input class="field" type="text" name="categorie" id="categoriePlat" placeholder="Nouvelle catégorie..."/>
                                </div>
                                <div>
                                    <button class="buttonItemExit" type="button" onclick="addCategoriePlat()">Valider</button>
                                    <button class="buttonItemAdd" type="button" onclick="closePopupCategoriePlat()">Fermer</button>
                                </div>
                            </div>
                        </div>
                        <!-- Gestion du menu déroulant pour le choix du plat -->
                        <div class="divForm">
                            <label class="">Plat :</label>
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
                            <!-- Buttons -->
                            <input class="buttonAdd" type="button" value="Ajouter" onclick="addMenus()">
                            <!-- End buttons -->
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
                                            <button class="buttonItemExit" onclick="delMenus('<?= $listContenants[$i]->get_leMenu()->get_dateMenu() ?>', <?= $listContenants[$i]->get_lePlat()->get_id() ?>)"><i class="fas fa-trash"></i> Supprimer</button>
                                        </td>
                                    </tr>
                                <?php
                            }
                                ?>
                    </tbody>
                </table>
            </div>  
        </div>
    </body>
</html>
