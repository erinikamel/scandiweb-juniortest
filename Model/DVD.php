<?php

class DVD extends Product 
{
    private $size;
    
    private function getSize()
    {
        return $this->size;
    }

    private function setSize($size)
	{
		$this->size = $size;
	}

    protected function saveSpecialAttrVals (string $SKU, array $details)
    {
        $size = 'Size: '. $details['size'] . ' MB';
        $this->setSize($size);
        $sql = "INSERT INTO dvd (sku, size) VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$SKU, $this->getSize()]);
    }
}