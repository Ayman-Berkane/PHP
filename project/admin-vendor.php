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

    // Fetch all vendors (categories) from the database
    $categoryQuery = $db->query("SELECT * FROM vendors");
    $categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);

    // Handle form submissions for categories
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            // Add Category
            if ($action === 'add_category') {
                $name = trim($_POST['name']);
                $description = trim($_POST['description']);
                $img = null;  // Default value for img

                // Handle img Upload
                if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                    $imgTmpName = $_FILES['img']['tmp_name'];
                    $imgName = basename($_FILES['img']['name']);
                    $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

                    // Validate file extension (only allow imgs)
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array($imgExt, $allowedExtensions)) {
                        $imgPath = 'uploads/' . uniqid() . '.' . $imgExt;

                        // Move the uploaded file to the server's upload directory
                        if (move_uploaded_file($imgTmpName, $imgPath)) {
                            $img = $imgPath;
                        } else {
                            $error = "Error uploading the img.";
                        }
                    } else {
                        $error = "Invalid img format. Only JPG, PNG, and GIF are allowed.";
                    }
                }

                // Insert new category into the database
                if (!empty($name) && !empty($description)) {
                    $insertQuery = $db->prepare("INSERT INTO vendors (name, description, img) VALUES (:name, :description, :img)");
                    $insertQuery->bindParam(':name', $name);
                    $insertQuery->bindParam(':description', $description);
                    $insertQuery->bindParam(':img', $img);
                    $insertQuery->execute();

                    header("Location: admin.php"); // Redirect to admin page after adding
                    exit();
                } else {
                    $error = "Both name and description are required.";
                }
            }

            // Update Category
            if ($action === 'update_category') {
                $id = $_POST['id'];
                $name = trim($_POST['name']);
                $description = trim($_POST['description']);
                $img = $_POST['current_img']; // Keep the current img path by default

                // Handle img Upload for Update
                if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                    $imgTmpName = $_FILES['img']['tmp_name'];
                    $imgName = basename($_FILES['img']['name']);
                    $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

                    // Validate file extension (only allow imgs)
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array($imgExt, $allowedExtensions)) {
                        $imgPath = 'uploads/' . uniqid() . '.' . $imgExt;

                        // Move the uploaded file to the server's upload directory
                        if (move_uploaded_file($imgTmpName, $imgPath)) {
                            $img = $imgPath;
                        } else {
                            $error = "Error uploading the img.";
                        }
                    } else {
                        $error = "Invalid img format. Only JPG, PNG, and GIF are allowed.";
                    }
                }

                // Update category in the database
                if (!empty($id) && !empty($name) && !empty($description)) {
                    $updateQuery = $db->prepare("UPDATE vendors SET name = :name, description = :description, img = :img WHERE id = :id");
                    $updateQuery->bindParam(':id', $id);
                    $updateQuery->bindParam(':name', $name);
                    $updateQuery->bindParam(':description', $description);
                    $updateQuery->bindParam(':img', $img);
                    $updateQuery->execute();

                    header("Location: admin.php"); // Redirect to admin page after updating
                    exit();
                } else {
                    $error = "All fields are required for updating.";
                }
            }

            // Delete Category
            if ($action === 'delete_category') {
                $id = $_POST['id'];

                if (!empty($id)) {
                    // Fetch the img path before deletion
                    $deleteQuery = $db->prepare("SELECT img FROM vendors WHERE id = :id");
                    $deleteQuery->bindParam(':id', $id);
                    $deleteQuery->execute();
                    $category = $deleteQuery->fetch(PDO::FETCH_ASSOC);
                    $imgPath = $category['img'];

                    // Delete the category from the database
                    $deleteQuery = $db->prepare("DELETE FROM vendors WHERE id = :id");
                    $deleteQuery->bindParam(':id', $id);
                    $deleteQuery->execute();

                    // Delete the img file from the server
                    if ($imgPath && file_exists($imgPath)) {
                        unlink($imgPath);
                    }

                    header("Location: admin-vendor.php"); // Redirect to admin page after deleting
                    exit();
                } else {
                    $error = "Invalid category ID.";
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
    <title>Admin - Manage Categories</title>
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
    <h1 class="text-primary">Admin Panel - Manage Categories</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- Add Category Form -->
    <div class="bg-primary p-3 rounded-end rounded-start mt-3">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_category">

            <div class="mb-3">
                <label for="name" class="form-label text-white">Category Name</label>
                <input type="text" placeholder="Enter vendor name" class="form-control form-control-lg" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-white">Description</label>
                <textarea class="form-control form-control-lg" placeholder="Enter vendor description" id="description" name="description" rows="3" value="Enter product description"
                          required></textarea>
            </div>

            <div class="mb-3">
                <label for="img" class="form-label text-white">Category Image</label>
                <input type="file" class="form-control form-control-lg bg-light text-primary" id="img" name="img"
                       accept="image/*">
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-light text-primary btn-lg">Add Category</button>
            </div>
        </form>
    </div>

    <!-- Display Categories Table -->
    <table class="table table-bordered mt-5">
        <thead>
        <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>img</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category['id']; ?></td>
                <td><?php echo htmlspecialchars($category['name']); ?></td>
                <td><?php echo htmlspecialchars($category['description']); ?></td>
                <td>
                    <?php if ($category['img']): ?>
                        <img src="<?php echo htmlspecialchars($category['img']); ?>" alt="img" style="width: 100px;">
                    <?php endif; ?>
                </td>
                <td>
                    <!-- Update Category Form -->
                    <form action="" method="POST" class="d-inline">
                        <input type="hidden" name="action" value="update_category">
                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                        <input type="text" name="name" value="<?php echo htmlspecialchars($category['name']); ?>"
                               required>
                        <input type="text" name="description"
                               value="<?php echo htmlspecialchars($category['description']); ?>" required>
                        <input type="hidden" name="current_img" value="<?php echo $category['img']; ?>">
                        <button class="btn btn-warning btn-sm" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
                                <path fill-rule="evenodd"
                                      d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
                            </svg>
                        </button>
                    </form>

                    <!-- Delete Category Form -->
                    <form action="" method="POST" class="d-inline">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                        <button class="btn btn-danger btn-sm" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
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
