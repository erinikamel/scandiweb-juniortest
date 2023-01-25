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
	protected function getProducts()
	{
		$sql = "SELECT  p.SKU, name, type, price, weight, size, CONCAT (height, 'x', width, 'x', length) as dimensions FROM product p LEFT JOIN book b ON p.SKU = b.SKU LEFT JOIN dvd d ON p.SKU = d.SKU LEFT JOIN furniture f ON p.SKU=f.SKU ORDER BY p.id";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute();
        $products = $stmt->fetchAll();
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