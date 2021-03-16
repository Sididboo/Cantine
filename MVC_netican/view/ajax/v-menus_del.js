function delMenus(dateMenu)
{
    console.log("dateMenu" + dateMenu);
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

    var data = "dateMenu=" + dateMenu;
    xhr_object.send(data);
}