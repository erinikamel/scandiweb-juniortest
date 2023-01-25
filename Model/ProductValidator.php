<?php

class ProductValidator {

    private $data;
    private static $fields = ['sku', 'name', 'price', 'productType'];

    public function __construct ($data) {
        $this->data = $data;
    }

    //Check if correct fields are sent in request
    public function validateForm (){
        foreach ($this->fields as $field) {
            if(!array_key_exists($field, $this->data)) {
                exit();
            }
        }
    }

    //Method to check SKU Format
    public function SKUFormat ($value) {

        //Check for a format that allows letters or numbers or a combination of them between 8 and 16 characters
        if(!preg_match("/^[A-Za-z\d]{8,16}/", $value)){
            return false;
        } else {
            return true;
        }
    }

    //Method to check name Format
    public function nameFormat ($value) {
        
        //Check for a format that allows letters or numbers or a combination of them between 2 and 255 characters
        if(!preg_match("/^[A-Za-z\d]{2,255}/", $value)){
            return false;
        } else {

            return true;
        }
    }

    //Method to check float Format
    public function checkFloat ($value) {
        
        //Check for an input that is a float of a value bigger than zero
        if((floatval($value) <= 0 || !filter_var($value, FILTER_VALIDATE_FLOAT))){
            return false;
        } else {

            return true;
        }
    }

}