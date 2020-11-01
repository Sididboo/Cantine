function categorie()
{
    var categorie = prompt("Quelle catégorie voulez vous rajouter ?");

    var valid = window.confirm("Etes-vous sûr ? \n "+categorie);

    if (valid) 
    {
        var categories = document.getElementById("categories");

        xhr_object.open("POST","controller/a-tickets_categorie.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                categories.innerHTML = result;
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "categorie=" + categorie;
        xhr_object.send(data);
    }
        else
        {
            return;
        }
}