<?php

include '../Includes/autoloader.php';

class ProductsView extends Product
{
    public function displayProducts()
    {
        $products = $this->getProducts();
        return $products;
    }
}
