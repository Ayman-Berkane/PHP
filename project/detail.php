<?php
// Maak een verbinding met de database
try {
    $db = new PDO('mysql:host=localhost;dbname=tech-one', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Debug: Controleer of de ID wordt doorgegeven in de URL
    if (isset($_GET['id'])) {
        // Ontvang de ID en echo deze voor debugdoeleinden
        echo "ID ontvangen: " . htmlspecialchars($_GET['id']) . "<br>"; // Veiligheidsmaatregel om XSS te voorkomen
    } else {
        echo "Geen ID ontvangen<br>";
    }

    // Base query
    $queryStr = "SELECT * FROM products WHERE vendor_id = :id";

    // Filteren op naam (indien gevraagd)
    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $name = "%" . $_GET['name'] . "%";
        $queryStr .= " AND name LIKE :name";
    }

    // Sorteren op alfabetische volgorde of prijs
    if (isset($_GET['sort']) && $_GET['sort'] == 'price') {
        $queryStr .= " ORDER BY price";
    } elseif (isset($_GET['sort']) && $_GET['sort'] == 'alphabet') {
        $queryStr .= " ORDER BY name";
    }

    // Valideer en haal gegevens op op basis van de ID
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $query = $db->prepare($queryStr);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        // Bind de naam parameter voor de filter, indien van toepassing
        if (isset($name)) {
            $query->bindParam(':name', $name, PDO::PARAM_STR);
        }

        $query->execute();

        // Haal alle producten op
        $products = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Foutmelding voor een ongeldige ID
        echo "Ongeldige ID.";
    }
} catch (PDOException $e) {
    // Toon de foutmelding bij een databasefout
    echo "Fout: " . $e->getMessage();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <style>
        /* card styling */
        .card-image {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- header ophalen  -->
<?php require 'header.php' ?>

<!-- start filteren en sorteren container -->
<main>
    <div class="container-fluid bg-transparent my-4 p-3" style="position: relative;">
        <div class="row">
            <div class="col-12 mt-3"></div>
        </div>
        <div class="row p-3 mt-5">
            <form action="" method="get" class="form-inline mb-4">
                <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">

                <div class="row align-items-center">
                    <!-- Filteren op naam -->
                    <div class="col-md-4 col-sm-12 mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Filter op naam" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                    </div>

                    <!-- Sorteren opties -->
                    <div class="col-md-4 col-sm-12 mb-3">
                        <select name="sort" class="form-select">
                            <option value="">Sorteren</option>
                            <option value="alphabet" <?= (isset($_GET['sort']) && $_GET['sort'] == 'alphabet') ? 'selected' : '' ?>>Alfabetisch</option>
                            <option value="price" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price') ? 'selected' : '' ?>>Prijs</option>
                        </select>
                    </div>

                    <!-- Toepassen button -->
                    <div class="col-md-4 col-sm-12 mb-3">
                        <button type="submit" class="btn btn-primary w-100">Toepassen</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row row-cols-3 g-3">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col p-3">
                        <div class="card shadow-sm img-fluid">
                            <img src="<?= $product['img'] ?>" class="card-img-top card-image" alt="<?= $product['name'] ?>">
                            <div class="card-body">
                                <div class="clearfix mb-3">
                                    <span class="float-start badge rounded-pill bg-primary">€<?= $product['price'] ?></span>
                                    <span class="float-end"><a href="#">Example</a></span>
                                </div>
                                <h6 class="card-title"><?= $product['name'] ?></h6>
                                <div class="d-grid gap-2 my-4">
                                    <a href="product-page.php?id=<?= htmlspecialchars($product['id']) ?>"
                                       class="btn btn-primary text-white">Check offer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Geen producten gevonden</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- footer ophalen  -->
<?php require 'footer.php' ?>

</body>
</html>
