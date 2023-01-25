<?php

class DVD extends Product {

    private $size;
    
    private function getSize()
    {
        return $this->size;
    }

    private function setSize(int $size)
	{
		$this->size = $size;
	}

    protected function saveSpecialAttrVals (string $SKU, array $details){
        if ($details['size']) {

            $this->setSKU($SKU);
            $this->setSize($details['size']);
            $sql = "INSERT INTO dvd (sku, size) VALUES (?, ?)";
	        $stmt = $this->connect()->prepare($sql);
	        $stmt->execute([$this->getSKU(), $this->getSize()]);
    
        }
    }
}