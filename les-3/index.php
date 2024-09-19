<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=cars", "root", "");
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}

$query = $db->prepare("SELECT * FROM electricCars");
$query->execute();

$cars = $query->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
var_dump($cars);
echo "</pre>";

foreach ($cars as $car) {
    echo $car['name'] . " ";
    echo $car['range'] . " ";
    echo $car['price'] . "<br>";
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
</head>
<body>
<table>
    <tr>
        <th>Name</th>
        <th>Range</th>
        <th>Price</th>
    </tr>
    <?php foreach ($cars as $car) : ?>
        <tr>
            <td><?= $car['name'] ?></td>
            <td><?= $car['range'] ?></td>
            <td><?= $car['price'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
