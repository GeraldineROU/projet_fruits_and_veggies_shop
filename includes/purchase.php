<?php session_start();

var_dump($_POST);


include_once '../my-functions-etape8.php';


$discountedProductPrice = discountingPrice(10, (int)$_SESSION['productPrice']);

$productPriceWithoutVAT = priceExcludingVAT((int)$_SESSION['productPrice']);

$totalCartWeight = calculatingTotalWeight((int)$_SESSION['productWeight'], (int)$_SESSION['productQuantity']);

// $shippingFees = calculatingShippingFees($totalCartWeight);

$totalPrice = (int)$_SESSION['productQuantity'] * $discountedProductPrice;

$totalPriceWithoutVAT = (int)$_SESSION['productQuantity'] * $productPriceWithoutVAT;

// $cartPrice = calculatingTotalOfCart($productPrice, 10, $productWeight, $productQuantity);

echo "Your cart contains :";
echo '<br>';
echo (int)$_SESSION['productQuantity'], ' product(s).<br>';
echo "Price : " . $discountedProductPrice . " €<br>";
echo "Total of your cart : " . $totalPrice . " €<br>";

displayTotalOfVAT((int)$_SESSION['productPrice'], (int)$_SESSION['productQuantity']);

displayTotalWeight($totalCartWeight);

if (isset($_POST['carier'])) {

    // echo "calcul des frais de port<br>";
    $carierChoice = $_POST['carier'];

    if ($carierChoice === 'economic') {
        // echo 'livraison pas cher!!! <br>';
        $shippingFees = calculatingShippingFeesEconomic($totalCartWeight);
        echo "Shipping fees : " . $shippingFees . " €<br><br>";
        $totalOfPurchase = calculatingTotalOfCart((int)$_SESSION['productPrice'], 10, (int)$_SESSION['productQuantity'], $shippingFees);
        echo "Total of your purchase : " . $totalOfPurchase . " €<br><br>";
    }
    if ($carierChoice === 'premium') {
        // echo 'livraison rapide !!! <br>';
        $shippingFees = calculatingShippingFeesPremium($totalCartWeight);
        echo "Shipping fees : " . $shippingFees . " €<br><br>";
        $totalOfPurchase = calculatingTotalOfCart((int)$_SESSION['productPrice'], 10, (int)$_SESSION['productQuantity'], $shippingFees);
        echo "Total of your purchase : " . $totalOfPurchase . " €<br><br>";
    }

    // // echo "Shipping fees : " . $shippingFees . " €<br>";

    // // echo "Total of your purchase : " . $cartPrice . " €<br>";

    echo '<a href="../plush-shop-etape8.php">Return to shop</a>';
}
