<?php
// Initieer variabelen voor product, aantal en foutmeldingen
$product = $amount = $result = "";
$productError = $amountError = "";

// Controleer of een product is gekozen
if (!isset($_POST["product"]) || empty($_POST["product"])) {
    $productError = "Kies een product!";
} else {
    $product = $_POST["product"];
}

// Controleer of het aantal correct is ingevoerd
if (!isset($_POST["amount"]) || empty($_POST["amount"])) {
    $amountError = "Vul het aantal in!";
} elseif (!filter_var($_POST["amount"], FILTER_VALIDATE_INT)) {
    $amountError = "Vul een getal in!";
} else {
    $amount = $_POST["amount"];
}

// Als er geen fouten zijn, voer dan de berekening uit
if (empty($productError) && empty($amountError)) {
    switch ($product) {
        case 1:
            $price = 22;
            $discount = 0.20;
            $productName = "Handdoek";
            break;
        case 2:
            $price = 17;
            $discount = 0.30;
            $productName = "Broek";
            break;
        case 3:
            $price = 10;
            $discount = 0.50;
            $productName = "Shirt";
            break;
    }

    // Bereken de prijs na korting
    $totalPrice = $amount * $price * (1 - $discount);
    $result = "Voor $amount $productName(s) betaal je &euro;" . number_format($totalPrice, 2) . ".";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stapelkorting bij HEMA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HTML-formulier -->
<h2>Stapelkorting bij HEMA</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>Kies een product:</label><br>
    <input type="radio" id="handdoek" name="product" value="1" <?php if ($product == 1) echo "checked"; ?>>
    <label for="handdoek">Handdoek (&euro;22, -20%)</label><br>
    <input type="radio" id="broek" name="product" value="2" <?php if ($product == 2) echo "checked"; ?>>
    <label for="broek">Broek (&euro;17, -30%)</label><br>
    <input type="radio" id="shirt" name="product" value="3" <?php if ($product == 3) echo "checked"; ?>>
    <label for="shirt">Shirt (&euro;10, -50%)</label><br>
    <span class="error"><?php echo $productError; ?></span><br><br>

    <label>Aantal:</label>
    <input type="text" name="amount" value="<?php echo $amount; ?>">
    <span class="error"><?php echo $amountError; ?></span><br><br>

    <input type="submit" value="Bereken prijs">
</form>

<!-- Resultaat tonen -->
<?php
if (!empty($result)) {
    echo "<h3>Resultaat:</h3>";
    echo "<p>$result</p>";
}
?>

</body>
</html>
