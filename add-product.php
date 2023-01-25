<?php
 declare (strict_types = 1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="/style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="assets/script.js"></script>
        <title>Add Product</title>
        <style> <?php include 'assets/style.css'; ?> </style>
</head>
<body>
<div class="strip">
    <h2>Product List</h2>
</div>    
<div class="stripTwo"></div>
<div class="stripThree"></div>
<div class="wrapper">
    <section>
        <div class="header-container">
            <div class="buttons">
                <form id="product_form" action="Includes/add.php" method="POST" name="product_form">
                <button name ="save" id="save" type="submit" class="btn done-button">SAVE</button>
                <button class="btn x-button" name ="cancel" id="cancel" onclick="location.href='/juniortest-eriny-youssef.com/'" >CANCEL</button>
            </div>
        </div>
    </section>
    <hr class="line">
    <section class="my-3">
        <p class="errorMessage"></p>
        <div class="sku">
            <label>SKU</label>
            <input type="text" id="sku" name="sku">
            <p class ="error" id="skuErrorMsg"></p>
        </div>
        <div class="name">
            <label>name</label>
            <input type="text" id="name" name="name">
            <p class ="error" id="nameErrorMsg"></p>
        </div>
        <div class="price">
            <label>Price ($)</label>
            <input type="text" id="price" name="price">
            <p class ="error" id="priceErrorMsg"></p>
        </div>
        <div class="typeSwitcher">
            <label>Type Switcher</label>
            <select id="productType" name="productType">
                <option></option>
                <option value="DVD">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select>
        </div>
        <div class="typeSwitcherForm" id="DVD">
            <label>Size (MB)</label>
            <input type="text" id="size" name="size" class="detail">
            <p class="error detailErrorMsg"></p>
            <small>Please provide the size of the DVD in MB.</small>
        </div>
        <div class="typeSwitcherForm" id="Book">
            <label>Weight (KG)</label>
            <input type="text" id="weight" name="weight" class="detail">
            <p class="error detailErrorMsg"></p>
            <small>Please provide the weight of the book in KG.</small>
        </div>
        <div class="typeSwitcherForm" id="Furniture">
            <label>Height (CM)</label>
            <input type="text" id="height" name="height" class="detail">
            <br>
            <label>Width (CM)</label>
            <input type="text" id="width" name="width" class="detail">
            <br>
            <label>Length (CM)</label>
            <input type="text" id="length" name="length" class="detail">
            <p class="error detailErrorMsg"></p>
            <small>Please provide the dimensions of the piece of furniture in HxWxL format.</small>
        </div>
        </form>
       <hr class="line">
    </div> 
    </section>

    <footer>
        <p class="text-center pt-3"> 
            <small>Scandiweb Test Assignment</small>
        </p>
    </footer>
</div>
</body>
</html>