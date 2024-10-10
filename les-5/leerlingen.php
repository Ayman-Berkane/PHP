<?php
$db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
$query = $db->prepare("SELECT * FROM smartphones WHERE vendor_id=". $_GET['id']);
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
</head>
<body>
<table>
    <tr>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
    </tr>
    <?php foreach ($smartphones as $smartphone) {
        echo '<tr>';
        echo '<td>'.$smartphone['name'].'</td>';
        echo '<td>'.$smartphone['description'].'</td>';
        echo '</tr>';
    }
    ?>
</table>
<br>
<a href="master.php">test</a>
</body>
</html>

