<?php
if (isset($_POST['submit'])) {
    $number1 = (float) $_POST['getal1'];
    $number2 = (float) $_POST['getal2'];
    $operation = $_POST['operation'];
    $resultaat = "";

    switch ($operation) {
        case "optellen":
            $result = $number1 + $number2;
            break;
        case "aftrekken":
            $result = $number1 - $number2;
            break;
        case "vermenigvuldigen":
            $result = $number1 * $number2;
            break;
        case "delen":
                $result = $number1 / $number2;
            break;
        default:
            $result = "Ongeldige uitwerking.";
    }

    // Toon het resultaat
    if (is_numeric($result)) {
        echo "<div class='alert alert-success mt-4' role='alert'>";
        echo "<h4 class='alert-heading'>Resultaat</h4>";
        echo "<p>De uitkomst is: " . number_format($result, 2) . "</p>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-danger mt-4' role='alert'>";
        echo "<p>$result</p>";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekenmachine</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Rekenmachine</h2>

    <form method="post" action="" class="border p-4 shadow-sm rounded">
        <div class="mb-3">
            <label for="getal1" class="form-label">Getal 1:</label>
            <input type="number" id="getal1" name="getal1" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="getal2" class="form-label">Getal 2:</label>
            <input type="number" id="getal2" name="getal2" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kies een uitwerking:</label><br>
            <div class="form-check">
                <input type="radio" id="optellen" name="operation" value="optellen" class="form-check-input" required>
                <label for="optellen" class="form-check-label">Optellen (+)</label>
            </div>
            <div class="form-check">
                <input type="radio" id="aftrekken" name="operation" value="aftrekken" class="form-check-input" required>
                <label for="aftrekken" class="form-check-label">Aftrekken (-)</label>
            </div>
            <div class="form-check">
                <input type="radio" id="vermenigvuldigen" name="operation" value="vermenigvuldigen" class="form-check-input" required>
                <label for="vermenigvuldigen" class="form-check-label">Vermenigvuldigen (×)</label>
            </div>
            <div class="form-check">
                <input type="radio" id="delen" name="operation" value="delen" class="form-check-input" required>
                <label for="delen" class="form-check-label">Delen (÷)</label>
            </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Berekenen</button>
    </form>
</div>
</body>
</html>
