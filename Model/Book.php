<?php

class Book extends Product {

    private $weight;

    private function getWeight()
    {
        return $this->weight;
    }
    
    private function setWeight(int $weight)
	{
		$this->weight = $weight;
	}

    protected function saveSpecialAttrVals (string $SKU, array $details){
        if ($details['weight']) {

            $this->setSKU($SKU);
            $this->setWeight($details['weight']);
            $sql = "INSERT INTO book (sku, weight) VALUES (?, ?)";
	        $stmt = $this->connect()->prepare($sql);
	        $stmt->execute([$this->getSKU(), $this->getWeight()]);
    
        }
    }
}