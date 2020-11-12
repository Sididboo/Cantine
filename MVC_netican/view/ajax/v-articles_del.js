function delArticle(idProduitAchete)
{
    xhr_object.open("POST","controller/a-articles_del.php", true);

    xhr_object.onreadystatechange = function()
    {
        if (xhr_object.readyState == 4)
        {
            var result = xhr_object.responseText;
            tbody.innerHTML = result;
        }
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var data = "idProduitAchete=" + idProduitAchete;

    xhr_object.send(data);
}