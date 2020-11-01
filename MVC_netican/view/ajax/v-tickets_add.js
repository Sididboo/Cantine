function addTicket()
{   
    var fields = false;

    var date = document.getElementById("date");
    var categories = document.getElementById("categories");
    var commerce = document.getElementById("commerce");

    // On vérifie que les champs sont complétés.
    if (!date.checkValidity()) 
    {
        document.getElementById("erreur").innerHTML = "Veuillez renseigner la date.";
    }
        else if (!categories.checkValidity()) 
        {
            document.getElementById("erreur").innerHTML = "Veuillez renseigner la catégorie du ticket.";
        }
            else if (!commerce.checkValidity()) 
            {
                document.getElementById("erreur").innerHTML = "Veuillez renseigner le nom du commerce.";
            }
                else
                {
                    fields = true;
                }
    

    if (fields) 
    {
        var tbody = document.getElementById("tbody");

        xhr_object.open("POST","controller/a-tickets_add.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                tbody.innerHTML = result;
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "date=" + date.value + "&categorie=" + categories.options[categories.selectedIndex].value + "&commerce=" + commerces.options[commerces.selectedIndex].value + "&file=" + null;
        xhr_object.send(data);
    }
}