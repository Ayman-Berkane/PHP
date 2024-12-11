<?php
session_start();
try {
    $db = new PDO("mysql:host=localhost;dbname=tech-one", "root", "");
    if (isset($_POST['verzenden'])) {
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_STRING);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);

        $query = $db->prepare("INSERT INTO cart (user_id, product_id, quantity, created_at, updated_at) VALUES (:user_id, :product_id, :quantity, NOW(), NOW())");
        $query->bindParam(':user_id', $_SESSION['user_id']);
        $query->bindParam(':product_id', $product_id);
        $query->bindParam(':quantity', $quantity);

        $query->execute();

        header("Location: cart.php");
        exit();
    }
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
}


// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create a single database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=tech-one', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch 'id' from either GET or POST (depending on how it's passed)
    $id = null;
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
    } elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];
    }

    // Check if ID is provided and valid
    if ($id === null) {
        echo "<p class='text-danger'>No valid product ID provided.</p>";
        exit;
    }

    // Fetch product details from database based on the ID
    $query = $db->prepare("SELECT * FROM products WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_ASSOC);

    // Get the start and end date values for filtering reviews
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;

    // Get the min and max rating values for filtering reviews
    $min_rating = isset($_POST['min_rating']) ? (int)$_POST['min_rating'] : null;
    $max_rating = isset($_POST['max_rating']) ? (int)$_POST['max_rating'] : null;

    // Base SQL query for fetching reviews
    $sql = "SELECT * FROM review WHERE product_id = :product_id";

    // Apply date range filter if provided
    if ($start_date) {
        $sql .= " AND time >= :start_date";
    }
    if ($end_date) {
        $sql .= " AND time <= :end_date";
    }

    // Apply rating range filter if provided
    if ($min_rating) {
        $sql .= " AND rating >= :min_rating";
    }
    if ($max_rating) {
        $sql .= " AND rating <= :max_rating";
    }

    // Prepare and execute the review query
    $query2 = $db->prepare($sql);
    $query2->bindParam(':product_id', $id, PDO::PARAM_INT);
    if ($start_date) {
        $query2->bindParam(':start_date', $start_date);
    }
    if ($end_date) {
        $query2->bindParam(':end_date', $end_date);
    }
    if ($min_rating) {
        $query2->bindParam(':min_rating', $min_rating, PDO::PARAM_INT);
    }
    if ($max_rating) {
        $query2->bindParam(':max_rating', $max_rating, PDO::PARAM_INT);
    }
    $query2->execute();
    $reviews = $query2->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
    exit; // Exit after displaying the error
}

// Review system logic
const NAME_REQUIRED = 'Naam invullen';
const REVIEW_REQUIRED = 'Review invullen';
const AGREE_REQUIRED = 'Voorwaarden accepteren';

$errors = [];
$inputs = [];

if (isset($_POST['send'])) {
    // Sanitize and validate name
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $inputs['name'] = $name;
    $name = trim($name);
    if (empty($name)) {
        $errors['name'] = NAME_REQUIRED;
    }

    // Sanitize and validate review content
    $review = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
    $inputs['content'] = $review;
    $review = trim($review);
    if (empty($review)) {
        $errors['content'] = REVIEW_REQUIRED;
    }

    // Validate rating
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    if ($rating < 1 || $rating > 5) {
        $errors['rating'] = 'Selecteer een rating tussen 1 en 5';
    }

    // Check if terms are accepted
    $agree = filter_input(INPUT_POST, 'agree', FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty($agree)) {
        $errors['agree'] = AGREE_REQUIRED;
    }

    // If no errors, insert review into database
    if (count($errors) === 0) {
        $sth = $db->prepare('INSERT INTO review (name, content, rating, product_id, likes) VALUES (:name, :content, :rating, :product_id, 0)');
        $sth->bindParam(':name', $inputs['name']);
        $sth->bindParam(':content', $inputs['content']);
        $sth->bindParam(':rating', $rating);
        $sth->bindParam(':product_id', $id, PDO::PARAM_INT); // Use the validated product ID
        $result = $sth->execute();

        if ($result) {
            echo "<p class='text-success'>Review succesvol toegevoegd!</p>";
            // Refresh reviews after adding a new one
            $query2->execute(); // Re-fetch reviews to show the new one
            $reviews = $query2->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "<p class='text-danger'>Er is een fout opgetreden bij het toevoegen van de review.</p>";
        }
    }
}

// Like system
if (isset($_POST['like_review'])) {
    $review_id = filter_input(INPUT_POST, 'review_id', FILTER_VALIDATE_INT);

    if ($review_id) {
        // Update the likes in the database
        $sth = $db->prepare('UPDATE review SET likes = likes + 1 WHERE id = :id');
        $sth->bindParam(':id', $review_id, PDO::PARAM_INT);
        $result = $sth->execute();

        if ($result) {
            echo "<p class='text-success'>Je hebt deze review leuk gevonden!</p>";
        } else {
            echo "<p class='text-danger'>Er is een fout opgetreden bij het liken van de review.</p>";
        }
    } else {
        echo "<p class='text-danger'>Ongeldig review ID.</p>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/rating.css">
    <link rel="stylesheet" href="css/like.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<!-- header ophalen -->
<?php require 'header.php' ?>

<main>
    <!-- start product container  -->
    <div class="container">
        <div class="row">
            <div class="col-12 p-5 mt-5"></div>
        </div>
        <div class="row">
            <div class="col-12 p-2"></div>
        </div>
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-6 bg-primary rounded-start p-3 text-white">
                    <h2><?= $product['name'] ?></h2>
                    <img src="<?= $product['img'] ?>" alt="">
                </div>
                <div class="col-6 bg-primary text-white rounded-end p-2 d-flex flex-column justify-content-center align-items-center">
                    <h2>€ <?= $product['price'] ?></h2>
                    <div class="text-center mt-4">
                        <p><?= $product['description'] ?></p>
                    </div>
                    <!-- Start of the form for this product -->
                    <form method="POST" action="">
                        <div class="d-grid gap-2 my-4">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="number" name="quantity" min="1" class="form-control w-100" placeholder="Quantity" required>
                            <input type="submit" name="verzenden" class="btn btn-light text-primary" value="Put in shopping cart">
                        </div>
                    </form>
                    <!-- End of the form -->
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-12 p-3"></div>
        </div>
    </div>
</main>

    <!-- end product container  -->

    <!-- start review container -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="text-primary">Reviews van anderen</h2>
                <p class="text-muted">Lees wat onze klanten te zeggen hebben</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="" method="post" class="p-4 bg-primary rounded">
                    <div class="row">
                        <!-- Date range inputs -->
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label text-white">Van datum</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                   value="<?= $_POST['start_date'] ?? '' ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label text-white">Tot datum</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                   value="<?= $_POST['end_date'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="row">
                        <!-- Rating range inputs -->
                        <div class="col-md-6 mb-3">
                            <label for="min_rating" class="form-label text-white">Minimale Rating</label>
                            <input type="number" class="form-control" id="min_rating" name="min_rating"
                                   value="<?= $_POST['min_rating'] ?? '' ?>" min="1" max="5">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="max_rating" class="form-label text-white">Maximale Rating</label>
                            <input type="number" class="form-control" id="max_rating" name="max_rating"
                                   value="<?= $_POST['max_rating'] ?? '' ?>" min="1" max="5">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="filter_reviews" class="btn btn-light text-primary px-4 py-2">Filter
                            Reviews
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <?php foreach ($reviews as $review): ?>
                <div class="col-md-4 mt-5">
                    <div class="card mb-4 shadow-sm border-0 rounded-lg position-relative">
                        <div class="card-body bg-primary position-relative" style="min-height: 200px;">
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <h6 class="card-subtitle mb-2 font-weight-bold text-white">
                                        <?= htmlspecialchars($review['name']); ?>
                                    </h6>
                                    <small class="text-white">Gepubliceerd
                                        op <?= htmlspecialchars($review['time']); ?></small>
                                </div>
                            </div>
                            <p class="card-text mb-3 text-white">
                                "<?= htmlspecialchars($review['content']); ?>"
                            </p>
                            <div class="stars">
                                <?php
                                $rating = (int)$review['rating'];
                                for ($i = 1; $i <= 5; $i++) {
                                    echo $i <= $rating ? '<span class="star filled">&#9733;</span>' : '<span class="star">&#9734;</span>';
                                }
                                ?>
                            </div>

                            <!-- Heart like button -->
                            <form method="post" class="hearts position-absolute bottom-0 end-0 p-3">
                                <input type="hidden" name="review_id" value="<?= $review['id']; ?>">
                                <?php if (isset($_SESSION['user'])): ?>
                                    <button type="submit" name="like_review" class="heart"
                                            style="border: none; background: none; cursor: pointer;">
                                        <span class="heart">&#10084;</span>
                                    </button>
                                <?php else: ?>
                                    <button type="submit" name="like_review" class="heart" disabled
                                            style="border: none; background: none; cursor: not-allowed;"
                                            title="You need to sign in or sign up to like this review.">
                                        <span class="heart" style="color: gray;">&#10084;</span>
                                    </button>
                                <?php endif; ?>
                                <span class="like-count text-white ms-2"><?= $review['likes'] ?> likes</span>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- end review container -->

    <?php if (isset($_SESSION['user'])): ?>
        <!-- start form container   -->
        <div class="container my-5 p-4 rounded shadow-lg bg-primary">
            <h2 class="text-center text-white mb-4">Laat een Review Achter</h2>
            <form method="post" action="">
                <!-- Name input field -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold text-white">Naam</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="<?= $_SESSION['user_name']; ?>" required
                           placeholder="Voer je naam in">
                    <div class="form-text text-danger">
                        <?= $errors['name'] ?? '' ?>
                    </div>
                </div>

                <!-- Star rating -->
                <div class="mb-3 d-flex flex-column">
                    <label class="form-label fw-bold text-white">Beoordeel je ervaring</label>
                    <div class="stars">
                        <input type="radio" name="rating" id="star1" value="1" required>
                        <label for="star1" class="star">&#9733;</label>
                        <input type="radio" name="rating" id="star2" value="2">
                        <label for="star2" class="star">&#9733;</label>
                        <input type="radio" name="rating" id="star3" value="3">
                        <label for="star3" class="star">&#9733;</label>
                        <input type="radio" name="rating" id="star4" value="4">
                        <label for="star4" class="star">&#9733;</label>
                        <input type="radio" name="rating" id="star5" value="5">
                        <label for="star5" class="star">&#9733;</label>
                    </div>
                    <div class="form-text text-danger">
                        <?= $errors['rating'] ?? '' ?>
                    </div>
                </div>

                <!-- Review textarea field -->
                <div class="mb-3">
                    <label for="content" class="form-label fw-bold text-white">Je Review</label>
                    <textarea name="content" id="content" class="form-control" rows="4" required
                              placeholder="Schrijf hier je review..."><?php echo $inputs['content'] ?? '' ?></textarea>
                    <div class="form-text text-danger">
                        <?= $errors['content'] ?? '' ?>
                    </div>
                </div>

                <!-- Agree to terms checkbox -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input text-white" id="agree" name="agree" value="agree"
                        <?php echo(isset($inputs['agree']) ? 'checked="checked"' : '') ?>>
                    <label class="form-check-label text-white" for="agree">Ik accepteer de voorwaarden</label>
                    <div class="form-text text-danger">
                        <?= $errors['agree'] ?? '' ?>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="text-center">
                    <input type="submit" class="btn btn-light text-primary btn-lg" name="send" value="Review Versturen">
                </div>
            </form>
        </div>
        <!-- end form container   -->
    <?php else: ?>
        <div class="container my-5 p-4 rounded shadow-lg bg-warning">
            <h2 class="text-center text-primary mb-4">Log in om een Review te kunnen plaatsen</h2>
            <p class="text-center text-primary">Je moet ingelogd zijn om een review achter te laten. <a
                        href="login-register.php" class="btn btn-primary text-warning">Registreer nu</a>
        </div>
    <?php endif; ?>

</main>

<!-- footer ophalen -->
<?php require 'footer.php' ?>
<script src="js/star.js"></script>
</body>
</html>

