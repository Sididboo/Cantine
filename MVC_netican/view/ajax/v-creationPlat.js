/* 
? Variable
*/

let table = [];

/* 
! Function
*/

$(document).on("click", "#ajoutIngredient", function (event) {
  event.preventDefault();
  if (
    $("#categories").val() <= 0 ||
    $("#sousCategories").val() <= 0 ||
    $("#ingredients").val() <= 0 ||
    $("#qteIng").val() <= 0
  ) {
    $("#erreur").html("Vérifier vos champs");
  } else {
    table.push({
      ingredient: $("#ingredients").val(),
      qte: $("#qteIng").val(),
    });
    console.log(table);
    console.log($("#ingredients").val());

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

$(document).on("click", "#deleteRow", function () {
  console.log("Button fonctionne");
  $("#tableIng")
    .find('input[name="record"]')
    .each(function () {
      if ($(this).is(":checked")) {
        let idInput = $(this).attr("id");
        table = table.filter((item) => item.ingredient !== idInput);
        $(this).parents("tr").remove();
      }
    });
});

$(document).on("click", "#deletePlat", function () {
  $.ajax({
    url: "../../controller/a-creationPlat_delete.php",
    method: "POST",
    data: { idPlat: $("#deletePlat").val() },
    beforeSend: function () {
      console.log("envoie");
    },
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
      console.log($("#categorieNewPlat").val().length);
    } else {
      $.ajax({
        url: "../../controller/a-creationPlat_categorie.php",
        method: "POST",
        data: {
          categorie: $("#categorieNewPlat").val(),
        },
        beforeSend: function () {
          console.log("envoie");
          console.log($("#categorieNewPlat").val());
        },
        success: function (response) {
          $("#popupCategorie").hide();
          console.log(response);
          console.log($("#categorieNewPlat").val().length);
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

function sendingAjax() {
  if (
    $("#nomPlat").val() <= 0 ||
    $("#nbPersonne").val() <= 1 ||
    $("#categoriesPlat").val() <= 0
  ) {
    $("#erreur").html("Formulaire non valide");
  } else {
    $.ajax({
      url: "controller/a-creationPlat_add.php",
      method: "POST",
      data: {
        nomPlat: $("#nomPlat").val(),
        nbPersonne: $("#nbPersonne").val(),
        categoriePlat: $("#categoriesPlat").val(),
      },
      beforeSend: function () {
        console.log("prise en compte plat");
      },
      success: function (response) {
        console.log("Done!");
        alert("Ajout du plat");
      },
      complete: function (data) {
        console.log("Plat" + data);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#error").html("Il y a un problème");
        console.log(xhr.status);
        console.log(thrownError);
      },
    });

    let jsonString = JSON.stringify(table);

    $.ajax({
      url: "controller/a-creationPlat_ingredient.php",
      method: "POST",
      data: { data: jsonString },
      beforeSend: function (data) {
        console.log("prise en compte ingredient");
        console.log(data);
      },
      success: function (response) {
        console.log("Ingredient envoyé !");
      },
      complete: function (data) {
        console.log("Ingredient" + data);
        window.location.reload();
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log("Il y a un problème");
        console.log(xhr.status);
        console.log(thrownError);
      },
    });
  }
}
