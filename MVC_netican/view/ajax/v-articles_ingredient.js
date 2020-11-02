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
        var categories = document.getElementById("categories");
        var sousCategories = document.getElementById("sousCategories");
        var SousCategories = document.getElementById("popupSousCategories");
        var ingredients = document.getElementById("ingredients");
        var ingredient = document.getElementById("ingredient");

        xhr_object.open("POST","controller/a-articles_ingredient.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                console.log(result);
                var table = [];
                table = result.split(";");

                categories.innerHTML = table[0];
                sousCategories.innerHTML = table[1];
                ingredients.innerHTML = table[2];

                closePopupIngredient();
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "ingredient=" + ingredient.value + "&sousCategories=" + SousCategories.options[SousCategories.selectedIndex].value;
        xhr_object.send(data);
}