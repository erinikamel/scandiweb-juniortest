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
        if ($details['weight']) {
            $weight = 'Weight: '. $details['weight'] . ' KG';
            $this->setSKU($SKU);
            $this->setWeight($weight);
            $sql = "INSERT INTO book (sku, weight) VALUES (?, ?)";
	        $stmt = $this->connect()->prepare($sql);
	        $stmt->execute([$this->getSKU(), $this->getWeight()]);
        }
    }
}