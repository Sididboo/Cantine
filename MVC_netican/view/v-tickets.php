<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/ce45170c32.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Header -->
    <?php include './header.html'; ?>

    <div class="container-fluid">

        <h3 class="text-center font-weight-bold py-3">Insertion des tickets</h3>

        <div class="row p-4">

            <div class="col-md-4 bg-light">

                <!--form-->
                <form action="" method="POST" enctype="multipart/form-data">
                    <!--title-->
                    <h4 class="pt-3 text-center font-weight-bold">Formulaire</h4>

                    <!--Error-->
                    <p class="text-center text-danger">
                        <?php
                        if (isset($_REQUEST['error'])) {
                            echo $_REQUEST['error'];
                        }
                        ?>
                    </p>

                    <div class="form-group">

                        <div class="cell_date pt-2">
                            <label class="font-weight-bold">* Date</label>
                            <input class="form-control" type="date" name="input_date" required />
                        </div>

                        <!-- Gestion du menu déroulant pour le choix de la marque -->
                        <div class="pt-4">
                            <label class="font-weight-bold">* Catégorie</label>
                            <select class="form-control" name="categorie_ticket" required>
                                <option value="">Choisir une catégorie de ticket</option>
                                <?php
                                for ($i = 0; $i < count($listCategoriesTickets); $i++) {
                                    echo '<option value="' . $listCategoriesTickets[$i]->get_id() . '">' . $listCategoriesTickets[$i]->get_nom() . '</option>';
                                }
                                ?>
                            </select>
                            <span class="text-danger">Si la catégorie du ticket n'existe pas : </span>
                            <a href="./index.php?action=addCatTicket"><button type="button" class="btn"><i class="fas fa-folder-plus"></i></button></a>
                        </div>

                        <!-- Gestion du menu déroulant pour le choix du commerce -->
                        <div class="py-4">
                            <label class="font-weight-bold">* Commerce</label>
                            <select class="form-control" name="commerce_ticket" required>
                                <option value="">Choisir un commerce</option>
                                <?php
                                for ($i = 0; $i < count($listCommerces); $i++) {
                                    echo '<option value="' . $listCommerces[$i]->get_id() . '">' . $listCommerces[$i]->get_nom() . '</option>';
                                }
                                ?>
                            </select>
                            <span class="text-danger">Si le commerce n'existe pas : </span>
                            <a href="./index.php?action=addCommerce"><button type="button" class="btn"><i class="fas fa-folder-plus"></i></button></a>
                        </div>

                        <!-- Importation du fichier Photo du ticket de caisse -->
                        <div class="custom-file">
                            <label class="custom-file-label font-weight-bold">* Pièce Jointe</label>
                            <input class="custom-file-input" type="file" name="file" required>
                        </div>

                        <div class="pt-3 text-center">
                            <p class="text-danger">* champs obligatoires</p>
                            <!-- Buttons -->
                            <button class="btn btn-info" type="button" name="button_form_submit">Ajouter</button>
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
                            <th>Date</th>
                            <th>Commerce</th>
                            <th>Catégorie</th>
                            <th>Pièce Jointe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- Millieu de tableau qui réference les tickets -->
                    <tbody>
                        <!--Remplissage en PHP-->
                        <?php
                        for ($i = 0; $i < count($listTickets); $i++) {
                        ?>
                            <tr>
                                <td><?php echo $listTickets[$i]->get_dateTicket(); ?></td>
                                <td><?php echo $listTickets[$i]->get_leCommerce()->get_nom(); ?></td>
                                <td><?php echo $listTickets[$i]->get_laCategorie()->get_nom(); ?></td>
                                <td><?php echo $listTickets[$i]->get_pieceJointe(); ?></td>
                                <td>
                                    <button class="btn btn-primary" onclick="deleteTicket('<?php echo $listTickets[$i]->get_id(); ?>', '<?php echo $listTickets[$i]->get_pieceJointe(); ?>')"><i class="fas fa-trash"></i> Supprimer</button>
                                    <a href="./index.php?action=articles&idTicket=<?php echo $listTickets[$i]->get_id(); ?>"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter articles</button></a>
                                </td>
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