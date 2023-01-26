<?php

class DVD extends Product 
{
    private $size;
    
    private function getSize()
    {
        return $this->size;
    }

    private function setSize(int $size)
	{
		$this->size = $size;
	}

    protected function getSpecialAttrVals(string $SKU)
    {
        $sql = "SELECT size FROM dvd WHERE sku = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$SKU]);
        $size = $stmt->fetchColumn(0);
        $result = 'Size: ' . $size . ' MB';
        return $result;
    }

    protected function saveSpecialAttrVals (string $SKU, array $details)
    {
        if ($details['size']) {
            $this->setSKU($SKU);
            $this->setSize($details['size']);
            $sql = "INSERT INTO dvd (sku, size) VALUES (?, ?)";
	        $stmt = $this->connect()->prepare($sql);
	        $stmt->execute([$this->getSKU(), $this->getSize()]);
        }
    }
}