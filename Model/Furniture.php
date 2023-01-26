<?php

class Furniture extends Product 
{
    private $height;
    private $width;
    private $length;

    private function getHeight()
	{
		return $this->height;
	}

    private function getWidth()
	{
		return $this->width;
	}

    private function getLength()
	{
		return $this->length;
	}

    private function setHeight(int $height)
	{
		$this->height = $height;
	}

    private function setWidth(int $width)
	{
		$this->width = $width;
	}

    private function setLength(int $length)
	{
		$this->length = $length;
	}

	protected function getSpecialAttrVals(string $SKU)
    {
        $sql = "SELECT CONCAT (height, 'x', width, 'x', length) as dimensions FROM furniture WHERE sku = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$SKU]);
        $dimensions = $stmt->fetchColumn(0);
		$result = 'Dimensions: ' . $dimensions . '"';
        return $result;
    }
    
    protected function saveSpecialAttrVals (string $SKU, array $details)
	{
        if ($details['height']) {
            $this->setSKU($SKU);
            $this->setHeight($details['height']);
            $this->setWidth($details['width']);
            $this->setLength($details['length']);
            $sql = "INSERT INTO furniture (sku, height, width, length) VALUES (?, ?, ?, ?)";
	        $stmt = $this->connect()->prepare($sql);
	        $stmt->execute([$this->getSKU(), $this->getHeight(), $this->getWidth(),$this->getLength()]);
        }
    }

}