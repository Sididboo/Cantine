var tbody = document.getElementById("mainContent");
var ing = document.getElementById("ingredients");
var dataIng = document.getElementById("tableShowIng");

function addIng() {
    var ingSelected = ing.options[ing.selectedIndex];

    var row = dataIng.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    console.log(ingSelected);

    cell1.append(ingSelected);
    cell2.innerHTML = "<i class='fas fa-times'></i>";
}

function sendIng() {
    xhr_object.open("POST", "controller/a-creationPlat_add.php", true);

    xhr_object.onreadystatechange = function () {
        if (xhr_object.readyState == 4) {
            var result = xhr_object.responseText;
            console.log(result);
            tbody.innerHTML = result;
        }
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urmencode")

    var data =
}