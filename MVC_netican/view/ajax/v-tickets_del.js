function delTicket(idTicket)
{
    var tbody = document.getElementById("tbody");

    xhr_object.open("POST","controller/a-tickets_del.php", true);

    xhr_object.onreadystatechange = function()
    {
        if (xhr_object.readyState == 4)
        {
            var result = xhr_object.responseText;
            if (result.length == 2) 
            {
                alert("Des articles sont rattachés à ce ticket, veuillez d'abord les supprimer");
            }
            else
            {
                tbody.innerHTML = result;
            }
        }  
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var data = "idTicket=" + idTicket;
    xhr_object.send(data);
}