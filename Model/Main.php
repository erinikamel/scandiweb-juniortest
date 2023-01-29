<?php

include '../Includes/autoloader.php';

abstract class Main extends Dbh 
{
    protected $SKU;
    protected $name;
    protected $price;
    protected $type;
  
    abstract protected function getSKU();
    abstract protected function getName();
    abstract protected function getPrice();
    abstract protected function getType();
    abstract protected function setSKU(string $SKU);
    abstract protected function setName(string $name);
    abstract protected function setPrice(int $price);
    abstract protected function setType(string $type);
    abstract protected function checkSKU(string $SKU);
    // abstract protected function saveSpecialAttrVals(string $SKU, array $details);
    abstract protected function setProduct();
    abstract protected function getProducts();
    abstract protected function removeProduct(string $SKU);
}