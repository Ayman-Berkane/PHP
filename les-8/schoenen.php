<?php
// Databaseverbinding maken
$db = new PDO('mysql:host=localhost;dbname=shoes;charset=utf8', 'root', '');

// Functie om het aantal schoenmerken te tellen
function countBrands($db)
{
    $query = $db->prepare("SELECT COUNT(*) as total FROM brand");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

// Haal alle merken op
$query = $db->prepare("SELECT * FROM brand");
$query->execute();
$brands = $query->fetchAll(PDO::FETCH_ASSOC);

$brandCount = countBrands($db); // Aantal schoenmerken tellen

const BRAND_REQUIRED = 'Merk moet ingevuld zijn';

$errors = [];
$inputs = [];

if (isset($_POST['send'])) {
    // Schoenmerk invoer
    $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_SPECIAL_CHARS);
    $inputs['brand'] = $brand;
    $brand = trim($brand);

    // Validatie
    if (empty($brand)) {
        $errors['brand'] = BRAND_REQUIRED;
    }

    if (count($errors) === 0) {
        // Voeg merk toe aan de database
        $sth = $db->prepare('INSERT INTO brand (name) VALUES (:brand)'); // Controleer hier of de kolomnaam correct is
        $sth->bindParam(':brand', $inputs['brand']);
        if ($sth->execute()) {
            // Succesfeedback
            echo "<div class='alert alert-success'>Merk succesvol toegevoegd!</div>";
            // Na succesvolle invoer, kan het formulier opnieuw worden ingediend zonder het merk opnieuw te tonen
            header("Location: " . $_SERVER['PHP_SELF']); // Herlaad de pagina
            exit();
        } else {
            // Foutfeedback
            echo "<div class='alert alert-danger'>Er is een fout opgetreden bij het toevoegen van het merk.</div>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schoenmerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<h1>Schoenmerken</h1>

<table class="table">
    <tr>
        <th>Merk</th>
    </tr>
    <?php foreach ($brands as $brand) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($brand['name']) . '</td>'; // Veilig weergeven
        echo '</tr>';
    }
    ?>
</table>
<p>Aantal schoenmerken: <?php echo $brandCount; ?></p> <!-- Aantal merken weergeven -->

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Voeg Schoen merk toe</h3>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="brand" class="form-label">Merk</label>
                                <input type="text" class="form-control" id="brand" name="brand" value="<?php echo htmlspecialchars($inputs['brand'] ?? ''); ?>">
                                <div class="form-text text-danger">
                                    <?= $errors['brand'] ?? '' ?>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" name="send" value="Voeg toe">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
