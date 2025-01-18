<?php

// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch product details
    if (isset($_GET['id'])) {
        $productId = intval($_GET['id']);
        $query = $db->prepare("SELECT * FROM smartphone WHERE id = :id");
        $query->bindParam(':id', $productId, PDO::PARAM_INT);
        $query->execute();
        $product = $query->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "Product not found!";
            exit();
        }
    } else {
        echo "Invalid product ID!";
        exit();
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
    <title>Details Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Details smartphone</h1>
    <form method="post">
        <div class="mb-3">
            <label for="vendor" class="form-label">Vendor Name</label>
            <input type="text" class="form-control" id="vendor" name="vendor" value="<?php echo htmlspecialchars($product['vendor']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">memory</label>
            <input type="number" step="0.01" class="form-control" id="memory" name="memory" value="<?php echo $product['memory']; ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" step="0.01" class="form-control" id="color" name="color" value="<?php echo $product['color']; ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" disabled>
        </div>
        <a href="index.php" class="btn btn-secondary">Go back</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
