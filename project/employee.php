<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'store_employee' && $_SESSION['role'] !== 'admin') {
    header("Location: login-register.php"); // Redirect to login page if not admin
    exit();
}
// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=tech-one', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all products from the database
    $query = $db->query("SELECT * FROM products");
    $products = $query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle database connection errors
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmedewerker Beheer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-12 mt-5"></div>
        <div class="col-12 mt-5"></div>
    </div>
</div>

<?php require 'header.php' ?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5">Winkelmedewerker Beheer</h1>
        <p class="text-muted">Overzicht van functionaliteiten</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <!-- Eis 38 -->
        <div class="col">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title text-primary">Eis 38</h5>
                    <p class="card-text">De winkelmedewerker kan producten aanpassen.</p>
                    <a href="#manage-products" class="btn btn-primary text-white">Meer details</a>
                </div>
            </div>
        </div>

        <!-- Eis 39 -->
        <div class="col">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Eis 39</h5>
                    <p class="card-text">De winkelmedewerker kan de status van de bestelling bijwerken.</p>
                    <button class="btn btn-outline-success">Meer details</button>
                </div>
            </div>
        </div>

        <!-- Eis 40 -->
        <div class="col">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">Eis 40</h5>
                    <p class="card-text">De winkelmedewerker kan bestellingen bewerken.</p>
                    <button class="btn btn-outline-warning">Meer details</button>
                </div>
            </div>
        </div>

        <!-- Eis 41 -->
        <div class="col">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">Eis 41</h5>
                    <p class="card-text">De winkelmedewerker kan de inhoud van bestellingen bewerken.</p>
                    <button class="btn btn-outline-danger">Meer details</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5" id="manage-products">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="row g-0 align-items-center">
                        <div class="col-4 text-center p-3">
                            <img src="<?php echo $product['img']; ?>" alt="Product Image" class="img-fluid rounded"
                                 style="max-height: 100px;">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title text-truncate"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text mb-2">
                                    <span class="fw-bold text-success">$<?php echo number_format($product['price'], 2); ?></span>
                                </p>
                                <div class="d-flex justify-content-end">
                                    <a href="edit-product.php?id=<?php echo $product['id']; ?>"
                                       class="btn btn-sm btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-pen" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
