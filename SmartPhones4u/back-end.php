<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=smartphone4u", "root", "");
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}

$query = $db->prepare("SELECT * FROM vendor");
$query->execute();

$vendors = $query->fetchAll(PDO::FETCH_ASSOC);
?>


