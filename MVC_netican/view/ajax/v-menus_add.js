function addMenus()
{   
    var fields = false;

    var date = document.getElementById("dateMenu");
    var categories = document.getElementById("categoriesPlat");
    var plats = document.getElementById("plat");

    // On vérifie que les champs sont complétés.
    if (!date.checkValidity()) 
    {
        document.getElementById("erreur").innerHTML = "Veuillez renseigner la date.";
    }
        else if (!categories.checkValidity()) 
        {
            document.getElementById("erreur").innerHTML = "Veuillez renseigner la catégorie du plat.";
        }
            else if (!commerce.checkValidity()) 
            {
                document.getElementById("erreur").innerHTML = "Veuillez renseigner le plat.";
            }
                else
                {
                    fields = true;
                }
    

    if (fields) 
    {
        var tbody = document.getElementById("tbody");

        xhr_object.open("POST","controller/a-menus_add.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                tbody.innerHTML = result;
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "date=" + date.value + "&categoriePlat=" + categoriesPlat.options.value + "&plat=" + plat.options.value;
        xhr_object.send(data);
    }
}