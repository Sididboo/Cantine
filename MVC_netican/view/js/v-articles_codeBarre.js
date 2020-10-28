function codeBarre()
{
  var code = document.getElementById("code");
  var categories = document.getElementById("categories");
  var sousCategories = document.getElementById("sousCategories");
  var ingredients = document.getElementById("ingredients");
  var marques = document.getElementById("marques");
  var pays = document.getElementById("pays");
  var typesC = document.getElementById("typesC");
  var quantiteC = document.getElementById("quantiteC");
  var unites = document.getElementById("unites");

  xhr_object.open("POST","controller/a-articles_codeBarre.php", true);

  xhr_object.onreadystatechange = function()
  {
    if (xhr_object.readyState == 4)
    {
      var result = xhr_object.responseText;

      if (result != "" && result != null)
      {
        var table = [];
        table = result.split(";");

        code.innerHTML = table[0];
        categories.innerHTML = table[1];
        sousCategories.innerHTML = table[2];
        ingredients.innerHTML = table[3];
        marques.innerHTML = table[4];
        pays.innerHTML = table[5];
        typesC.value = table[6];
        quantiteC.readOnly = true;
        unites.innerHTML = table[7];
      }
        /*else
        {
          var code = code;
          window.location.href= "../contained/insertionArticles.php"+ "?saveCode=" + code.value;
        }*/
    }
  }

  xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  var data = "code=" + code.value;

  xhr_object.send(data);
}