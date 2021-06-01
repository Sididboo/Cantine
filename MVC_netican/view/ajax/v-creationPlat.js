/* 
? Variable
*/

let monTableau = [];

/* 
! Function
*/

/*
 * * Cette function permet l'ajout d'un ingrédient dans un array (table) et dans un tableau d'affichage en HTML
 */

$(document).on("click", "#ajoutIngredient", function (event) {
  event.preventDefault();

  /*
  * * On vérifie si tout les champs sont remplis
  ! Si un des champs est vide, un message d'erreur apparait
  */

  if (
    $("#categories").val() <= 0 ||
    $("#sousCategories").val() <= 0 ||
    $("#ingredients").val() <= 0 ||
    $("#qteIng").val() <= 0
  ) {
    $("#erreur").html("Vérifier vos champs");
  } else {
    /*
     * * Si tout les paramètres sont correct, on push les informations
     */
    monTableau.push({
      ingredient: $("#ingredients").val(),
      qte: $("#qteIng").val(),
    });

    /*     console.log(table);
    console.log($("#ingredients").val()); */

    tableIng = $("#tableIng");
    selectedIng = $("#ingredients option:selected");
    addIng =
      "<tr>" +
      "<td><input type='checkbox' name='record' id=" +
      selectedIng.val() +
      "></td>" +
      "<td value=" +
      selectedIng.val() +
      ">" +
      selectedIng.text() +
      "</td> <td>" +
      $("#qteIng").val() +
      "</td> <td>" +
      $("#unitIng option:selected").text() +
      "</td>";

    tableIng.append(addIng);
  }
});

/*
 * * Cette function permet la suppression des éléments stocker dans l'array et le monTableauau html
 */

$(document).on("click", "#deleteRow", function () {
  /* console.log("Button fonctionne"); */

  /*
   * * On récupère les lignes du tableau et pour chaque ligne on vérifie si la checkbox = true
   * * Si c'est la cas on supprime du tableau et de l'array les valeurs sélectionnées
   */

  $("#tableIng")
    .find('input[name="record"]')
    .each(function () {
      if ($(this).is(":checked")) {
        let idInput = $(this).attr("id");
        monTableau = monTableau.filter((item) => item.ingredient !== idInput);
        $(this).parents("tr").remove();
      }
    });
});

/*
 * * Cette function supprime entièrement le plat dans la base de donnée
 */

$(document).on("click", "#deletePlat", function () {
  $.ajax({
    url: "./controller/a-creationPlat_delete.php",
    method: "POST",
    data: { idPlat: $("#deletePlat").val() },

    /*     beforeSend: function () {
      console.log("");
    }, */

    success: function () {
      window.location.reload();
    },

    error: function (xhr, ajaxOptions, thrownError) {
      console.log(xhr.status);
      console.log(thrownError);
    },
  });
});

$(function () {
  $('[data-toggle="popover"]').popover({
    trigger: "focus",
  });
});

function AjoutCategorie() {
  $(document).on("click", "#addCateg", function (event) {
    event.preventDefault();
    if ($("#categorieNewPlat").val() <= 0) {
      $("#error").html("error");
      /* console.log($("#categorieNewPlat").val().length); */
    } else {
      $.ajax({
        url: "./controller/a-creationPlat_categorie.php",
        method: "POST",
        data: {
          categorie: $("#categorieNewPlat").val(),
        },
        /* beforeSend: function () {
          console.log("envoie");
          console.log($("#categorieNewPlat").val());
        }, */

        success: function (response) {
          $("#popupCategorie").hide();

          /*           console.log(response);
          console.log($("#categorieNewPlat").val().length); */

          window.location.reload();

          // $("#selectCateg").html($("#categorie".val()));
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#error").html("Il y a un problème");
          console.log(xhr.status);
          console.log(thrownError);
        },
      });
    }
  });
}

function openPopupCategorie() {
  document.getElementById("popupCategorie").style.display = "block";
}

function closePopupCategorie() {
  document.getElementById("popupCategorie").style.display = "none";
}

/**
 * * Cette function permet l'envoie de toute les valeurs sélectionnées par la personne.
 * * Le déclencheur de la function est le boutton envoie du modal d'ajout d'un plat.
 */
function sendingAjax() {
  if (
    $("#nomPlat").val() <= 0 ||
    $("#nbPersonne").val() <= 1 ||
    $("#categoriesPlat").val() <= 0
  ) {
    $("#erreur").html("Formulaire non valide");
  } else {
    $.ajax({
      url: "./controller/a-creationPlat_add.php",
      method: "POST",
      data: {
        nomPlat: $("#nomPlat").val(),
        nbPersonne: $("#nbPersonne").val(),
        categoriePlat: $("#categoriesPlat").val(),
      },

      /*       beforeSend: function () {
        console.log("prise en compte plat");
      }, */

      success: function (response) {
        /*         console.log("Done!"); */
        let jsonString = JSON.stringify(monTableau);
    console.log(jsonString);

    $.ajax({
      url: "./controller/a-creationPlat_ingredient.php",
      method: "POST",
      data: { data: jsonString },
            beforeSend: function (data) {
       /*  console.log("prise en compte ingredient");
        console.log(data); */
      },
      success: function (response) {
        /* console.log("Ingredient envoyé ! " + response); */
        window.location.reload();
        table = [];
      },
      complete: function (data) {
        console.log("Ingredient" + data);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log("Il y a un problème");
        console.log(xhr.status);
        console.log(thrownError);
      },
    });
      },
      complete: function (data) {
        /*         console.log("Plat" + data); */
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#error").html("Il y a un problème");
        console.log(xhr.status);
        console.log(thrownError);
      },
    });

    /**
     * * On convertit l'array au format JSON pour un envoie plus simple vers les controllers
     */

    
  }
}
