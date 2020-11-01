function openPopupMarque()
{
    document.getElementById('popupMarque').style.display = "block";
}

function closePopupMarque()
{
    document.getElementById('popupMarque').style.display = "none";
}

function addMarque()
{
        var marques = document.getElementById("marques");
        var marque = document.getElementById("marque");

        xhr_object.open("POST","controller/a-articles_marque.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                marques.innerHTML = result;
                closePopupMarque();
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "marque=" + marque.value;
        xhr_object.send(data);
}