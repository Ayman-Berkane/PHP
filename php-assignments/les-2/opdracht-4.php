<?php
$price = 160;
if ($price >= 150) {
    $addedTax = $price * 0.19;
    $newPrice = $price + $addedTax;
    echo "oude prijs: €${price}. na verhoging van 19% is de prijs: €${newPrice}";
} else if ($price >= 55 ) {
    $addedTax = $price * 0.11;
    $newPrice = $price + $addedTax;
    echo "oude prijs: €${price}. na verhoging van 11% is de prijs: €${newPrice}";
} else {
    $addedTax = $price * 0.16;
    $newPrice = $price + $addedTax;
    echo "oude prijs: €${price}. na verhoging van 16% is de prijs: €${newPrice}";
}
?>
