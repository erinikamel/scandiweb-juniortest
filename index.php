<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {

    case '':
    case '/juniortest-eriny-youssef.com/':
        require __DIR__ . '/product-list.php';
        break;

    case '/juniortest-eriny-youssef.com/add-product':
        require __DIR__ . '/add-product.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/404.php';
        break;
}