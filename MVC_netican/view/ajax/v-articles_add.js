function addArticle()
{
    var fields = true;

    var code = document.getElementById("code");
    var categories = document.getElementById("categories");
    var sousCategories = document.getElementById("sousCategories");
    var ingredients = document.getElementById("ingredients");
    var marques = document.getElementById("marques");
    var pays = document.getElementById("pays");
    var typesC = document.getElementById("typesC");
    var quantiteC = document.getElementById("quantiteC");
    var unites = document.getElementById("unites");
    var nbArticles = document.getElementById("nbArticles");
    var dateP = document.getElementById("dateP");

    var tbody = document.getElementById("tbody");

    // Vérifications des champs du formulaire obligatoires
    switch (true) 
    {
        case categories.value == "0":
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner la catégorie de l'article.";
            fields = false;
            break;
        case sousCategories.value == "0":
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner la sous-catégorie de l'article.";
            fields = false;
            break;
        case ingredients.value == "0":
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner un article.";
            fields = false;
            break;
        case pays.value == "0":
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner un pays.";
            fields = false;
            break;
        case typesC.value == "0":
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner un type de conditionnement.";
            fields = false;
            break;
        case quantiteC.value < 0.1:
            document.getElementById("erreur").innerHTML = "Veuillez indiquer la quantité de votre article (minimum 0.1)";
            fields = false;
            break;
        case unites.value == "0":
            document.getElementById("erreur").innerHTML = "Veuillez sélectionner l'unité de la quantité de l'article.";
            fields = false;
            break;
        case nbArticles.value < 1:
            document.getElementById("erreur").innerHTML = "Veuillez indiquer le nombre acheté concernant cet article (minimum 1).";
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
                console.log(result);
                tbody.innerHTML = result;
            }
        }

        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        var data = "code=" + code.value;
            data += "&ingredient=" + ingredients.value;
            data += "&marque=" + marques.value;
            data += "&pays=" + pays.value;
            data += "&typeC=" + typesC.value;
            data += "&quantiteC=" + quantiteC.value;
            data += "&unite=" + unites.value;
            data += "&nbArticles=" + nbArticles.value;
            data += "&dateP=" + dateP.value;

        xhr_object.send(data);
    }
}