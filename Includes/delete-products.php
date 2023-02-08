<?php

include 'autoloader.php';

//Check if mass delete button exists, request is sent, and items are selected (at least one check box checked)
if (isset($_POST["delete"]) && isset($_POST["checked"])) {
    //Grabbing user input
    $productsToDelete = $_POST["checked"];

    //Instantiating the product controller class to use its "delete product" method
    $delete = new ProductController();
    foreach ($productsToDelete as $SKU) {
        $delete->deleteProduct($SKU);
    }
    
   //Redirection
   header('Location: /juniortest-eriny-youssef.com/');
} else {
    header('Location: /juniortest-eriny-youssef.com/');
}