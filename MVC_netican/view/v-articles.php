<!DOCTYPE html>
<html lang="fr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Netican/Articles</title>

      <!--CSS-->
      <link rel="stylesheet" href="./habillage/styles/css-articles.css">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

      <!--JS-->

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      
      <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>

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

    <div class="containerArticles">

        <h1 class="title">Insertion des articles</h1>

        <div class="containerFormTab">
            <!-- Formulaire -->
            <form class="formulaire" action="" method="post">

              <h4 class="titleForm">Formulaire</h4>

              <!-- Message erreur si champ non remplie -->
              <p class="error" id="erreur"></p>

                <div class="divForm">
                  <!-- Code-barre -->
                  <label class="">Code-barre :</label>
                  <input class="field" type="text" id="code" name="code" placeholder="Code-barre" onchange="codeBarre()"/> 
                  <!-- End code-barre -->
                </div>

                <div class="divForm">
                  <!-- Catégories -->
                  <label class="">* Catégorie de l'article :</label>
                  <select class="field" id="categories" name="categories" onchange="searchSousCategories()">
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

                <div class="divForm">
                  <!-- Sous-catégories -->
                  <label class="">* Sous catégorie de l'article :</label>
                  <select class="field" id="sousCategories" name="sousCategories" onchange="searchIngredients()" disabled>
                  </select>
                  <!-- End sous-catégories -->
                </div>

                <div class="divForm">
                  <!-- Ingrédients -->
                  <label class="">* Nom de l'article :</label>
                  <select class="field" id="ingredients" name="ingredients" disabled>
                  </select>
                  <p class="">Si l'article n'existe pas : </p>
                  <button class="itemAdd" type="button" onclick="openPopupIngredient()"><i class="fas fa-folder-plus"></i></button>
                  <!-- End ingrédients -->

                  <!-- Popup Ingredient -->
                  <div id="popupIngredientAdd"  style="display: none;">
                    <div>
                      <p>Avant d'ajouter un nouvel ingredient, pensez à bien vérifier s'il n'existe pas déjà.</p>
                    </div>

                    <!-- Message erreur si champ non remplie -->
                    <p class="" id="popupErreur"></p>

                    <div>
                      <select class="field" name="popupCategories" id="popupCategories" onchange="popupSearchSousCategories()">
                        <option value="0">Choisissez une catégorie</option>
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
                      <select class="field" name="popupSousCategories" id="popupSousCategories" disabled>
                        <option value="0">Choisissez une sous-catégorie</option>
                      </select>
                    </div>
                    <div>
                        <input class="field" type="text" name="popupIngredient" id="popupIngredient" placeholder="Nouvel ingredient..." disabled/>
                    </div>
                    <div>
                      <button class="buttonItemExit" type="button" onclick="closePopupIngredient()">Fermer</button>
                      <button class="buttonItemAdd" type="button"  onclick="addIngredient()">Valider</button>
                    </div>
                  </div>
                </div>

                <div class="divForm">
                  <!-- Marque -->
                  <label class="">Marque :</label>
                  <select class="field" id="marques" name="marques">
                    <option value="0">Choisir la marque</option>
                    <?php
                        for ($i=0; $i < count($listMarques); $i++) 
                        { 
                    ?>
                            <option value="<?php echo $listMarques[$i]->get_id(); ?>"><?php echo $listMarques[$i]->get_nom(); ?></option>
                    <?php
                        }
                    ?>
                  </select>
                  <p class="">Si la marque n'existe pas : </p>
                  <button class="itemAdd" type="button" onclick="openPopupMarque()"><i class="fas fa-folder-plus"></i></button>

                  <!-- Popup Marque -->
                  <div id="popupMarque"  style="display: none;">
                    <div>
                      <p>Avant d'ajouter une nouvelle marque, pensez à bien vérifier s'elle n'existe pas déjà.</p>
                    </div>
                    <div>
                        <input class="field" type="text" name="marque" id="marque" placeholder="Nouvelle marque..."/>
                    </div>
                    <div>
                        <button class="buttonItemExit" type="button" onclick="closePopupMarque()">Fermer</button>
                        <button class="buttonItemAdd" type="button" onclick="addMarque()">Valider</button>
                    </div>
                  </div>
                  <!-- End marque -->
                </div>

                <div class="divForm">
                  <!-- Pays -->
                  <label class="">Provenance :</label>
                  <select class="field" id="pays" name="pays">
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

                <div class="divForm">
                  <!-- Type conditionnement -->
                  <label class="">* Type de conditionnement :</label>
                  <select class="field" id="typesC" name="typesC">
                    <option value="0">Choisir le type de conditionnement</option>
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

                <div class="divForm">
                  <!-- Quantite conditionnement -->
                  <label class="">* Quantité de conditionnement :</label>
                  <input class="field" type="number" id="quantiteC" name="quantiteC" placeholder="Quantité de l'article" step="0.1" min="0.1">
                  <!-- End quantite conditionnement -->
                </div>

                <div class="divForm">
                  <!-- Unite -->
                  <label class="">* Unité de la quantité :</label>
                  <select class="field" id="unites" name="unites">
                    <option value="0">Choisir une unité</option>
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

                <div class="divForm">
                  <!-- Nombre d'articles -->
                  <label class="">* Nombre d'articles :</label>
                  <input class="field" type="number" id="nbArticles" name="nbArticles" value="1" min="1">
                  <!-- End nombre d'articles -->
                </div>

                <div class="divForm">
                  <!-- Date péremption -->
                  <label class="">* Date de péremption :</label>
                  <input class="field" type="date" id="dateP" name="dateP" required>
                  <!-- End date péremption -->
                </div>

                <div class="">
                  <p class="">* Champs obligatoires</p>
                  
                  <div class="actionsForm">
                    <!-- Buttons -->
                    <!-- window.history.back fait revenir sur la page précédemmente visité -->
                    <button class="buttonExit" type="button" onclick="window.history.back()">Quitter</button>
                    <button class="buttonAdd" type="button" onclick="addArticle()">Ajouter</button>
                    <!-- End buttons -->
                  </div>
                </div>
              
            </form>
            <!-- End formulaire -->
          
            <table class="">
              <thead class="">
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
                        <td><button class="buttonItemExit" type="button" onclick="delArticle(<?php echo $listProduitsAchetes[$i]->get_id(); ?>)"><i class="fas fa-trash"></i>Supprimer</button></td>
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