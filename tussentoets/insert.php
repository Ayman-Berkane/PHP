<?php

// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $errors = [];

    // Update product details
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vendor = htmlspecialchars($_POST['vendor']);
        $memory = floatval($_POST['memory']);
        $color = htmlspecialchars($_POST['color']);
        $name = htmlspecialchars($_POST['name']);
        $price = floatval($_POST['price']);

        // Validate individual fields
        if (empty($vendor)) {
            $errors['vendor'] = "Vendor name is required.";
        }

        if (empty($name)) {
            $errors['name'] = "Product name is required.";
        }

        if (empty($memory)) {
            $errors['memory'] = "Memory is required.";
        }

        if (empty($color)) {
            $errors['color'] = "Color is required.";
        }

        if (empty($price)) {
            $errors['price'] = "Price is required.";
        }

        // If no errors, insert into the database
        if (empty($errors)) {
            $insertQuery = $db->prepare("INSERT INTO smartphone (vendor, name, memory, price, color) VALUES (:vendor, :name, :memory, :price, :color)");
            $insertQuery->bindParam(':vendor', $vendor);
            $insertQuery->bindParam(':name', $name);
            $insertQuery->bindParam(':memory', $memory);
            $insertQuery->bindParam(':color', $color);
            $insertQuery->bindParam(':price', $price);

            if ($insertQuery->execute()) {
                header("Location: index.php?success=Product inserted");
                exit();
            } else {
                echo "Error inserting product!";
            }
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
            <input type="text" class="form-control" id="vendor" name="vendor" value="<?php echo htmlspecialchars($_POST['vendor'] ?? ''); ?>">
            <?php if (!empty($errors['vendor'])): ?>
                <div class="text-danger"><?php echo $errors['vendor']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
            <?php if (!empty($errors['name'])): ?>
                <div class="text-danger"><?php echo $errors['name']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="memory" class="form-label">Memory</label>
            <input type="number" step="0.01" class="form-control" id="memory" name="memory" value="<?php echo htmlspecialchars($_POST['memory'] ?? ''); ?>">
            <?php if (!empty($errors['memory'])): ?>
                <div class="text-danger"><?php echo $errors['memory']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="<?php echo htmlspecialchars($_POST['color'] ?? ''); ?>">
            <?php if (!empty($errors['color'])): ?>
                <div class="text-danger"><?php echo $errors['color']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>">
            <?php if (!empty($errors['price'])): ?>
                <div class="text-danger"><?php echo $errors['price']; ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-success">Insert</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
