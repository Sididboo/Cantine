function search() {
    var catIngredient = document.getElementById("catIngredient");
    var ingredient = document.getElementById("ingredient");

    xhr_object.open("POST", "controller/a-creationPlat_search.php", true);

    xhr_object.onreadystatechange = function () {
        if (xhr_object.readyState == 4) {
            var result = xhr_object.responseText;
            ingredient.innerHTML = result;
        }
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var data = "catIngredient=" + catIngredient.options[catIngredient.selectedIndex].value;
    xhr_object.send(data);
}