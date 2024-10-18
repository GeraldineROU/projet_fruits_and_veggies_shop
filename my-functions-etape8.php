    <?php
    function formatPrice($priceInCents)
    {
        $priceInEuros = number_format($priceInCents / 100, 2);
        return $priceInEuros;
    }

    // formatPrice(1000);
    // echo "ça marche?";

    function priceExcludingVAT($VATIncludedPrice)
    {

        $VATexcludedPrice = (100 * $VATIncludedPrice) / (100 + 20);
        $VATexcludedPrice = formatPrice($VATexcludedPrice);
        return $VATexcludedPrice;
    }

    function calculatingOnlyVAT($productPriceInCents)
    {
        $productPriceWithoutVAT = priceExcludingVAT($productPriceInCents);
        $productPrice = formatPrice($productPriceInCents);
        $onlyVAT = $productPrice - $productPriceWithoutVAT;
        return $onlyVAT;
    }

    function calculatingTotalOfVAT($productPriceInCents, $productsQuantity)
    {
        $onlyVAT = calculatingOnlyVAT($productPriceInCents);
        $totalOfVAT = $onlyVAT * $productsQuantity;
        return $totalOfVAT;
    }

    function displayTotalOfVAT($productPriceInCents, $productsQuantity)
    {
        $totalOfVAT = calculatingTotalOfVAT($productPriceInCents, $productsQuantity);
        echo "Total VAT : " . $totalOfVAT . " €<br>";
    }

    function discountingPrice($productDiscount, $productPriceInCents)
    {
        $discount = ($productPriceInCents * $productDiscount) / 100;
        $productPriceDiscountedInCents = $productPriceInCents - $discount;
        $productPriceDiscounted = formatPrice($productPriceDiscountedInCents);
        return $productPriceDiscounted;
    }

    function calculatingTotalWeight($productWeight, $productsQuantity)
    {
        $totalProductsWeight = $productWeight * $productsQuantity;
        return $totalProductsWeight;
    }

    function displayTotalWeight($cartWeight)
    {
        if ($cartWeight >= 1000) {
            $cartWeight = number_format($cartWeight / 1000, 2);
            echo "Total of Weight of your purchase : " . $cartWeight . " kg<br>";
        } else {
            echo "Total of Weight of your purchase : " . $cartWeight . " g<br>";
        }
    }

    function calculatingShippingFeesEconomic($cartWeight)
    {
        $shippingFees = 0;
        if ($cartWeight < 500) {
            $shippingFees += 5;
        }
        if ($cartWeight > 500 && $cartWeight < 2000) {
            $shippingFees += 4.50;
        }
        $shippingFees = number_format($shippingFees, 2);
        return $shippingFees;
    }

    function calculatingShippingFeesPremium($cartWeight)
    {
        $shippingFees = 0;
        if ($cartWeight < 1000) {
            $shippingFees += 15;
        }
        if ($cartWeight > 1000 && $cartWeight < 5000) {
            $shippingFees += 12;
        }
        if ($cartWeight > 5000) {
            $shippingFees += 7.50;
        }
        $shippingFees = number_format($shippingFees, 2);
        return $shippingFees;
    }

    function calculatingTotalOfCart($productPriceInCents, $productDiscount, $productsQuantity, $shippingFees)
    {
        $discountedProductPrice = discountingPrice($productDiscount, $productPriceInCents);
        $totalOfDiscountedProductsPrice = $discountedProductPrice * $productsQuantity;
        // $totalCartWeight = calculatingTotalWeight($productWeight, $productsQuantity);

        $totalOfPurchase = $totalOfDiscountedProductsPrice + $shippingFees;

        $totalOfPurchase = number_format($totalOfPurchase, 2);

        return $totalOfPurchase;
    }

    function emptyCart()
    {
        // recherche google : php how to empy session
        session_destroy();
    }
    // function displayQuantityForm()
    // {

    // }

    ?>

    </body>

    </html>