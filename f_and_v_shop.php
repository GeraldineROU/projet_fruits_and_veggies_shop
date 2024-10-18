<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La boutique Primeur</title>
</head>

<body>



    <?php
    include 'header.php';
    include_once 'database.php';

    include_once 'my-functions-etape8.php';



    $mysqlClient = initDataBase();

    $orders = getOrdersOfToday($mysqlClient);

    foreach ($orders as $order) {
    ?>
        <h2>Order n°<?php echo $order['number']; ?></h2>
        <p>Date : <?php echo $order['date']; ?></p>
        <p>Carier choice : <?php echo $order['delivery']; ?></p>
    <?php
    }

    $products = getProductsOfOrder1($mysqlClient);

    echo '<h2>Products list of Order n°1</h2>';

    foreach ($products as $product) {
    ?>
        <h3><?php echo $product['name'] ?></h3>
        <p>Price : <?php echo $product['price']; ?>€</p>
        <p>Weight : <?php echo $product['productWeight']; ?>g</p>
        <p>Category : <?php echo $product['productCategory']; ?></p>
        <img src="<?php echo $product['productImage']; ?>" alt="">
        <p><?php echo $product['productDescription']; ?></p>
    <?php
    }

    $newProductID = addOneProduct($mysqlClient, 'pastèque', 1, 'pasteque.png', "Moi j'aime les pastèques", 10000, 3000, 42, 6);
    displayProduct($mysqlClient, $newProductID);


    ?>


    <!-- <form action="includes/cart-etape8.php" method="post">

        <label for="quantité">Quantity :</label>
        <input type="number" name="quantité" min="1">
        <input type="submit" value="Add to cart">

        <input type="hidden" name="productPrice" value="<
        ?php echo $productPrice; ?>
        ">
        <input type="hidden" name="productWeight" value="<
        ?php echo $productWeight; ?>">

    </form> -->

    <br><br>

    <form action="includes/empty_card.php" method="post">
        <input type="submit" value="Empty Card">
    </form>
    <form action="includes/cart-etape8.php" method="post">
        <input type="submit" value="Display Card">

    </form>

    <!-- <ul class="">
                        <li class=""><a class="" href="recipes_update.php?id=<
                        ?php echo($recipe['recipe_id']); ?>">Editer l'article</a></li>
                        <li class=""><a class="" href="recipes_delete.php?id=<
                        ?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a></li>
                    </ul> -->

    <?php
    include 'footer.php';
    ?>


</body>

</html>