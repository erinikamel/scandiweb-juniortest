<?php

class Book extends Product 
{
    private $weight;

    private function getWeight()
    {
        return $this->weight;
    }
    
    private function setWeight($weight)
	{
		$this->weight = $weight;
	}

    protected function saveSpecialAttrVals (string $SKU, array $details)
    {
        $weight = 'Weight: '. $details['weight'] . ' KG';
        $this->setWeight($weight);
        $sql = "INSERT INTO book (sku, weight) VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$SKU, $this->getWeight()]);
    }
}