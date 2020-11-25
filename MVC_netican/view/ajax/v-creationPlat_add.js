function addIng() {
    const categorie = document.getElementById("categories");
    const sousCat = document.getElementById("sousCategories");
    const ing = document.getElementById("ingredients");
    const dataIng = document.getElementById("tableShowIng");
    var ingSelected = ing.options[ing.selectedIndex];

    var row = dataIng.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    cell1.innerHTML = "<input name='addIngredient[]' value=" + ingSelected.value + " type='hidden'>" + ingSelected.text + "</input>";
    cell2.innerHTML = "<input type='number' class='form-group' name='utilise[]'> "
    cell3.innerHTML = "<i class='fas fa-times fa-lg' onclick='delIng(this)'></i>";
    console.log(dataIng);    
}

function delIng(r) {
    var i = r.parentNode.parentNode.rowIndex - 1;
    document.getElementById("tableShowIng").deleteRow(i);
    console.log(r.parentNode.parentNode.rowIndex);
}

$(document).ready(function () {

    var quantitiy = 0;
    $('.quantity-right-plus').click(function (e) {

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        $('#quantity').val(quantity + 1);


        // Increment

    });

    $('.quantity-left-minus').click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        // Increment
        if (quantity > 0) {
            $('#quantity').val(quantity - 1);
        }
    });

});

/* function validateForm(){
    var ingredient = document.getElementById("tableShowIng");
    xhr_object.open("POST", "controller/a-creationPlat_add.php", true);

    xhr_object.onreadystatechange = function(){
        if (xhr_object.readyState == 4) {
            var result = xhr_object.responseText;
            console.log(result);
            tbody.innerHTML = result;
        }
    }

    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var data
} */