<?php
$db = new PDO('mysql:host=localhost;dbname=tech-one', 'root', '');
$query = $db->prepare("SELECT * FROM products WHERE vendor_id=". $_GET['id']);
$query->execute();

$products = $query->fetchAll(PDO::FETCH_ASSOC);
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
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
    </tr>
    <?php foreach ($products as $product) {
        echo '<tr>';
        echo '<td>'.$product['name'].'</td>';
        echo '<td>'.$product['description'].'</td>';
        echo '<td>'.$product['img'].'</td>';
        echo '<td>'.$product['price'].'</td>';
        echo '</tr>';
    }
    ?>
</table>
<br>
<a href="master-2.php">test</a>
</body>
</html>

