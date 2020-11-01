function openPopupIngredient()
{
    document.getElementById('popupIngredient').style.display = "block";
}

function closePopupIngredient()
{
    document.getElementById('popupIngredient').style.display = "none";
}

function addIngredient()
{
        var SousCategories = document.getElementById("popupSousCategories");
        var ingredients = document.getElementById("ingredients");
        var ingredient = document.getElementById("ingredient");

        xhr_object.open("POST","controller/a-articles_ingredient.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                ingredients.innerHTML = result;
                closePopupIngredient();
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "ingredient=" + ingredient.value + "&sousCategories=" + SousCategories.options[SousCategories.selectedIndex].value;
        xhr_object.send(data);
}

function popupSearchSousCategories()
{
    var categories = document.getElementById("popupCategories");
    var sousCategories = document.getElementById("popupSousCategories");

    xhr_object.open("POST","controller/a-articles_search.php", true);

    xhr_object.onreadystatechange = function()
    {
        if (xhr_object.readyState == 4)
        {
            var result = xhr_object.responseText;
            sousCategories.innerHTML = result;
        }
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    var data = "categorie=" + categories.options[categories.selectedIndex].value;

    xhr_object.send(data);
}