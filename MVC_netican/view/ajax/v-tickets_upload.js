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
                switch (result) {
                    case "1":
                        alert("Ce fichier n'est pas une image.");
                        break;
                    case "2":
                        alert("Ce fichier existe déjà.");
                        break;
                    case "3":
                        alert("Ce fichier est trop volumineux");
                        break;
                    case "4":
                        alert("Seuls les fichiers aux formats suivants sont acceptés : jpg, png et jpeg.");
                        break;
                    default:
                        tbody.innerHTML = result;
                        break;
                }
            }  
        }

        var formData = new FormData();
        formData.append("file", file.files[0]);
        formData.append("idTicket", idTicket);

        xhr_object.send(formData);
    }
}