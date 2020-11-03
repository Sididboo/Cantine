function upload(idTicket) 
{
    var file = document.getElementById("file");
    var tbody = document.getElementById("tbody");

    if (file.files[0] !== undefined) 
    {
        xhr_object.open("POST","controller/a-tickets_upload.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                tbody.innerHTML = result;
            }  
        }

        var formData = new FormData();
        formData.append("file", file.files[0]);
        formData.append("idTicket", idTicket);

        xhr_object.send(formData);
    }
}