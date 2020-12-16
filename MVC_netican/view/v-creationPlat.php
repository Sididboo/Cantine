<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="./habillage/styles/css-header.css">
  <link rel="stylesheet" href="./habillage/styles/css-creationPlat.css">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>

  <!-- Script Ajax -->
  <script src="view/ajax/xhr_object.js"></script>
  <script src="view/ajax/v-search.js"></script>
  <script src="view/ajax/v-creationPlat_add.js"></script>


  <title>Document</title>
</head>

<body>

  <?php include "./header.html" ?>

  <!-- Main Tittle -->
  <div class="container-md mainTittle">
    <h1>
      <p>
        <i class="fas fa-utensils fa-fw fa-2x" style="color: #7BED8D; vertical-align: middle;">
        </i>Liste des plats</p>
    </h1>
  </div>

  <!-- Main Content with table -->

  <div class="container infoTable">
    <div class="container actionButton">
      <div class="row">
        <div class="col-2">
          <a id="addSomething">Ajouter</a>
        </div>
        <div class="col-2">
          <a id="deleteSomething">Supprimer</a>
        </div>
      </div>
    </div>

    <!-- Table show plat and ingredient-->
    <div class="table-responsive mainInfo">
      <table class="table table-borderless" id="tableMain">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom des plats</th>
            <th scope="col">Ingrédient</th>
          </tr>
        </thead>
        <tbody id="tableShow">
          <?php

          for ($i = 0; $i < count($selectLesPlats); $i++) {
          ?>
            <tr>
              <td><input type="checkbox" id="checkboxSelect"></td>
              <td value='<?php echo $selectLesPlats[$i]->get_id() ?>'><?php echo $selectLesPlats[$i]->get_nom() ?></td>
              <td>
                <?php $mesUtilisation = $utilise->findAllByIdPlat($selectLesPlats[$i]->get_id());
                for ($j = 0; $j < count($mesUtilisation); $j++) {
                  echo '<ul>' . $mesUtilisation[$j]->get_leIngredient()->get_nom() . '</ul>';
                }
                ?></td>
            <?php
          }
            ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Forms for table -->
  <div class="container" id="divMyForm">

    <form id="myForm" action="" method="POST">

      <h2>Création d'un plat <i id="closeForm" class="fas fa-times" style="float: right; cursor: pointer;"></i></h2>

      <div class="form-group">
        <label for="namePlat">Nom du plat</label>
        <input type="text" class="form-control" name="namePlats" placeholder="Enter name" required>
        <div class="input-group">

          <button type="button" class="quantity-left-minus" data-type="minus" data-field="">
            <i class="fas fa-minus"></i>
          </button>

          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="0" min="1" max="100" required>

          <button type="button" class="quantity-right-plus" data-type="plus" data-field="">
            <i class="fas fa-plus"></i>
          </button>

        </div>
      </div>

      <!-- Catégories Plat -->

      <div class="form-group">
        <label for="getCategorie">Catégorie de plat</label>
        <select class="form-control" id="categoriesPlat" name='categoriesPlat' onchange="" required>
          <option value="0">Choisir une catégorie de plat</option>
          <?php
          for ($i = 0; $i < count($tableStock); $i++) {
          ?>
            <option value="<?php echo $tableStock[$i]->get_id(); ?>"><?php echo $tableStock[$i]->get_nom(); ?> </option>
          <?php
          }
          ?>
        </select>
      </div>

      <!-- End Catégories Plat -->

      <!-- CatégorieIngrédient -->

      <div class="form-group">
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

      <!-- End CatégoriesIngrédient-->


      <div class="form-group">
        <label>Sous catégorie ingrédient</label>
        <select class="form-control" id="sousCategories" name="sousCategories" onchange="searchIngredients()" disabled>
          <option value="0"></option>
        </select>
      </div>

      <!-- Ingredients -->

      <div class="form-group">
        <label>Ingrédient</label>
        <select class="form-control" id="ingredients" name="ingredients" disabled>
        <option value="0"></option>
        </select>
      </div>

      <!-- End Ingredients -->

      <!-- Button for push ingredient in tableShowIng -->

      <button type="button" name="bouton_add" id="bouton_add" onclick="validation()" formnovalidate>Valider</button>

      <!-- Table for show ingredient -->

      <div class="table-responsive IngSelected">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th class="col">Ingrédient</th>
              <th class="col"></th>
            </tr>
          </thead>
          <tbody id="tableShowIng">
          </tbody>
        </table>
      </div>

      <!-- End table -->

      <input type="submit" name="submit" value="Valider" />
    </form>
  </div>
</body>

</html>