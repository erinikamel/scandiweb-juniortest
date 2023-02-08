<?php

class Product extends Main 
{
	private $SKU;
    private $name;
    private $price;
    private $type;
  
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

    protected function setPrice($price)
	{
		$this->price = $price;
	}

    protected function setType(string $type)
	{
		$this->type = $type;
	}

	//Method to check if SKU already exists
	public function checkSKU($SKU)
	{
		$sql = 'SELECT SKU FROM product WHERE SKU = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$SKU]);
		//Check if the statement returns records or not
		if($stmt->rowCount() > 0) {
			$SKUTaken = true;
		} else {
			$SKUTaken = false;
		}
		return $SKUTaken;
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
		//USe COALESCE() function to return only the type-specific attribute with a value (not null)
		$sql = "SELECT p.*, COALESCE(concat ('Weight: ', b.weight, ' KG'), concat ('Size: ', d.size, ' MB'), concat ('Dimensions: ', f.height, 'x', f.width, 'x', f.length, ' CM')) AS attr FROM product p LEFT JOIN book b ON p.SKU = b.SKU LEFT JOIN dvd d ON p.SKU = d.SKU LEFT JOIN furniture f ON p.SKU=f.SKU ORDER BY p.id";
	    $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
	}

//  //Another Method to retrieve products from database
	// public function getProducts()
	// {
	// 	$sql = "SELECT p.*, b.weight, d.size, f.dimensions FROM product p LEFT JOIN book b ON p.SKU = b.SKU LEFT JOIN dvd d ON p.SKU = d.SKU LEFT JOIN furniture f ON p.SKU=f.SKU ORDER BY p.id";
	//     $stmt = $this->connect()->prepare($sql);
	//     $stmt->execute();
    //     $results = $stmt->fetchAll();
	// 	//Return type-specific attributes
	// 	$products = [];
	// 	foreach ($results as $key => $result) {
	// 		$filtered= array_filter($result, fn ($value) => !empty($value));
	// 		$oldkeys = ["size", "weight", "dimensions"];
	// 		$products []= $this->changeKey($filtered, $oldkeys, 'attr');
	// 	}
    //     return $products;
	// }

			// public function changeKey($array, array $oldkeys, $newkey) {
	// 	foreach ($oldkeys as $oldkey)
	// 	{if(array_key_exists( $oldkey, $array)) {
	// 		$keys = array_keys($array);
	// 		$keys[array_search($oldkey, $keys)] = $newkey;
	// 		return array_combine($keys, $array);	
	// 	}}
	// 	return $array;    
// }
	
	//Method to remove products from database
	protected function removeProduct($SKU)
	{
		$sql = "DELETE FROM product WHERE sku=?";
		$stmt=$this->connect()->prepare($sql);
	    $stmt->execute([$SKU]);
	} 
}