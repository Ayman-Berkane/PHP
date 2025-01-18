<?php

// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update product details
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vendor = htmlspecialchars($_POST ['vendor']);
        $memory = floatval($_POST['memory']);
        $color = htmlspecialchars($_POST['color']);
        $name = htmlspecialchars($_POST['name']);
        $price = floatval($_POST['price']);

        $updateQuery = $db->prepare("INSERT INTO smartphone SET vendor = :vendor, name = :name, memory = :memory, price = :price, color = :color");
        $updateQuery->bindParam(':name', $name);
        $updateQuery->bindParam(':vendor', $vendor);
        $updateQuery->bindParam(':memory', $memory);
        $updateQuery->bindParam(':color', $color);
        $updateQuery->bindParam(':price', $price);
        if ($updateQuery->execute()) {
            header("Location: index.php?success=Product inserted");
            exit();
        } else {
            echo "Error inserting product!";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Insert smartphone</h1>
    <form method="post">
        <div class="mb-3">
            <label for="vendor" class="form-label">Vendor Name</label>
            <input type="text" class="form-control" id="vendor" name="vendor" value="" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">memory</label>
            <input type="number" step="0.01" class="form-control" id="memory" name="memory" value="" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" step="0.01" class="form-control" id="color" name="color" value="" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="" required>
        </div>
        <button type="submit" class="btn btn-success">Insert</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
