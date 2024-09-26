<?php
// Connect to the database
try {
    $db = new PDO('mysql:host=localhost;dbname=zoo', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the query
    $query = $db->prepare('SELECT * FROM animals');
    $query->execute();

    // Fetch the result
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    // Display the results
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
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
        .card-image {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container-fluid bg-transparent my-4 p-3" style="position: relative;">
    <div class="row p-3"></div>
    <div class="row row-cols-3 g-3 mt-5">
        <?php foreach ($result as $data) : ?>
            <div class="col p-3">
                <div class="card shadow-sm img-fluid">
                    <img src="<?= $data['img'] ?>" class="card-img-top card-image" alt="<?= $data['name'] ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?= $data['name'] ?></h2>
                        <div class="d-grid gap-2 my-4">
                            <a href="detail.php?id=<?= htmlspecialchars($data['id']) ?>"
                               class="btn btn-primary text-white">Check animal</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
