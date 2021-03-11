function addMenus()
{   
    var fields = false;

    var date = document.getElementById("dateMenu");
    var nbConvives = document.getElementById("nbConvives");
    var plats = document.getElementById("plat");

    // On vérifie que les champs sont complétés.
    if (!date.checkValidity()) 
    {
        document.getElementById("erreur").innerHTML = "Veuillez renseigner la date.";
    }
        else if (!nbConvives.checkValidity()) 
        {
            document.getElementById("erreur").innerHTML = "Veuillez renseigner le nombre de convives.";
        }
            else if (!plats.checkValidity()) 
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

        var data = "dateMenu=" + date.value + "&nbConvive=" + nbConvives.value + "&plat=" + plat.value;
        console.log(data);
        xhr_object.send(data);

        }
}