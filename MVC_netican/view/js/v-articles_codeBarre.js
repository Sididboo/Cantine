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
      if (result.length > 1)
      {
        var table = [];
        table = result.split(";");

        categories.innerHTML = table[0];
        sousCategories.innerHTML = table[1];
        ingredients.innerHTML = table[2];
        marques.innerHTML = table[3];
        pays.innerHTML = table[4];
        typesC.value = table[5];
        quantiteC.readOnly = true;
        unites.innerHTML = table[6];
      }
    }
  }

  xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  var data = "code=" + code.value;

  xhr_object.send(data);
}