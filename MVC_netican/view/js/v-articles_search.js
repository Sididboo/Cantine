function searchSousCategories()
{
    var categories = document.getElementById("categories");
    var sousCategories = document.getElementById("sousCategories");

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

function searchIngredients()
{
    var sousCategories = document.getElementById("sousCategories");
    var ingredients = document.getElementById("ingredients");

    xhr_object.open("POST","controller/a-articles_search.php", true);

    xhr_object.onreadystatechange = function()
    {
        if (xhr_object.readyState == 4)
        {
            var result = xhr_object.responseText;
            ingredients.innerHTML = result;
        }
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    var data = "sousCategorie=" + sousCategories.options[sousCategories.selectedIndex].value;

    xhr_object.send(data);
}