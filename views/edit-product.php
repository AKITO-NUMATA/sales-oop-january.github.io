<?php
session_start();
require '../classes/Product.php';

$product_obj= new Product;
$product_id=$_GET["product_id"];
$product = $product_obj->getproduct($product_id);


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Edit Product</title>
</head>
<body>

    <main class="row justify-content-center gx-0">
        <div class="col-4">
            <h2 class="text-center mb-4">EDIT PRODUCT</h2>
        
            <form action="../actions/edit-product.php" method="post" enctype="multipart/form-data">
                <!-- multiport fileの受信や保存のために必要 -->
                <div class="row justify-content-center mb-3">
                    <div class="mb-3">
                        <label for="product-name" class="form-label">product Name</label>
                        <input type="text" name="product_name" id="product-name" class="form-control" value="<?=$product['product_name']?>">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">price</label>
                        <input type="text" name="price" id="price" class="form-control" value="<?=$product['price']?>">
                    </div>

                    <div class="mb-4">
                        <label for="quantity" class="form-label bold">quantity</label>
                        <input type="text" name="quantity" id="quantity" class="form-control fw-bold" value="<?=$product['quantity']?>" required>
                    </div>

                    <div class="text-end">
                        <a href="dashboard.php" class="btn btn-secondary btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-warning btn-sm px-5">Save</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>