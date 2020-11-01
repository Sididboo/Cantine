function addArticle()
{
    var fields = true;

    var code = document.getElementById("code");
    var ingredients = document.getElementById("ingredients");
    var marques = document.getElementById("marques");
    var pays = document.getElementById("pays");
    var typesC = document.getElementById("typesC");
    var quantiteC = document.getElementById("quantiteC");
    var unites = document.getElementById("unites");
    var nbArticles = document.getElementById("nbArticles");
    var dateP = document.getElementById("dateP");

    var tbody = document.getElementById("tbody");

    switch (true) 
    {
        case !ingredients.checkValidity():
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner un ingredient. Vous pouvez affiner votre recherche d'ingrédients avec la sélection de la catégorie et de la sous catégorie.";
            fields = false;
            break;
        case !pays.checkValidity():
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner un pays.";
            fields = false;
            break;
        case !typesC.checkValidity():
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner un type de conditionnement.";
            fields = false;
            break;
        case !quantiteC.checkValidity():
            document.getElementById("erreur").innerHTML = "Veuillez indiquer la quantité de votre article";
            fields = false;
            break;
        case !unites.checkValidity():
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner l'unité de la quantité de l'article.";
            fields = false;
            break;
        case !nbArticles.checkValidity():
            document.getElementById("erreur").innerHTML = "Veuillez indiquer le nombre acheté concernant cet article.";
            fields = false;
            break;
        case !dateP.checkValidity():
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner la date de Péremption (Si elle n'est pas indiqué sur l'article, veuillez mettre une date que vous pensez être la dernière à respecter).";
            fields = false;
            break;
    }

    if (fields) 
    {
        xhr_object.open("POST","controller/a-articles_add.php", true);

        xhr_object.onreadystatechange = function()
        {
            if (xhr_object.readyState == 4)
            {
                var result = xhr_object.responseText;
                tbody.innerHTML = result;
            }
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        var data = "code=" + code.value;
            data += "&ingredient=" + ingredients.options[ingredients.selectedIndex].value;
            data += "&marques=" + marques.options[marques.selectedIndex].value;
            data += "&pays=" + pays.options[pays.selectedIndex].value;
            data += "&typeC=" + typesC.options[typesC.selectedIndex].value;
            data += "&quantiteC=" + quantiteC.value;
            data += "&unite=" + unites.options[unites.selectedIndex].value;
            data += "&nbArticles=" + nbArticles.value;
            data += "&dateP=" + dateP.value;

        xhr_object.send(data);
    }
}