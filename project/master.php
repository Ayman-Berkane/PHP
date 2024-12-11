<?php

include_once('classes/Vendor.php');

// Maak een nieuwe PDO-instantie om verbinding te maken met de MySQL-database
$db = new PDO('mysql:host=localhost;dbname=tech-one', 'root', '');

// Bereid een SQL-query voor om alle records van de tabel 'vendors' op te halen
$query = $db->prepare('SELECT * FROM vendors');

// Voer de query uit
$query->execute();

// Haal alle resultaten op en sla deze op in de array $vendors
$vendors = $query->fetchAll(PDO::FETCH_CLASS, "Vendor");
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category-page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <style>
        /*  card styling     */
        .card-image {
            height: 350px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>

<body>

<!-- header ophalen -->
<?php require 'header.php'; ?>

<main>
    <!-- start vendor container   -->
    <div class="container-fluid bg-transparent my-4 p-3" style="position: relative;">
        <div class="row p-3"></div>
        <div class="row row-cols-2 g-3 mt-5">
            <?php foreach ($vendors as $vendor) : ?>
                <div class="col p-3">
                    <div class="card shadow-sm img-fluid">
                        <img src="<?= $vendor->img ?>" class="card-img-top card-image" alt="<?= $vendor->name ?>">
                        <div class="card-body">
                            <h2 class="card-title"><?= $vendor->name ?></h2>
                            <div class="d-grid gap-2 my-4">
                                <a href="detail.php?id=<?php echo $vendor->id; ?>" class="btn btn-primary text-white">Check
                                    it out</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- end vendor container   -->
</main>

<!-- footer ophalen -->
<?php require 'footer.php'; ?>

</body>
</html>