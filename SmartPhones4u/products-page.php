<?php
$db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
$query = $db->prepare("SELECT * FROM smartphones WHERE vendor_id=" . $_GET['id']);
$query->execute();

$smartphones = $query->fetchAll(PDO::FETCH_ASSOC);
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
        img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>

<body>
<?php require 'header.php'?>
<main>
    <div class="container-fluid bg-transparent my-4 p-3" style="position: relative;">
        <div class="row p-3">
            <div class="col-12">
                <a href="index.php" class="mx-2">Home</a>
                <a href="category-page.php">/ Category</a>
                <a href="#" class="btn btn-light disabled" tabindex="-1" aria-disabled="true">/ Product page</a>
            </div>
        </div>
        <div class="row row-cols-3 g-3">
            <?php foreach ($smartphones as $smartphone) : ?>
                <div class="col p-3">
                    <div class="card shadow-sm img-fluid">
                        <img src="<?= $smartphone['img'] ?>" class="card-img-top card-image"
                             alt="<?= $smartphone['name'] ?>">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <span class="float-start badge rounded-pill bg-primary">€<?= $smartphone['price'] ?></span>
                                <span class="float-end"><a href="#">Example</a></span>
                            </div>
                            <h6 class="card-title"><?= $smartphone['name'] ?></h6>
                            <div class="d-grid gap-2 my-4">
                                <a href="?id=<?= htmlspecialchars($data['id']) ?>"
                                   class="btn btn-primary text-white">Check offer</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require 'footer.php' ?>
</body>
</html>

