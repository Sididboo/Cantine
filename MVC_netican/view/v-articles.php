<!DOCTYPE html>
<html lang="fr">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Netican/articles</title>

      <!--CSS-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="habillage/styles/css-header.css">
      <!--JS-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <script src="https://kit.fontawesome.com/390bd29166.js"></script>

      <script src="view/ajax/xhr_object.js"></script>

      <script src="view/ajax/v-search.js"></script>

      <script src="view/ajax/v-articles_codeBarre.js"></script>
      <script src="view/ajax/v-articles_del.js"></script>
      <script src="view/ajax/v-articles_add.js"></script>
      <script src="view/ajax/v-articles_ingredient.js"></script>
      <script src="view/ajax/v-articles_marque.js"></script>
    </head>
    <body>

    <!-- Header -->
    <?php include './header.html'; ?>

    <div class="container_fluid">
      <div class="container">

        <h3 class="text-center font-weight-bold py-2">Insertion des articles</h3>

        <div class="row">
          <div class="col-md-4 col-sm-12 bg-info">
            <!-- Formulaire -->
            <form action="" method="post">

              <h4 class="text-center font-weight-bold">Formulaire</h4>

              <!-- Message erreur si champ non remplie -->
              <p class="text-warning" id="erreur"></p>

              <div class="form-group">
                <div>
                  <!-- Code-barre -->
                  <label class="font-weight-bold">Code-barre :</label>
                  <input class="form-control" type="text" id="code" name="code" placeholder="Code-barre" onchange="codeBarre()"/> 
                  <!-- End code-barre -->
                </div>
                <div>
                  <!-- Catégories -->
                  <label class="font-weight-bold">* Catégorie de l'article :</label>
                  <select class="form-control" id="categories" name="categories" onchange="searchSousCategories()">
                    <option value="0">Choisir une catégorie</option>
                    <?php
                      for ($i=0; $i < count($listCategoriesIngredients); $i++) 
                      { 
                    ?>
                        <option value="<?php echo $listCategoriesIngredients[$i]->get_id(); ?>"><?php echo $listCategoriesIngredients[$i]->get_nom(); ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <!-- End catégories -->
                </div>
                <div>
                  <!-- Sous-catégories -->
                  <label class="font-weight-bold">* Sous catégorie de l'article :</label>
                  <select class="form-control" id="sousCategories" name="sousCategories" onchange="searchIngredients()" disabled>
                  </select>
                  <!-- End sous-catégories -->
                </div>
                <div>
                  <!-- Ingrédients -->
                  <label class="font-weight-bold">* Nom de l'article :</label>
                  <select class="form-control col-xs-2" id="ingredients" name="ingredients" disabled>
                  </select>
                  <span class="text-danger">Si l'article n'existe pas : </span>
                  <button class="btn" type="button" onclick="openPopupIngredient()"><i class="fas fa-folder-plus"></i></button>
                  <!-- End ingrédients -->

                  <!-- Popup Ingredient -->
                  <div id="popupIngredient"  style="display: none;">
                    <div>
                      <p>Avant d'ajouter un nouvel ingredient, pensez à bien vérifier s'il n'existe pas déjà.</p>
                    </div>
                    <div>
                      <select class="form-control" name="popupCategories" id="popupCategories" onchange="popupSearchSousCategories()">
                        <option>Choisissez une catégorie</option>
                        <?php
                          for ($i=0; $i < count($listCategoriesIngredients); $i++) 
                          { 
                        ?>
                            <option value="<?php echo $listCategoriesIngredients[$i]->get_id(); ?>"><?php echo $listCategoriesIngredients[$i]->get_nom(); ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div>
                      <select class="form-control" name="popupSousCategories" id="popupSousCategories">
                      </select>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="ingredient" id="ingredient" placeholder="Nouvel ingredient..."/>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" onclick="addIngredient()">Valider</button>
                        <button type="button" class="btn btn-secondary" onclick="closePopupIngredient()">Fermer</button>
                    </div>
                  </div>
                </div>
                <div>
                  <!-- Marque -->
                  <label class="font-weight-bold">Marque :</label>
                  <select class="form-control" id="marques" name="marques">
                    <option value="">Choisir la marque</option>
                    <?php
                        for ($i=0; $i < count($listMarques); $i++) 
                        { 
                    ?>
                            <option value="<?php echo $listMarques[$i]->get_id(); ?>"><?php echo $listMarques[$i]->get_nom(); ?></option>
                    <?php
                        }
                    ?>
                  </select>
                  <span class="text-danger">Si la marque n'existe pas : </span>
                  <button class="btn" type="button" onclick="openPopupMarque()"><i class="fas fa-folder-plus"></i></button>

                  <!-- Popup Marque -->
                  <div id="popupMarque"  style="display: none;">
                    <div>
                      <p>Avant d'ajouter une nouvelle marque, pensez à bien vérifier s'elle n'existe pas déjà.</p>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="marque" id="marque" placeholder="Nouvelle marque..."/>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" onclick="addMarque()">Valider</button>
                        <button type="button" class="btn btn-secondary" onclick="closePopupMarque()">Fermer</button>
                    </div>
                  </div>
                  <!-- End marque -->
                </div>
                <div>
                  <!-- Pays -->
                  <label class="font-weight-bold">Provenance :</label>
                  <select class="form-control" id="pays" name="pays">
                    <?php
                        for ($i=0; $i < count($listPays); $i++) 
                        {
                            if ($listPays[$i]->get_nom() == 'France') 
                            {
                    ?>
                                <option value="<?php echo $listPays[$i]->get_id(); ?>" selected><?php echo $listPays[$i]->get_nom(); ?></option>
                    <?php       
                            }
                                else
                                {
                    ?>
                                    <option value="<?php echo $listPays[$i]->get_id(); ?>"><?php echo $listPays[$i]->get_nom(); ?></option>
                    <?php
                                }
                        
                      }
                    ?>
                  </select>
                  <!-- End pays -->
                </div>
                <div>
                  <!-- Type conditionnement -->
                  <label class="font-weight-bold">* Type de conditionnement :</label>
                  <select class="form-control" id="typesC" name="typesC">
                    <option value="">Choisir le type de conditionnement</option>
                    <?php
                        for ($i=0; $i < count($listTypesConditionnements); $i++) 
                        { 
                    ?>
                            <option value="<?php echo $listTypesConditionnements[$i]->get_id(); ?>"><?php echo $listTypesConditionnements[$i]->get_nom(); ?></option>
                    <?php
                        }
                    ?>
                  </select>
                  <!-- End type conditionnement -->
                </div>
                <div>
                  <!-- Quantite conditionnement -->
                  <label class="font-weight-bold">* Quantité de conditionnement :</label>
                  <input class="form-control" type="number" id="quantiteC" name="quantiteC" placeholder="Quantité de l'article" step="0.1">
                  <!-- End quantite conditionnement -->
                </div>
                <div>
                  <!-- Unite -->
                  <label class="font-weight-bold">* Unité de la quantité :</label>
                  <select class="form-control" id="unites" name="unites">
                    <option value="">Choisir une unité</option>
                    <?php
                        for ($i=0; $i < count($listUnites); $i++) 
                        { 
                    ?>
                            <option value="<?php echo $listUnites[$i]->get_id(); ?>"><?php echo $listUnites[$i]->get_nom(); ?></option>
                    <?php
                        }
                    ?>
                  </select>
                  <!-- End unite -->
                </div>
                <div>
                  <!-- Nombre d'articles -->
                  <label class="font-weight-bold">* Nombre d'articles :</label>
                  <input class="form-control validate" type="number" id="nbArticles" name="nbArticles" value="1" min="1">
                  <!-- End nombre d'articles -->
                </div>
                <div>
                  <!-- Date péremption -->
                  <label class="font-weight-bold">* Date de péremption :</label>
                  <input class="form-control" type="date" id="dateP" name="dateP" required>
                  <!-- End date péremption -->
                </div>
                <div class="pt-3 text-center">
                  <p class="text-danger">* champs obligatoires</p>
                  <!-- Buttons -->
                  <button class="btn btn-secondary" type="button" onclick="delArticle()" formnovalidate>Quitter</button>
                  <button class="btn btn-primary" type="button" onclick="addArticle()">Ajouter</button>
                  <!-- End buttons -->
                </div>
              </div>
            </form>
            <!-- End formulaire -->
          </div>
          <div class="col-md-8 col-sm-12">
            <!-- Tableau -->
            <div class="table-responsive-md">
              <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                  <tr>
                    <th>Article</th>
                    <th>Marque</th>
                    <th>Provenance</th>
                    <th>Type conditionnement</th>
                    <th>Quantité conditionnement</th>
                    <th>Unité</th>
                    <th>Date péremption</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  <?php
                    for ($i=0; $i < count($listProduitsAchetes); $i++) 
                    { 
                      ?>
                        <tr>
                          <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_leIngredient()->get_nom(); ?></td>
                          <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_laMarque()->get_nom(); ?></td>
                          <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_lePays()->get_nom(); ?></td>
                          <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_leTypeConditionnement()->get_nom(); ?></td>
                          <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_quantiteConditionnement(); ?></td>
                          <td><?php echo $listProduitsAchetes[$i]->get_leProduit()->get_laUnite()->get_nom(); ?></td>
                          <td><?php echo $listProduitsAchetes[$i]->get_datePeremption(); ?></td>
                          <td><button type="button" onclick="delArticle(<?php echo $listProduitsAchetes[$i]->get_id(); ?>)"><i class="fas fa-trash"></i>Supprimer</button></td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- End tableau -->
          </div>
        </div>
        <!--End row-->
      </div>
      <!--End container-->
    </div>
    <!--End container_fluid-->
  </body>
</html>