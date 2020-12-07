function openPopupIngredient()
{
    document.getElementById('popupIngredientAdd').style.display = "block";
}

function closePopupIngredient()
{
    document.getElementById('popupIngredientAdd').style.display = "none";
}

function addIngredient()
{
    var fields = true;
    var erreur = document.getElementById("popupErreur");

    var categories = document.getElementById("categories");
    var sousCategories = document.getElementById("sousCategories");
    var ingredients = document.getElementById("ingredients");

    var popupCategories = document.getElementById("popupCategories");
    var popupSousCategories = document.getElementById("popupSousCategories");
    var popupIngredient = document.getElementById("popupIngredient");

    switch (true) 
    {
        case popupCategories.value == "0":
            erreur.innerHTML = "Veuillez sélectionner la catégorie de l'article.";
            fields = false;
            break;
        case popupSousCategories.value == "0":
            erreur.innerHTML = "Veuillez sélectionner la sous-catégorie de l'article.";
            fields = false;
            break;
        case popupIngredient.value == "":
            erreur.innerHTML = "Veuillez entrer le nom de l'ingrédient.";
            fields = false;
            break;
    }

    if (fields) 
    {
        erreur.innerHTML = "";

        xhr_object.open("POST","controller/a-articles_ingredient.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                var table = [];
                table = result.split(";");

                categories.innerHTML = table[0];
                sousCategories.innerHTML = table[1];
                ingredients.innerHTML = table[2];

                closePopupIngredient();
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "ingredient=" + popupIngredient.value + "&sousCategorie=" + popupSousCategories.value;
        xhr_object.send(data);
    }
}