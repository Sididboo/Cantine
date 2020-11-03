function foundPlats()
{

  var catsPlats = document.getElementById('catsPlats');
  var plats = document.getElementById('plats');

  // Test pour les navigateurs Firefox, Mozilla, Opera, ...
  try
  {
    xhr_object = new XMLHttpRequest();
  }
  catch (Error)
  {
    // Test pour Internet Explorer > 5.0
    try
    {
      xhr_object = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (Error)
    {
      // Test pour Internet Explorer 5.0
      try
      {
        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (Error)
      {
        alert ("Votre navigateur ne supporte pas les objets XMLHTTPRequest");
        return;
      } // Fin du 3ème catch
    } // Fin du 2ème catch
  } // Fin du 1er catch

  xhr_object.open("POST","../php/script_categoriesPlats_plats.php", true);

  xhr_object.onreadystatechange = function()
  {
    if (xhr_object.readyState == 4)
    {
      plats.innerHTML = xhr_object.responseText;
    }
  }

  xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var data = "catPlat=" + catsPlats.options[catsPlats.selectedIndex].value;
  xhr_object.send(data);
}
