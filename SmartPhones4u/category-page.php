<?php include 'back-end.php' ?>
<?php
$db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
$query = $db->prepare('SELECT * FROM vendor');
$query->execute();

$vendors = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/phones.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'header.php' ?>

    <main>
        <div class="container-fluid bg-transparent my-4 p-3" style="position: relative;">
            <div class="row p-3">
                <div class="col-12">
                    <a href="index.php" class="text-decoration-none">/ Home</a>
                    <a href="#" class="btn btn-light disabled" tabindex="-1" aria-disabled="true">/ Product page</a>
                </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                    <h2>Welkom bij SmartPhones4u</h2>
                    <p>Selecteer een merk</p>
                </div>
            </div>
            <div class="row row-cols-2 g-3">
                <?php foreach ($vendors as $vendor) : ?>
                    <div class="col p-3">
                        <div class="card shadow-sm img-fluid">
                            <img src="<?= $vendor['img'] ?>" class="card-img-top card-image" alt="<?= $vendor['name'] ?>">
                            <div class="card-body">
                                <h2 class="card-title"><?= $vendor['name'] ?></h2>
                                <div class="d-grid gap-2 my-4">
                                    <a href="products-page.php?id=<?= $vendor['id'] ?>" class="btn btn-primary text-white"><?= $vendor['description'] ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php' ?>
</body>
</html>
