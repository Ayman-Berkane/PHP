<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
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

    // Handle form submissions for adding, updating, and deleting products
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            // Add Product
            if ($action === 'add') {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $vendor_id = $_POST['vendor_id'];

                // Handle file upload
                if (isset($_FILES['image'])) {
                    $fileError = $_FILES['image']['error'];
                    $fileTmpPath = $_FILES['image']['tmp_name'];
                    $fileName = $_FILES['image']['name'];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if ($fileError === UPLOAD_ERR_OK) {
                        if (in_array($fileExtension, $allowedExtensions)) {
                            $uploadDir = 'uploads/';
                            $destination = $uploadDir . uniqid() . '.' . $fileExtension;

                            if (move_uploaded_file($fileTmpPath, $destination)) {
                                // Insert the product into the database
                                $insertQuery = $db->prepare("INSERT INTO products (name, img, description, price, vendor_id) VALUES (:name, :img, :description, :price, :vendor_id)");
                                $insertQuery->bindParam(':name', $name);
                                $insertQuery->bindParam(':img', $destination);
                                $insertQuery->bindParam(':description', $description);
                                $insertQuery->bindParam(':price', $price);
                                $insertQuery->bindParam(':vendor_id', $vendor_id);
                                $insertQuery->execute();

                                header("Location: admin.php"); // Redirect to admin page after adding
                                exit();
                            } else {
                                echo "Failed to move uploaded file. Check directory permissions.";
                            }
                        } else {
                            echo "Invalid file type. Allowed types: JPG, JPEG, PNG, GIF.";
                        }
                    } else {
                        switch ($fileError) {
                            case UPLOAD_ERR_INI_SIZE:
                                echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                                break;
                            case UPLOAD_ERR_FORM_SIZE:
                                echo "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.";
                                break;
                            case UPLOAD_ERR_PARTIAL:
                                echo "The uploaded file was only partially uploaded.";
                                break;
                            case UPLOAD_ERR_NO_FILE:
                                echo "No file was uploaded.";
                                break;
                            case UPLOAD_ERR_NO_TMP_DIR:
                                echo "Missing a temporary folder.";
                                break;
                            case UPLOAD_ERR_CANT_WRITE:
                                echo "Failed to write file to disk.";
                                break;
                            case UPLOAD_ERR_EXTENSION:
                                echo "A PHP extension stopped the file upload.";
                                break;
                            default:
                                echo "Unknown file upload error.";
                                break;
                        }
                    }
                } else {
                    echo "No file was uploaded.";
                }
            }
        }
    }

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
    <title>Admin - Manage Products</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="header">
    <!-- Container for the full header -->
    <div class="container-fluid">
        <!-- Row inside the container to align sections horizontally -->
        <div class="row bg-primary p-2 fixed-top">

            <!-- Column for the brand name "TechOne" -->
            <div class="col-2 d-flex justify-content-start align-items-center">
                <h2 class="text-white">TechOne</h2>
            </div>

            <!-- Column for the navigation bar -->
            <div class="col-9">
                <!-- Navigation bar container for navigation items and expandable menus -->
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <!-- Toggle button for mobile navigation -->
                        <button class="navbar-toggler ms-auto bg-white text-white" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Collapsible menu options -->
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav d-flex justify-content-around align-items-center w-100">
                                <!-- Menu options in the navigation bar -->
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="index.php">HOME</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="master.php">CATEGORY</a>
                                </li>

                                <!-- Dropdown menu for "PRODUCTS PAGE" -->
                                <div class="dropdown">
                                    <button class="btn nav-item fs-6 mt-2 nav-link text-white" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        PRODUCTS PAGE
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="products-page.php">Hardware</a></li>
                                        <li><a class="dropdown-item" href="products-page-pre.php">Pre-built</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>

                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="contact-page.php">CONTACT
                                        PAGE</a>
                                </li>

                                <?php if (isset($_SESSION['user'])): ?>
                                    <li class="nav-item fs-6 d-flex flex-column align-items-center">
                                        <!-- Avatar Image on top -->
                                        <img src="<?= htmlspecialchars($_SESSION['img']); ?>"
                                             class="rounded-circle shadow-4"
                                             style="width: 50px; height: 50px;" alt="Avatar"/>
                                        <!-- User's Name Below the Avatar -->
                                        <div class="dropdown">
                                            <button class="btn nav-item fs-6 nav-link text-white" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <?= $_SESSION['user_name']; ?>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="nav-link text-dark text-opacity-100" href="profile.php">PROFILE</a>
                                                </li>
                                                <!-- Check if the user is an admin -->
                                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                                    <li><a class="nav-link text-dark text-opacity-100" href="admin.php">ADMIN
                                                            PRODUCTS</a></li>
                                                    <li><a class="nav-link text-dark text-opacity-100"
                                                           href="admin-vendor.php">ADMIN
                                                            VENDORS</a></li>
                                                <?php endif; ?>
                                                <li><a class="nav-link text-dark text-opacity-100" href="logout.php">LOGOUT</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php else: ?>
                                    <!-- Display login/register link if the user is not logged in -->
                                    <li class="nav-item fs-6 mt-2">
                                        <a class="nav-link text-opacity-100 text-white" href="login-register.php">LOGIN
                                            / REGISTER</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <?php if (isset($_SESSION['user'])): ?>
                <!-- Column for the shopping cart icon -->
                <div class="col d-flex justify-content-center align-items-center">
                    <a href="cart.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                             class="bi bi-bag text-white" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                        </svg>
                    </a>
                </div>x
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 mt-5"></div>
        <div class="col-12 mt-5"></div>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-primary">Admin Panel - Manage Products</h1>

    <!-- Compact Modern Add Product Form -->
    <div class="bg-primary p-4 rounded shadow">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">

            <div class="mb-3">
                <label for="name" class="form-label text-white">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-white">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                          placeholder="Enter product description" required></textarea>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="price" class="form-label text-white">Price ($)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="0.00"
                           required>
                </div>
                <div class="col-md-6">
                    <label for="vendor_id" class="form-label text-white">Vendor ID</label>
                    <input type="number" class="form-control" id="vendor_id" name="vendor_id"
                           placeholder="Enter vendor ID" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label text-white">Product Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-light btn-lg text-primary fw-bold">Add Product</button>
            </div>
        </form>
    </div>

    <!-- Display Products Table -->
    <table class="table table-bordered mt-5">
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td>$<?php echo number_format($product['price'], 2); ?></td>
                <td>
                    <form action="" method="POST">
                        <a href="edit-product.php?id=<?php echo $product['id']; ?>"
                           class="btn btn-sm btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                            </svg>
                        </a>
                    </form>
                </td>
                <td>
                    <!-- Delete Product Form -->
                    <form action="" method="POST" class="d-inline">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button class="btn btn-outline-danger btn-sm" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
