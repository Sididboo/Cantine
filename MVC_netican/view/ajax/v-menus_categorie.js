function openPopupCategoriePlat()
{
    document.getElementById('popupCategorie').style.display = "block";
}

function closePopupCategoriePlat()
{
    document.getElementById('popupCategorie').style.display = "none";
}

function addCategoriePlat()
{
        var categories = document.getElementById("categories");
        var categorie = document.getElementById("categorie");

        xhr_object.open("POST","controller/a-menus_categorie.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                categories.innerHTML = result;
                closePopupCategorie();
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "categorie=" + categorie.value;
        xhr_object.send(data);
}