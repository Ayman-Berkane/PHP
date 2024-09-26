<?php
// Connect to the database
try {
    $db = new PDO('mysql:host=localhost;dbname=zoo', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Debug: Check if the ID is being passed in the URL
    if (isset($_GET['id'])) {
        echo "ID received: " . htmlspecialchars($_GET['id']) . "<br>"; // Debug output to verify the id
    } else {
        echo "No ID received<br>";
    }

    // Validate and fetch data based on ID
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare and execute the query
        $query = $db->prepare("SELECT * FROM animals WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        // Fetch the result
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // Check if data is found
        if ($result) {
            foreach ($result as $data) {
                echo "Artikelnummer: " . htmlspecialchars($data['id']) . "<br>";
                echo "Name: " . htmlspecialchars($data['name']) . "<br>";
                echo "<img src='" . htmlspecialchars($data['img']) . "' alt='" . htmlspecialchars($data['name']) . "'><br>";
                echo "Description: " . htmlspecialchars($data['description']) . "<br>";
            }
        } else {
            echo "No hardware found with this ID.";
        }
    } else {
        echo "Invalid ID.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<a href="master.php">Terug naar master pagina</a>
