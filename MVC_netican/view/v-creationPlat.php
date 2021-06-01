<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="./habillage/styles/css-header.css"> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>

  <!-- Script Ajax -->
  <!-- <script src="view/ajax/xhr_object.js"></script> -->
  <script src="view/ajax/v-search.js"></script>
  <script src="view/ajax/xhr_object.js"></script>
  <script src="view/ajax/v-articles_ingredient.js"></script>
  <script src="view/ajax/v-creationPlat.js"></script>




  <title>Document</title>
</head>

<body>

  <?php include "./header.html" ?>

  <!-- Titre de la page -->
  <div class="container">
    <h1>
      <p class="mt-4">
        <i class="fas fa-utensils fa-fw fa-2x" style="color: #7BED8D; vertical-align: middle;">
        </i>Liste des plats
      </p>
    </h1>

    <!-- Button d'ajout du tableau -->

    <div class="container actionButton mb-2">
      <div class="row">
        <div class="col-2">
          <button class="btn btn-light" type="button" id="addSomething" data-toggle="modal" data-target="#ajoutModal">Ajouter</a>
        </div>
      </div>
    </div>

    <!-- Tableau récapitulatif -->
    <div class="table-responsive mainInfo">
      <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">Nom des plats</th>
            <th scope="col">Nombre de personne</th>
            <th scope="col">Ingrédient</th>
            <th id="popOver" scope="col">Actions</th>
          </tr>
        </thead>


        <!-- // SECTION Tableau récapitulatif des plats avec les ingrédients qui les composent -->


        <tbody id="tableShow">
          <?php
          for ($i = 0; $i < count($selectLesPlats); $i++) {
          ?>
            <tr>
              <td value='<?php echo $selectLesPlats[$i]->get_id() ?>'><?php echo $selectLesPlats[$i]->get_nom() ?></td>
              <td><?php echo $selectLesPlats[$i]->get_nbPersonne() ?></td>
              <td>
                <?php


                $tableauIng =  $lesIngredients->findAllByIdPlat($selectLesPlats[$i]->get_id());

                echo "<ul class='list-group list-group-flush'>";
                for ($j = 0; $j < count($tableauIng); $j++) {
                  echo "<li class='list-group-item'>" . $tableauIng[$j]->get_leIngredient()->get_nom() . " | Qté : " . $tableauIng[$j]->get_dose() . "</li>";
                }
                echo "</ul>";

                ?>
              </td>
              <td>
                <button value="<?php echo $selectLesPlats[$i]->get_id(); ?>" class="btn btn-danger" type="button" id="deletePlat">Supprimer</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


    <!-- // SECTION Modal pour l'ajout d'un plat et des ingrédients dans le tableau -->



    <div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="" method="POST" id="formPlat">
          <div class="modal-content" id="modalPlat">
            <div class="modal-header">
              <h2>Formulaire</h2>
              <p class="text-danger fw-bold" id="erreur"></p>
            </div>

            <div class="modal-body">

              <div class="container-fluid">
                <div class="row">
                  <div class="col">

                    <label for="nomPlat" class="mt-2">Nom du plat</label>
                    <input class="form-control" type="text" name="nomPlat" id="nomPlat" placeholder="Entrer le nom plat">



                    <label for="nbPersonne" class="mt-2">Nombre de personne <a href="#" role="button" class="popover-test" title="Informations" data-content="Ceci correspond au nombre de personne concerné par le plat"><i class="fas fa-question-circle"></i></a></label>
                    <input class="form-control" type="number" name="nbPersonne" id="nbPersonne">



                    <label for="getCategorie" class="mt-2">Catégorie de plat</label>
                    <select class="form-control" id="categoriesPlat" name='categoriesPlat' onchange="" required>
                      <option value="0" id="selectCateg">Choisir une catégorie de plat</option>
                      <?php
                      for ($i = 0; $i < count($tableStock); $i++) {
                      ?>
                        <option value="<?php echo $tableStock[$i]->get_id(); ?>"><?php echo $tableStock[$i]->get_nom(); ?> </option>
                      <?php
                      }
                      ?>
                    </select>

                    <p class="mt-4">Si la catégorie du ticket n'existe pas : </p>
                    <button class="itemAdd btn" type="button" onclick="openPopupCategorie()"><i class="fas fa-folder-plus"></i></button>


                    <!-- !Popup Catégorie -->
                    <div class="form-group" id="popupCategorie" style="display: none;">
                      <div>
                        <p id="error" style="color: red;"></p>
                        <p>Avant d'ajouter une nouvelle catégorie, pensez à bien vérifier s'elle n'existe pas déjà.</p>
                      </div>
                      <div>
                        <input class="form-control" type="text" name="categorie" id="categorieNewPlat" placeholder="Nouvelle catégorie..." />
                      </div>
                      <div class="mt-2">
                        <button class="buttonItemExit btn btn-light" type="button" onclick="closePopupCategorie()">Fermer</button>
                        <button class="buttonItemAdd btn btn-light" type="button" id="addCateg" onclick="AjoutCategorie()">Valider</button>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="row mt-2">
                      <label>Catégorie ingrédient</label>
                      <select class="form-control" id="categories" name="categories" onchange="searchSousCategories()" required>
                        <option value="0">Choisir une catégorie d'ingrédient</option>
                        <?php
                        for ($i = 0; $i < count($tableStockIng); $i++) {
                        ?>
                          <option value="<?php echo $tableStockIng[$i]->get_id(); ?>"> <?php echo $tableStockIng[$i]->get_nom(); ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="row mt-2">
                      <label>Sous catégorie ingrédient</label>
                      <select class="form-control" id="sousCategories" name="sousCategories" onchange="searchIngredients()" disabled>
                        <option value="0"></option>
                      </select>
                    </div>

                    <div class="row mt-2">
                      <label>Ingrédient</label>
                      <select class="form-control" id="ingredients" name="ingredients" disabled>
                        <option value="0"></option>
                      </select>
                    </div>

                    <div class="row mt-2">
                      <div class="col-6">
                        <label for="qteIng">Quantité</label>
                        <input class="form-control" type="number" id="qteIng" name="qteIng">
                      </div>
                      <div class="col-6">
                        <label for="unitIng">Unité de mesure</label>
                        <select class="form-control" name="unitIng" id="unitIng">
                          <?php
                          for ($i = 0; $i < count($allUnite); $i++) {
                          ?>
                            <option value="<?php echo $allUnite[$i]->get_id(); ?>"><?php echo $allUnite[$i]->get_nom(); ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <!-- 
                      /*
                        ! Button valider les ingrédients
                      */
                    -->
                    <div class="row mt-4">
                      <button type="button" class="form-control btn btn-dark" id="ajoutIngredient">Ajouter</button>
                    </div>
                  </div>
                </div>

                <!-- 
                  /*
                    ! Tableau du récapitulatif des ingrédients choisis
                  */
                -->
                <div class="row mt-4 mb-4">
                  <div class="table-responsive">
                    <table class="table" id="tableIng">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Nom de l'ingrédient</th>
                          <th>Quantité</th>
                          <th>Unité</th>
                          <th><button type="button" class="btn" id="deleteRow"><i class="fas fa-times"></i></button></th>
                        </tr>
                      </thead>
                      <tbody id="tableIng">
                      </tbody>
                    </table>
                  </div>

                </div>

                <!--
                  /*
                    ! Button de validation de l'envoie du form
                  */
                -->

                <div class="row">
                  <div class="modal-footer mt-2">
                    <div class="form-group">
                      <button id="validButton" class="btn btn-success" type="button" onclick="sendingAjax()">Valider</button>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>