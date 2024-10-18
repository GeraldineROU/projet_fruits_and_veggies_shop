<?php session_start();
var_dump($_POST);

include_once '../my-functions-etape8.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['quantité'])) {
        // Une quantité arrive dans le POST -> on modifie le panier

        $_SESSION['productQuantity'] = $_POST['quantité'];
        $_SESSION['productPrice'] = $_POST['productPrice'];
        $_SESSION['productWeight'] = $_POST['productWeight'];
    }

    if (empty($_SESSION['productQuantity'])) {
        echo '<p>Oh no, your cart is empty !<br><br>Too bad, no vitamin for you :( </p><br>';
        echo '<br><br><br>...<br><p>... Unless...</p><br>';
        echo '<br>';
        echo '<p>Unless you go back to shop to get you beautiful and tasty fruits and veggies !!! :)</p>';
        echo '<a href="../f_and_v_shop.php">Return to shop</a>';
    } else {

        $discountedProductPrice = discountingPrice(10, (int)$_SESSION['productPrice']);

        $productPriceWithoutVAT = priceExcludingVAT((int)$_SESSION['productPrice']);

        $totalCartWeight = calculatingTotalWeight((int)$_SESSION['productWeight'], (int)$_SESSION['productQuantity']);

        $totalPrice = (int)$_SESSION['productQuantity'] * $discountedProductPrice;

        $totalPriceWithoutVAT = (int)$_SESSION['productQuantity'] * $productPriceWithoutVAT;

        echo "Your cart contains :";
        echo '<br>';
        echo (int)$_SESSION['productQuantity'], ' product(s).<br>';
        echo "Price : " . $discountedProductPrice . " €<br>";
        echo "Total of your cart : " . $totalPrice . " €<br>";

        displayTotalOfVAT((int)$_SESSION['productPrice'], (int)$_SESSION['productQuantity']);

        displayTotalWeight($totalCartWeight);

        /////////// choix du transporteur ////////

?>

        <form action="purchase.php" method="post">

            <label for="carierChoice">Choose a carier :</label>

            <select name="carier" id="carierChoice">
                <option value="">--Please choose an option--</option>
                <option value="economic">UPS economic slow and green delivery</option>
                <option value="premium">UPS ultra fast premium delivery</option>
            </select>
            <input type="submit">
            <br><br><br>
            <a href="../f_and_v_shop.php">Return to shop</a>

        </form>

<?php
    }
}

var_dump($_SESSION);
?>