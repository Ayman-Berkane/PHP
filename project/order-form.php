<?php
session_start();
try {
    // Databaseverbinding
    $db = new PDO("mysql:host=localhost;dbname=tech-one", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user_id = $_SESSION['user_id'] ?? 1; // Vaste user_id voor testdoeleinden

    // Haal winkelwageninhoud op
    $cart_items = [];
    $cart_query = $db->prepare("SELECT cart.*, products.name AS product_name, products.price 
                                FROM cart 
                                JOIN products ON cart.product_id = products.id
                                WHERE cart.user_id = :user_id");
    $cart_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $cart_query->execute();
    $cart_items = $cart_query->fetchAll(PDO::FETCH_ASSOC);

    // Controleer of het formulier is ingediend
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $status = 'Pending'; // Standaardstatus
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING);
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
        $date_time = date('Y-m-d H:i:s'); // Huidige datum en tijd

        // Voeg de order toe aan de `orders` tabel
        $order_query = $db->prepare("
            INSERT INTO orders (user_id, status, first_name, last_name, address, zipcode, country, date_time)
            VALUES (:user_id, :status, :first_name, :last_name, :address, :zipcode, :country, :date_time)");

        $order_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $order_query->bindParam(':status', $status);
        $order_query->bindParam(':first_name', $first_name);
        $order_query->bindParam(':last_name', $last_name);
        $order_query->bindParam(':address', $address);
        $order_query->bindParam(':zipcode', $zipcode);
        $order_query->bindParam(':country', $country);
        $order_query->bindParam(':date_time', $date_time);
        $order_query->execute();

        // Haal het ID van de net ingevoegde order op
        $order_id = $db->lastInsertId();

        // Voeg de winkelwagenproducten toe aan de `order_items` tabel
        foreach ($cart_items as $item) {
            $item_query = $db->prepare("
                INSERT INTO order_items (order_id, product_id, quantity)
                VALUES (:order_id, :product_id, :quantity)
            ");
            $item_query->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $item_query->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
            $item_query->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
            $item_query->execute();
        }

        // Maak de winkelwagen leeg
        $clear_cart_query = $db->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $clear_cart_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $clear_cart_query->execute();

        echo "<p class='text-success'>Bestelling succesvol geplaatst!</p>";
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Fout: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelformulier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>

<!-- header ophalen -->
<?php require 'header.php' ?>

<div class="container my-5">
    <h1>Winkelwagen</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product</th>
            <th>Prijs</th>
            <th>Aantal</th>
            <th>Totaal</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        foreach ($cart_items as $item):
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td>€<?= number_format($item['price'], 2) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td>€<?= number_format($subtotal, 2) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Totaal</strong></td>
            <td>€<?= number_format($total, 2) ?></td>
        </tr>
        </tbody>
    </table>

    <h1>Bestelformulier</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="first_name">Voornaam</label>
            <input type="text" value="<?= $_SESSION['user_name']; ?>" name="first_name" id="first_name"
                   class="form-control" required>
        </div>
        <div class="form-group">
            <label for="last_name">Achternaam</label>
            <input type="text" value="<?= htmlspecialchars($_SESSION['last_name']); ?>" name="last_name" id="last_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Adres</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="zipcode">Postcode</label>
            <input type="text" name="zipcode" id="zipcode" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="country">Land</label>
            <input type="text" name="country" id="country" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Bestel</button>
    </form>
</div>
</body>
</html>
