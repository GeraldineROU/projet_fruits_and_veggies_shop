<?php

function initDataBase()
{
    try {
        $mysqlClient = new PDO('mysql:host=localhost;dbname=fruits_and_veggies_shop;charset=utf8', 'Bibi', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    return $mysqlClient;
}

function getOrdersOfToday($mysqlClient)
{
    $sqlQuery = 'SELECT * 
            FROM orders
            WHERE date = "2024-07-04"
            ORDER BY id DESC;';

    $ordersOfTodayStatement = $mysqlClient->prepare($sqlQuery);

    $ordersOfTodayStatement->execute();

    $orders = $ordersOfTodayStatement->fetchAll();

    return $orders;
}



function getProductsOfOrder1($mysqlClient)
{
    $sqlQuery = 'SELECT *
                FROM order_product
                JOIN products  ON order_product.product_id = products.id
                WHERE order_product.order_id = 1';

    $productsOfOrder1Statement = $mysqlClient->prepare($sqlQuery);
    $productsOfOrder1Statement->execute();
    $products = $productsOfOrder1Statement->fetchAll();

    return $products;
}

function addOneProduct($mysqlClient, $productName, $productAvailability, $productImageURL, $productDescription, $productPrice, $productWeight, $productQuantity, $productCategory)
{
    $sqlQuery = 'INSERT INTO `products` (`name`, `productAvailability`, `productImage`, `productDescription`, `price`, `productWeight`, `quantity`, `productCategory`) 
                    VALUES (:productName, :productAvailability, :productImageURL, :productDescription, :productPrice, :productWeight, :productQuantity, :productCategory)';

    $newProductStatement = $mysqlClient->prepare($sqlQuery);
    $newProductStatement->execute(['productName' => $productName, 'productAvailability' => $productAvailability, 'productImageURL' => $productImageURL, 'productDescription' => $productDescription, 'productPrice' => $productPrice, 'productWeight' => $productWeight, 'productQuantity' => $productQuantity, 'productCategory' => $productCategory]);
    return $mysqlClient->lastInsertId();
}

function displayProduct($mysqlClient, $productID)
{
    $sqlQuery = 'SELECT * 
                FROM products
                WHERE id = :id';
    $productsStatement = $mysqlClient->prepare($sqlQuery);
    $productsStatement->execute(['id' => $productID]);
    $productFromID = $productsStatement->fetch();
?>
    <h2>Here is product sheet of <?php echo $productFromID['name'] ?></h2>
    <p>Price : <?php echo $productFromID['price']; ?>€</p>
    <p>Weight : <?php echo $productFromID['productWeight']; ?>g</p>
    <p>Category : <?php echo $productFromID['productCategory']; ?></p>
    <img src="<?php echo $productFromID['productImage']; ?>" alt="">
    <p><?php echo $productFromID['productDescription']; ?></p>

<?php
}


?>