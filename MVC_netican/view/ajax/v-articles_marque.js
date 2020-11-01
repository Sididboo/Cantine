function openPopupCommerce()
{
    document.getElementById('popupCommerce').style.display = "block";
}

function closePopupCommerce()
{
    document.getElementById('popupCommerce').style.display = "none";
}

function addCommerce()
{
        var commerces = document.getElementById("commerces");
        var commerce = document.getElementById("commerce");

        xhr_object.open("POST","controller/a-tickets_commerce.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                commerces.innerHTML = result;
                closePopupCommerce();
            }  
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var data = "commerce=" + commerce.value;
        xhr_object.send(data);
}