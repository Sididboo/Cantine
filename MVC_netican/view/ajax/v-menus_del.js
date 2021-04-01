function delMenus(dateMenu,idplat)
{
    var tbody = document.getElementById("tbody");

    xhr_object.open("POST","controller/a-menus_del.php", true);

    xhr_object.onreadystatechange = function()
    {
        if (xhr_object.readyState == 4)
        {
            var result = xhr_object.responseText;
            
            tbody.innerHTML = result;
        }  
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var data = "dateMenu=" + dateMenu + "&idplat=" + idplat;
    console.log(data);
    xhr_object.send(data);
}