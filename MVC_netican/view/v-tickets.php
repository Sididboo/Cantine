<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Netican/Tickets</title>

        <!--CSS-->
        <link rel="stylesheet" href="./habillage/styles/css-tickets.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        
        <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>

        <script src="view/ajax/xhr_object.js"></script>

        <script src="view/ajax/v-tickets_add.js"></script>
        <script src="view/ajax/v-tickets_del.js"></script>
        <script src="view/ajax/v-tickets_categorie.js"></script>
        <script src="view/ajax/v-tickets_commerce.js"></script>
        <script src="view/ajax/v-tickets_upload.js"></script>
    </head>
    <body>
        
        <!-- Header -->
        <?php include './header.html'; ?>

        <div class="containerTickets">

            <h1 class="title">Insertion des tickets</h1>

            <div class="containerFormTab">

                <!--form-->
                <form class="formulaire" action="" method="POST" enctype="multipart/form-data" id="form">
                    
                    <h4 class="titleForm">Formulaire</h4>

                    <!-- Message erreur si champ non remplie -->
                    <p class="error" id="erreur"></p>

                    <div class="divForm">
                        <label class="">Date *</label>
                        <input class="field" type="date" name="date" id="date" required/>
                    </div>

                    <!-- Gestion du menu déroulant pour le choix de la marque -->
                    <div class="divForm">
                        <label class="">Catégorie *</label>
                        <select class="field" name="categories" id="categories" required>
                            <option value="">Choisir une catégorie de ticket</option>
                            <?php
                                for ($i=0; $i < count($listCategoriesTickets); $i++) 
                                { 
                                    echo '<option value="' . $listCategoriesTickets[$i]->get_id() . '">' . $listCategoriesTickets[$i]->get_nom() . '</option>';
                                }                    
                            ?>
                        </select>
                        <p class="">Si la catégorie du ticket n'existe pas : </p>
                        <button class="itemAdd" type="button" onclick="openPopupCategorie()"><i class="fas fa-folder-plus"></i></button>

                        <!-- Popup Catégorie -->
                        <div id="popupCategorie"  style="display: none;">
                            <div>
                                <p>Avant d'ajouter une nouvelle catégorie, pensez à bien vérifier s'elle n'existe pas déjà.</p>
                            </div>
                            <div>
                                <input class="field" type="text" name="categorie" id="categorie" placeholder="Nouvelle catégorie..."/>
                            </div>
                            <div>
                                <button class="buttonItemExit" type="button" onclick="closePopupCategorie()">Fermer</button>
                                <button class="buttonItemAdd" type="button" onclick="addCategorie()">Valider</button>
                            </div>
                        </div>
                    </div>

                    <!-- Gestion du menu déroulant pour le choix du commerce -->
                    <div class="divForm">
                        <label class="">Commerce *</label>
                        <select class="field" name="commerces" id="commerces" required>
                            <option value="">Choisir un commerce</option>
                            <?php
                                for ($i=0; $i < count($listCommerces); $i++) 
                                { 
                                    echo '<option value="' . $listCommerces[$i]->get_id() . '">' . $listCommerces[$i]->get_nom() . '</option>';
                                }
                            ?>
                        </select>
                        <p class="">Si le commerce n'existe pas : </p>
                        <button class="itemAdd" type="button" onclick="openPopupCommerce()"><i class="fas fa-folder-plus"></i></button>

                        <!-- Popup Commerce -->
                        <div id="popupCommerce"  style="display: none;">
                            <div>
                                <p>Avant d'ajouter un nouveau commerce, pensez à bien vérifier s'il n'existe pas déjà.</p>
                            </div>
                            <div>
                                <input class="field" type="text" name="commerce" id="commerce" placeholder="Nouveau commerce..."/>
                            </div>
                            <div>
                                <button class="buttonItemExit" type="button" onclick="closePopupCommerce()">Fermer</button>
                                <button class="buttonItemAdd" type="button" onclick="addCommerce()">Valider</button>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <p class="">* champs obligatoires</p>
                        <!-- Buttons -->
                        <input class="buttonAdd" type="button" value="Ajouter" onclick="addTicket()">
                        <!-- End buttons -->
                    </div>
                </form>
                <!--End form-->
                
                <!-- Tableau qui réference tout les tickets ajoutés dans la base de donnée -->
                <table class="">
                    <thead class="">
                        <tr>
                            <th>Date</th>
                            <th>Commerce</th>
                            <th>Catégorie</th>
                            <th>Pièce Jointe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- Millieu de tableau qui réference les tickets -->
                    <tbody id="tbody">
                        <!--Remplissage en PHP-->
                        <?php
                            for ($i=0; $i < count($listTickets); $i++) 
                            { 
                                ?>
                                    <tr>
                                        <td><?php echo $listTickets[$i]->get_dateTicket(); ?></td>
                                        <td><?php echo $listTickets[$i]->get_leCommerce()->get_nom(); ?></td>
                                        <td><?php echo $listTickets[$i]->get_laCategorie()->get_nom(); ?></td>
                                        <td>
                                            <?php 
                                                if($listTickets[$i]->get_pieceJointe() != NULL)
                                                {
                                                    echo $listTickets[$i]->get_pieceJointe();
                                                }
                                                else
                                                {
                                                    ?>
                                                        <div>
                                                            
                                                            <input class="buttonFile" type="file" name="file" id="file"/>
                                                        </div>
                                                        <div>
                                                            <button class="buttonUpload" type="button" name="upload" onclick="upload(<?php echo $listTickets[$i]->get_id(); ?>)">Upload</button>
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <button class="buttonItemExit" onclick="delTicket('<?php echo $listTickets[$i]->get_id(); ?>')"><i class="fas fa-trash"></i> Supprimer</button>
                                            <a href="./index.php?action=articles&idTicket=<?php echo $listTickets[$i]->get_id(); ?>"><button class="buttonAddArticle"><i class="fas fa-plus"></i> Ajouter articles</button></a>
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