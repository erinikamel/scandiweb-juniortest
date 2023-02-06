<?php

class ProductController extends Product 
{
    //Method to add a new product
    public function addProduct ($SKU, $name, $price, $type, $details)
    {
        //Check for unique SKU
        if ($this->checkSKU($SKU) == true) {
            //Instantiating the product class to use its "set product" method
            $newProduct = new Product();
            $newProduct->setSKU($SKU);
            $newProduct->setName($name);
            $newProduct->setPrice($price);
            $newProduct->setType($type);
            $newProduct->setProduct();

            //Instantiating the type class to use its "save special attribute values" method
            $className = $_POST["productType"];
            $newType = new $className();
            $newType->saveSpecialAttrVals($SKU, $details);
            //Save value of result to check whether the product was saved successfully or not (used in Ajax to redirect to product list page after successsful saving)
            $result = true;
        } else {
            $result = false;
        }
            return $result;
    }

    //Function to delete selected products
    public function deleteProduct($SKU)
    {
        //Instantiating the product class to use its "remove product" method
		$itemToDelete = new Product();
        $itemToDelete->removeProduct($SKU);
	}
}
