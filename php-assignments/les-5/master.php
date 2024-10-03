<?php
$db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
$query = $db->prepare('SELECT * FROM vendor');
$query->execute();

$vendors = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <tr>
        <th>Naam</th>
    </tr>

    <?php foreach ($vendors as $vendor) {
        echo "<tr>";
        echo "<td><a href='leerlingen.php?id=" . $vendor['id'] . "'>";
        echo "vendor</a></td>";
        echo "</tr>";
    }
        ?>

</table>
