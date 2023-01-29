<?php

include '../Includes/autoloader.php';

//Check if save button exists and request is sent
if ((isset($_POST['save']))) {
    // error_reporting(0);

    //Grabbing user input
    $SKU = $_POST["sku"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $type = $_POST["productType"];
    $attrDVD = $_POST["size"];
    $attrBook = $_POST["weight"];
    $attrFurniture = [$_POST["height"], $_POST["width"], $_POST["length"]];

    //Declaring variable to check for required input
    $requiredInput = [$SKU, $name, $price, $type];
    $requiredAttr = ${'attr' . $type};

    //Declaring array of only the selected values of the type-specific attribute
    $details =[];
    foreach ($_POST as $key => $value) {
        if ($value != null && $key !=="sku" && $key !=="name" && $key !=="price" && $key !=="productType") {
            $details[$key] = $value;
        }
    };

    //Declaring variables for error handling
    $emptyError = false;
    $SKUTaken = false;
    $invalidSKU = false;
    $invalidName = false;
    $invalidPrice = false;
    $invalidDetail = false;
    $successfulSubmit = false;
    
    //Instantiating the ProductValidator class to use its validation functions
    $validation = new ProductValidator($_POST);

    //Running error handlers
    //Check if any any required inputs are empty
    foreach ($requiredInput as $key => $input) {
        if (empty($input) && $input != "0") {
            $emptyError = true;
        }
    }

    foreach ($requiredAttr as $key => $input) {
        if (empty($input) && $input != "0" ) {
            $emptyError = true;
        }
    }

    if (empty($requiredAttr) && $requiredAttr != "0" ) {
        $emptyError = true;
    }

    //Check for correct SKU format
    if ($validation->SKUFormat($SKU) == false) {
        $invalidSKU = true;
    }

    //Check for correct name format
    if ($validation->nameFormat($name) == false) {
        $invalidName = true;
    }

    //Check for correct price format
    if ($validation->checkFloat($price) == false) {
        $invalidPrice = true;
    }

    //Check for correct type-specific attribute values formats
    foreach ($details as $key => $value) {
        if ($validation->checkFloat($value) == false) {
            $invalidDetail = true;
        }
    };

    //Instantiating the ProductController class to use its "add product" method if no errors are found
    if (!$emptyError && !$invalidSKU && !$invalidName && !$invalidPrice && !$invalidDetail) {
        $newProduct = new ProductController();

        //Save submission success or  failure status to use for redirection in Ajax
        $SKUTaken = $newProduct->addProduct($SKU, $name, $price, $type, $details);
        if ($SKUTaken == true) {
            $successfulSubmit = true;
        }

        $newProduct->addProduct($SKU, $name, $price, $type, $details);
    } 
}
?>

<script> 
//Ajax script to return errors if found

//Resetting errpr classes
$("#sku, #name, #productType, #price, .detail").removeClass("inputError");
$("#skuErrorMsg, #nameErrorMsg, #priceErrorMsg, .detailErrorMsg").empty();
$(".errorMessage").removeClass("errorFormat");

//Defining error variables
var emptyError = "<?php echo $emptyError; ?>"
var SKUTaken = "<?php echo $SKUTaken; ?>"
var invalidSKU = "<?php echo $invalidSKU; ?>"
var invalidName = "<?php echo $invalidName; ?>"
var invalidPrice = "<?php echo $invalidPrice; ?>"
var invalidDetail = "<?php echo $invalidDetail; ?>"
var successfulSubmit = "<?php echo $successfulSubmit; ?>"

if (emptyError){

    $("#sku, #name, #productType, #price, .detail").addClass("inputError");
    $(".errorMessage").empty().append("<?php echo "Please, submit required data." ?>");
    $(".errorMessage").addClass("errorFormat");

} else if (!emptyError){

    if (SKUTaken){
        $("#sku").addClass("inputError");
        $("#skuErrorMsg").empty().append("<?php echo "This SKU is duplicated." ?>");
    }

    if (invalidSKU){
        $("#sku").addClass("inputError");
        $("#skuErrorMsg").empty().append("<?php echo "SKU should be 8 to 16 characters of letters or number only." ?>");
    }

    if (invalidName){
        $("#name").addClass("inputError");
        $("#nameErrorMsg").empty().append("<?php echo "Name should be at least 2 characters of letters or number only." ?>");
    }

    if (invalidPrice){
        $("#price").addClass("inputError");
        $("#priceErrorMsg").empty().append("<?php echo "Please, provide a correct price value." ?>");
    } 

    if (invalidDetail){
        $(".detail").addClass("inputError");
        $(".detailErrorMsg").empty().append("<?php echo "Please, provide a correct value." ?>");
    }

    if (SKUTaken || invalidSKU || invalidName || invalidPrice || invalidDetail) {
        $(".errorMessage").append("<?php echo "Please, provide the data of indicated type." ?>");
        $(".errorMessage").addClass("errorFormat");
    }
}

</script>