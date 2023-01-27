<?php

class Furniture extends Product 
{
    private $dimensions;

    private function getDimensions()
	{
		return $this->dimensions;
	}

    private function setDimensions($dimensions)
	{
		$this->dimensions = $dimensions;
	}
    
    protected function saveSpecialAttrVals (string $SKU, array $details)
	{
        if ($details['height']) {
			$dimensions = 'Dimensions: '. $details['height'] . 'x' . $details['width'] . 'x' .$details['length']. '"';
            $this->setSKU($SKU);
            $this->setDimensions($dimensions);
            $sql = "INSERT INTO furniture (sku, dimensions) VALUES (?, ?)";
	        $stmt = $this->connect()->prepare($sql);
	        $stmt->execute([$this->getSKU(), $this->getDimensions()]);
        }
    }
}