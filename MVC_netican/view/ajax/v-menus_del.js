function delMenus(dateMenu)
{
    console.log("DATEMENU" + dateMenu);
    var tbody = document.getElementById("tbody");

    xhr_object.open("POST","controller/a-menus_del.php", true);

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var data = "dateMenu=" + dateMenu;
    xhr_object.send(data);
}