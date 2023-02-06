<?php
 include './Includes/autoloader.php';

 error_reporting(0);

 $products = new ProductsView();
 $results = $products->displayProducts();
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <title>Product List</title>
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
            <button class="btn done-button" onclick="location.href='/juniortest-eriny-youssef.com/add-product'">ADD</button>
                <form action="Includes/delete-products.php" method="POST" id="delete-form">
                    <button for="delete" name="delete" class="btn x-button">MASS DELETE</button>
                </form>
            </div>
        </div>
    </section>
    <hr class="line">
    <section class="cards my-3">
        <div class="row">
            <?php foreach ($results as $product): ?> 
                <div class="col-lg-3 col-md-5 col-sm-6 pb-3">
                    <div class="card">
                        <div class="card-body">
                                <input form="delete-form" type="checkbox" class="delete-checkbox mt-3" name="checked[]" value="<?= $product['SKU']; ?>"></p>
                        <p class="card-text text-center mt-3">
                        <?= $product['SKU']; ?> <br>
                        <?= $product['name']; ?> <br>
                        <?= $product['price']; ?> $ <br>
                        <?= $product['size']; ?>
                        <?= $product['weight']; ?>
                        <?= $product['dimensions']; ?>
                        </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div> 
    </section>
</div>
<footer>
        <p class="text-center pt-3"> 
            <small>Scandiweb Test Assignment</small>
        </p>
    </footer>
</body>
</html>