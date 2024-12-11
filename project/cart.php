<?php

session_start();

try {
    // Database connection
    $db = new PDO("mysql:host=localhost;dbname=tech-one", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "<p class='text-danger'>User is not logged in.</p>";
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Handle item deletion from cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        $cart_id = filter_input(INPUT_POST, 'cart_id', FILTER_SANITIZE_NUMBER_INT);

        if ($cart_id) {
            $deleteQuery = $db->prepare("DELETE FROM cart WHERE id = :cart_id AND user_id = :user_id");
            $deleteQuery->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $deleteQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            if ($deleteQuery->execute()) {
                echo "<p class='text-success'>Item successfully removed from cart.</p>";
            } else {
                echo "<p class='text-danger'>Failed to remove item from cart. Please try again.</p>";
            }
        } else {
            echo "<p class='text-danger'>Invalid cart ID.</p>";
        }
    }

    // Fetch cart items and related product details for the logged-in user
    $cartQuery = $db->prepare(
        "SELECT 
            cart.id AS cart_id, cart.quantity, cart.created_at, 
            products.name AS product_name, products.price AS product_price, products.img AS product_img
         FROM cart 
         INNER JOIN products ON cart.product_id = products.id 
         WHERE cart.user_id = :user_id"
    );
    $cartQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $cartQuery->execute();

    $cartItems = $cartQuery->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p class='text-danger'>An error occurred. Please try again later.</p>";
    error_log("Database error: " . $e->getMessage()); // Log the error for developers
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uw Winkelwagen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

<?php require 'header.php'?>

<main>
    <section class="h-100 gradient-custom">
        <div class="container">
            <div class="row p-5"></div>
        </div>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Uw Winkelwagen</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0" style="color: #007bff;">Selecteer producten om te bestellen</p>
                            </div>

                            <?php if (!empty($cartItems)) : ?>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Aantal</th>
                                        <th>Prijs</th>
                                        <th>Totaal</th>
                                        <th>Toegevoegd Op</th>
                                        <th>Actie</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($cartItems as $item) : ?>
                                        <tr>
                                            <td>
                                                <img src="<?= htmlspecialchars($item['product_img']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="img-thumbnail" style="width: 50px;">
                                                <?= htmlspecialchars($item['product_name']) ?>
                                            </td>
                                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                                            <td>€<?= number_format($item['product_price'], 2) ?></td>
                                            <td>€<?= number_format($item['product_price'] * $item['quantity'], 2) ?></td>
                                            <td><?= htmlspecialchars($item['created_at'] ?? 'N/A') ?></td>
                                            <td>
                                                <form method="POST" action="">
                                                    <input type="hidden" name="cart_id" value="<?= htmlspecialchars($item['cart_id']) ?>">
                                                    <button type='submit' name='delete' class='btn btn-danger'>Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="text-end">
                                    <h5 class="text-uppercase">Totaal te betalen: <span class="h2 mb-0 ms-2">€<?php echo number_format(array_sum(array_map(function($item) { return $item['product_price'] * $item['quantity']; }, $cartItems)), 2); ?></span></h5>
                                    <a href="order-form.php" class="btn btn-primary mt-3">Doorgaan naar afrekenen</a>
                                </div>
                            <?php else : ?>
                                <p>Uw winkelwagen is leeg.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>

