function addTicket()
{   
    var fields = true;

    var date = document.getElementById("date");
    var categorie = document.getElementById("categorie");
    var commerce = document.getElementById("commerce");
    var file = document.getElementById("file").name;

    if (!commerce.checkValidity()) 
    {
        document.getElementById("erreur").innerHTML = "Veuillez renseigner le nom du commerce.";
        fields = false;
    }
    if (!categorie.checkValidity()) 
    {
        document.getElementById("erreur").innerHTML = "Veuillez renseigner la catégorie du ticket.";
        fields = false;
    }
    if (!date.checkValidity()) 
    {
        document.getElementById("erreur").innerHTML = "Veuillez renseigner la date.";
        fields = false;
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

        var data = "date=" + date.value + "&categorie=" + categorie.options[categorie.selectedIndex].value + "&commerce=" + commerce.options[commerce.selectedIndex].value;
        if (file.value == "") 
        {
            data += "&file=NULL";
        }
            else
            {
                data += "&file=" + file.value;
            }
        xhr_object.send(data);
    }
}