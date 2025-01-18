<?php
// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all products from the database
    $query = $db->query("SELECT * FROM smartphone");
    $products = $query->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    // Handle database connection errors
    echo "Error: " . $e->getMessage();
    exit();
}
?>
<?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
    <div class="alert alert-success">De smartphone is succesvol verwijderd.</div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5">

    <h1>Smartphone Crud</h1>

    <!-- Display Products Table -->
    <table class="table table-bordered mt-5">
        <thead>
        <tr class="text-center">
            <th>Vendor</th>
            <th>Name</th>
            <th>Details</th
            <th>Name</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
        </thead>
        <tbody>
        <div class="">

        </div>
        <?php foreach ($products as $product): ?>
            <tr class="text-center">
                <td><?php echo $product['vendor']; ?></td>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td>
                    <div class="text-center">
                        <form action="" method="POST">
                            <a href=read.php?id=<?php echo $product['id']; ?>"
                               class="">
                                Details
                            </a>
                        </form>
                    </div>
                </td>
                <td>
                    <form action="" method="POST">
                        <a href=update-form.php?id=<?php echo $product['id']; ?>"
                           class="">
                            Edit
                        </a>
                    </form>
                </td>
                <td>
                    <!-- Delete Product Form -->
                    <form action="delete.php>id=<?php echo $product['id'];?>" method="POST" class="d-inline">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <a href="delete.php?id=<?php echo $product['id']; ?>">Delete</a>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="insert.php">insert</a>
</div>
</body>
</html>
