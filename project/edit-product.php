<?php
session_start();

// Check if the user is logged in and is a store employee
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'store_employee' && $_SESSION['role'] !== 'admin') {
    header("Location: login-register.php");
    exit();
}

// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=tech-one', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch product details
    if (isset($_GET['id'])) {
        $productId = intval($_GET['id']);
        $query = $db->prepare("SELECT * FROM products WHERE id = :id");
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

    // Update product details
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $price = floatval($_POST['price']);
        $img = htmlspecialchars($_POST['img']); // URL or path for the image

        $updateQuery = $db->prepare("UPDATE products SET name = :name, price = :price, img = :img WHERE id = :id");
        $updateQuery->bindParam(':name', $name);
        $updateQuery->bindParam(':price', $price);
        $updateQuery->bindParam(':img', $img);
        $updateQuery->bindParam(':id', $productId, PDO::PARAM_INT);

        if ($updateQuery->execute()) {
            header("Location: employee.php?success=Product updated");
            exit();
        } else {
            echo "Error updating product!";
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
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Edit Product</h1>
    <form method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="img" name="img" value="<?php echo htmlspecialchars($product['img']); ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="employee.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
