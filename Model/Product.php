<?php

include '../Includes/autoloader.php';

class Product extends Main 
{
    protected function getSKU()
	{
		return $this->SKU;
	}

    protected function getName()
	{
		return $this->name;
	}

    protected function getPrice()
	{
		return $this->price;
	}

    protected function getType()
	{
		return $this->type;
	}

    protected function setSKU(string $SKU)
	{
		$this->SKU = $SKU;
	}

    protected function setName(string $name)
	{
		$this->name = $name;
	}

    protected function setPrice(int $price)
	{
		$this->price = $price;
	}

    protected function setType(string $type)
	{
		$this->type = $type;
	}

	//Method to check if SKU already exists
	protected function checkSKU($SKU)
	{
		$sql = 'SELECT SKU FROM product WHERE SKU = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$SKU]);
		//Check if the statement returns data or not
		if($stmt->rowCount() > 0) {
			$result = false;
		} else {
			$result = true;
		}
		return $result;
	}

	//Method to insert added product to database
    protected function setProduct()
	{
		$sql = "INSERT INTO product (sku, name, price, type) VALUES (?, ?, ?, ?)";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$this->getSKU(), $this->getName(), $this->getPrice(), $this->getType()]);

	}

	//Method to insert added product type-specific attribute values to corressponding type class in database
	protected function saveSpecialAttrVals (string $SKU, array $details){}

	//Method to retrieve products from database
	public function getProducts()
	{
		$sql = "SELECT  SKU, name, type, price FROM product ORDER BY id";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute();
        $products = $stmt->fetchAll();
		//Retrieve type-speciic attributes using child class method
		foreach ($products as $key => $product) {
			$className = $product["type"];
            $newType = new $className();
			$products [$key]['attr'] = $newType->getSpecialAttrVals($product['SKU']);
		}
        return $products;
	}

	//Method to remove products from database
	protected function removeProduct($SKU)
	{
		$sql = "DELETE FROM product WHERE sku=?";
		$stmt=$this->connect()->prepare($sql);
	    $stmt->execute([$SKU]);
	} 
}

$products= new Product();
$products -> getProducts();