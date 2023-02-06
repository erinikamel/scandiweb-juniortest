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

    private function setHeight($height)
	{
		$this->height = $height;
	}
    
    private function setWidth($width)
	{
		$this->width = $width;
	}
    
    private function setLength($length)
	{
		$this->length = $length;
	}
    
    protected function saveSpecialAttrVals (string $SKU, array $details)
	{
        $this->setHeight($details['height'] );
        $this->setWidth($details['width']);
        $this->setLength($details['length']);
        $sql = "INSERT INTO furniture (sku, height, width, length) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$SKU, $this->getHeight(), $this->getWidth(), $this->getLength()]);
    }
}