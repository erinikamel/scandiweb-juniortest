//Dynamically change form based on type switcher selection
$(document).ready(function () {
    $("#productType").change(function () {
        $(".typeSwitcherForm").hide();
        $('#' + $(this).val()).show();
    });
});

//Retrieving errors using Ajax load method to display them to the user without reloading the page
$(document).ready(function() {
    $("#product_form").submit(function(event) {
        event.preventDefault();
        var sku = $("#sku").val();
        var name = $("#name").val();
        var price = $("#price").val();
        var productType = $("#productType").val();
        var size = $("#size").val();
        var weight = $("#weight").val();
        var height = $("#height").val();
        var width = $("#width").val();
        var length = $("#length").val();
        var save = $("#save").val();
        $(".errorMessage").load("Includes/add.php", {
            sku: sku,
            name: name,
            price: price,
            productType: productType,
            size: size,
            weight: weight,
            height: height,
            width, width,
            length, length,
            save: save
        }, function (responseText){
            
                  if (responseText.search('successfulSubmit = "1"') > 0) {
                    
                    window.location.href= "/juniortest-eriny-youssef.com/"
            }
        })
    });
});
