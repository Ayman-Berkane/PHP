<?php
include_once 'openingHours.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartPhone4u Home</title>
    <link rel="stylesheet" href="css/phones.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>

<body>

<?php require 'header.php'?>

<main>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 text-center pt-3">
                <p class="fw-bold display-4"><?= $timeOfDay ?></p>
                <p class="fs-4">Wij zijn gespecialiseerd in in telefoons van Samsung en Apple</p>
                <p class="fs-4 fst-italic">De betekenis van dit Engelse woord SmartPhone is 'slimme telefoon'. Het is
                    een mobiele telefoon met extra functies. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center pt-2">
                <p class="fw-bold fs-4">
                <h2>Vandaag, <?= $currentDate ?></h2>
                <h2>
                    <?= $storeStatus ?>
                </h2>
                </p>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="card w-100">
                    <a href="vendor.php"><img src="img/home1.png" class="card-img-top"
                                              style="object-fit: cover; height: 24rem"></a>
                    <div class="card-body">
                        <a class="card-link text-dark text-decoration-none" href="vendor.php">Bestel bij ons je nieuwe
                            smartphone</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card w-100">
                    <a href="vendor.php"><img src="img/home2.png" class="card-img-top"
                                              style="object-fit: cover; height: 24rem"></a>
                    <div class="card-body">
                        <a class="card-link text-dark text-decoration-none" href="vendor.php">Keuze uit verschillende
                            soorten smartphones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require 'footer.php'?>
</body>
</html>
