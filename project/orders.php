<?php
session_start();
try {
    $db = new PDO("mysql:host=localhost;dbname=tech-one", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle order deletion
    if (isset($_POST['delete'])) {
        $order_id = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_NUMBER_INT);

        // Ensure the order belongs to the logged-in user
        $query = $db->prepare("SELECT id FROM orders WHERE id = :order_id AND user_id = :user_id");
        $query->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $query->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
            try {
                // Delete associated items from `order_items`
                $deleteItems = $db->prepare("DELETE FROM order_items WHERE order_id = :order_id");
                $deleteItems->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $deleteItems->execute();

                // Delete the order from `orders`
                $deleteOrder = $db->prepare("DELETE FROM orders WHERE id = :order_id");
                $deleteOrder->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $deleteOrder->execute();

                echo "<p class='text-success'>Order succesvol verwijderd.</p>";
            } catch (PDOException $e) {
                echo "<p class='text-danger'>Fout bij het verwijderen van de order. Probeer het opnieuw.</p>";
            }
        } else {
            echo "<p class='text-danger'>Order niet gevonden of niet van deze gebruiker.</p>";
        }
    }

    // Ensure the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Default SQL query
        $sql = "SELECT 
            orders.id AS order_id, 
            orders.user_id, 
            orders.status, 
            orders.first_name, 
            orders.last_name, 
            orders.address, 
            orders.zipcode, 
            orders.country, 
            orders.date_time, 
            order_items.product_id, 
            order_items.quantity, 
            products.name AS product_name, 
            products.img AS product_image
        FROM orders
        JOIN order_items ON orders.id = order_items.order_id
        JOIN products ON order_items.product_id = products.id
        WHERE orders.user_id = :user_id";

        // Add filtering conditions
        if (isset($_POST['filter'])) {
            $product_name_filter = filter_input(INPUT_POST, 'product_name_filter', FILTER_SANITIZE_STRING);
            $date_filter = filter_input(INPUT_POST, 'date_filter', FILTER_SANITIZE_STRING);

            if (!empty($product_name_filter)) {
                $sql .= " AND products.name LIKE :product_name_filter";
            }

            if (!empty($date_filter)) {
                $sql .= " AND orders.date_time LIKE :date_filter";
            }
        }

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        // Bind filtering parameters
        if (isset($_POST['filter'])) {
            if (!empty($product_name_filter)) {
                $product_name_filter = "%$product_name_filter%";
                $stmt->bindParam(':product_name_filter', $product_name_filter, PDO::PARAM_STR);
            }

            if (!empty($date_filter)) {
                $date_filter = "%$date_filter%";
                $stmt->bindParam(':date_filter', $date_filter, PDO::PARAM_STR);
            }
        }

        try {
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$results) {
                $results = [];
                echo "<p>No orders found.</p>";
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            die("<p class='text-danger'>Database error occurred.</p>");
        }
    } else {
        echo "<p class='text-danger'>User is not logged in.</p>";
        $results = [];
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger' role='alert'>Fout: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>

<!-- header ophalen -->
<?php require 'header.php' ?>

<div class="container p-3">
    <div class="row p-5"></div>
</div>

<div class="container my-4">
    <h1 class="mb-4">Orders Overzicht</h1>

    <form method="POST" class="mb-4">
        <div class="form-group">
            <label for="product_name_filter">Filter op productnaam</label>
            <input type="text" name="product_name_filter" id="product_name_filter" class="form-control"
                   placeholder="Productnaam filter"
                   value="<?= htmlspecialchars($_POST['product_name_filter'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="date_filter">Filter op datum</label>
            <input type="text" name="date_filter" id="date_filter" class="form-control" placeholder="YYYY-MM-DD"
                   value="<?= htmlspecialchars($_POST['date_filter'] ?? '') ?>">
        </div>
        <button type="submit" name="filter" class="btn btn-primary">Filteren</button>
    </form>

    <?php if (count($results) > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Status</th>
                <th>Name</th>
                <th>Address</th>
                <th>Zipcode</th>
                <th>Country</th>
                <th>Date/Time</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td>
                        <img src="<?= htmlspecialchars($row['product_image']) ?>"
                             alt="<?= htmlspecialchars($row['product_name']) ?>" class="img-thumbnail"
                             style="width: 50px;">
                    </td>
                    <td><?= htmlspecialchars($row["product_name"]); ?></td>
                    <td><?= htmlspecialchars($row["status"]); ?></td>
                    <td><?= htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]); ?></td>
                    <td><?= htmlspecialchars($row["address"]); ?></td>
                    <td><?= htmlspecialchars($row["zipcode"]); ?></td>
                    <td><?= htmlspecialchars($row["country"]); ?></td>
                    <td><?= htmlspecialchars($row["date_time"]); ?></td>
                    <td><?= htmlspecialchars($row["quantity"]); ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($row['order_id']) ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Annuleren</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Geen resultaten gevonden.</p>
    <?php endif; ?>
</div>
</body>
</html>
