<?php
// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=smartphone4u', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Haal de gegevens van de specifieke record op
        $stmt = $db->prepare("SELECT * FROM smartphone WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "De geselecteerde smartphone bestaat niet.";
            exit();
        }

        // Verwijder de record na bevestiging
        if (isset($_POST['confirm'])) {
            $deleteStmt = $db->prepare("DELETE FROM smartphone WHERE id = :id");
            $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $deleteStmt->execute();

            // Redirect na verwijderen
            header("Location: index.php?status=deleted");
            exit();
        }
    } else {
        // Geen ID gevonden, redirect naar overzicht
        header("Location: index.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bevestig Verwijdering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Weet je zeker dat je deze smartphone wilt verwijderen?</h1>
    <div class="mt-4">
        <table class="table table-bordered mt-5">
            <thead>
            <tr class="text-center">
                <th>Name</th>
                <th>Memory</th>
                <th>Color</th>
                <th>price</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['memory']); ?></td>
                    <td><?php echo htmlspecialchars($product['color']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <form method="POST">
        <button type="submit" name="confirm" class="btn btn-danger">Ja, Verwijder</button>
        <a href="index.php" class="btn btn-secondary">Nee, Annuleer</a>
    </form>
</div>
</body>
</html>
