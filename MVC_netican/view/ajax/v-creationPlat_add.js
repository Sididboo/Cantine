function validation() {

    var fields = true;
    const formValid = document.getElementById("bouton_add");
    const categorie = document.getElementById("categories");
    const sousCat = document.getElementById("sousCategories");
    const ing = document.getElementById("ingredients");
    const dataIng = document.getElementById("tableShowIng");
    var ingSelected = ing.options[ing.selectedIndex];

    switch (true) {
        case categorie.value == "0":
            fields = false;
            break;
        case sousCat.value == "0":
            fields = false;
            break;
        case ing.value == "0":
            fields = false;
            break;
    }

    if (fields) {
        var row = dataIng.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);

        cell1.innerHTML = "<input name='addIngredient[]' value=" + ingSelected.value + " type='hidden'>" + ingSelected.text + "</input>";
        cell2.innerHTML = "<input type='number' class='form-group' name='utilise[]' required> "
        cell3.innerHTML = "<i class='fas fa-times fa-lg' onclick='delIng(this)'></i>";

        console.log(categorie.value, sousCat.value, ing.value);

    } else {
        console.log("NOT WORKING", categorie.value, sousCat.value, ing.value, fields);
    }
}

function delIng(r) {
    var i = r.parentNode.parentNode.rowIndex - 1;
    document.getElementById("tableShowIng").deleteRow(i);
    console.log(r.parentNode.parentNode.rowIndex);
}


// More and less quantity

$(document).ready(function () {

    var quantity = 0;
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

    // Hide div form
    $('#divMyForm').hide();

    // Show div form on click
    $("#addSomething").on('click', function () {
        $("#divMyForm").show();
    });

    //Hide div form on click
    $("#closeForm").on('click', function () {
        $('#divMyForm').hide();
    });


    // Select row
    $("#tableMain tbody tr").click(function(){
        // get row content into a array

        var tableData = $(this).children("td").map(function(){
            return $(this).text();
        }).get();
        
        var td=tableData[0]+'*'+tableData[1]+'*'+tableData[2];
        console.log(td)
    });

    $('#deleteSomething').onclick(function(){


    });

});