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

      var table = [];
      table = result.split(";");

      if (table[8] == "1")
      {
        categories.innerHTML = table[0];
        categories.disabled = true;

        sousCategories.innerHTML = table[1];
        sousCategories.disabled = true;

        ingredients.innerHTML = table[2];
        ingredients.disabled = true;

        marques.innerHTML = table[3];
        marques.disabled = true;

        pays.innerHTML = table[4];
        pays.disabled = true;

        typesC.innerHTML = table[5];
        typesC.disabled = true;

        quantiteC.value = table[6];
        quantiteC.readOnly = true;

        unites.innerHTML = table[7];
        unites.disabled = true;
      }
      else if(categories.disabled = true)
      {
        
      }
    }
  }

  xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  var data = "code=" + code.value;

  xhr_object.send(data);
}