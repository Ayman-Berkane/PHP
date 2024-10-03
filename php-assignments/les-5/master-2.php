<?php
$db = new PDO('mysql:host=localhost;dbname=tech-one', 'root', '');
$query = $db->prepare('SELECT * FROM vendors');
$query->execute();

$vendors = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <tr>
        <th>Naam</th>
    </tr>

    <?php foreach ($vendors as $vendor) {
        echo "<tr>";
        echo "<td><a href='hardware.php?id=" . $vendor['id'] . "'>";
        echo "" . $vendor['name'] . "</a></td>";
        echo "</tr>";
    }
    ?>

</table>
