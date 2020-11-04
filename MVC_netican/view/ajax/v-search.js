function searchSousCategories()
{
    var categories = document.getElementById("categories");
    var sousCategories = document.getElementById("sousCategories");
    var ingredients = document.getElementById("ingredients");

    xhr_object.open("POST","controller/a-search.php", true);

    xhr_object.onreadystatechange = function()
    {
        if (xhr_object.readyState == 4)
        {
            var result = xhr_object.responseText;
            sousCategories.innerHTML = result;

            sousCategories.disabled = false;
            ingredients.disabled = true;

            ingredients.innerHTML = "<option></option>";
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

    xhr_object.open("POST","controller/a-search.php", true);

    xhr_object.onreadystatechange = function()
    {
        if (xhr_object.readyState == 4)
        {
            var result = xhr_object.responseText;
            ingredients.innerHTML = result;
            ingredients.disabled = false;
        }
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    var data = "sousCategorie=" + sousCategories.options[sousCategories.selectedIndex].value;

    xhr_object.send(data);
}

function popupSearchSousCategories()
{
    var categories = document.getElementById("popupCategories");
    var sousCategories = document.getElementById("popupSousCategories");

    xhr_object.open("POST","controller/a-search.php", true);

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

function searchPlats()
{

  var categoriePlat = document.getElementById('categoriePlat');
  var plats = document.getElementById('plat');

  xhr_object.open("POST","controller/a-search.php", true);

  xhr_object.onreadystatechange = function()
  {
    if (xhr_object.readyState == 4)
    {
      plats.innerHTML = xhr_object.responseText;
    }
  }

  xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var data = "categoriePlat=" + categoriePlat.value;
  xhr_object.send(data);
}
