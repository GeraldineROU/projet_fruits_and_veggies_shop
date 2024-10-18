<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pink Elephant Plush Shop</title>
</head>

<body>



    <?php
    include 'header.php';

    include_once 'my-functions-etape7.php';

    $productPrice = 4000;
    $productWeight = 410;

    ?>
    <h2>Our cute pink super soft fluffy plush</h2>

    <p>Price with VAT :
        <?php
        echo formatPrice($productPrice);
        ?>
        €</p>
    <p>Price without VAT :
        <?php
        echo priceExcludingVAT($productPrice);
        ?>
        €</p>
    <p>Weight :
        <?php
        echo $productWeight;
        ?>
        g</p>
    <p>Discount : -10 %</p>
    <p>Only
        <?php
        echo  discountingPrice(10, $productPrice);
        ?>
        € !!!</p><br>
    <img src='/projet-boutique/images/plush.png' <br>
    <form action="includes/cart-etape8.php" method="post">

        <label for="quantité">Quantity :</label>
        <input type="number" name="quantité" min="1">
        <input type="submit" value="Add to cart">

        <input type="hidden" name="productPrice" value="<?php echo $productPrice; ?>">
        <input type="hidden" name="productWeight" value="<?php echo $productWeight; ?>">

    </form>

    <br><br>

    <form action="includes/empty_card.php" method="post">
        <input type="submit" value="Empty Card">
    </form>
    <form action="includes/cart-etape8.php" method="post">
        <input type="submit" value="Display Card">
    </form>

    <?php
    include 'footer.php';
    ?>


</body>

</html>