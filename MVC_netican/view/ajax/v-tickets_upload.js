function upload() 
{
    var file = document.getElementById("file");
    var tbody = document.getElementById("tbody");

    xhr_object.open("POST","controller/a-tickets_upload.php", true);

    xhr_object.onreadystatechange = function()
    {
        if (xhr_object.readyState == 4)
        {
            var result = xhr_object.responseText;
            tbody.innerHTML = result;
        }  
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var formData = new FormData();
    formData.append("file", file.files[0]);

    console.log(file.files[0]);
    // exemple de ce qui m'affiche dans les logs :
    /*
        File {name: "next.png", lastModified: 1599994572369, 
        lastModifiedDate: Sun Sep 13 2020 12:56:12 GMT+0200 (heure d’été d’Europe centrale), 
        webkitRelativePath: "", size: 1251, …}
    */

    xhr_object.send(formData);
}