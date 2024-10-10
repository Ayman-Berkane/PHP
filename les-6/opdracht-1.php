<?php
if (isset($_POST['submit'])) {
    $bedrag = (float) $_POST['bedrag'];
    $btwPercentage = (int) $_POST['btw_percentage'];

    // Bereken het bedrag inclusief BTW
    $btwBedrag = $bedrag * ($btwPercentage / 100);
    $bedragInclusiefBtw = $bedrag + $btwBedrag;

    // Gebruik number_format om het bedrag netjes weer te geven met 2 decimalen en een euroteken
    echo "<h3>Bedrag inclusief $btwPercentage% BTW: €" . number_format($bedragInclusiefBtw, 2, ',', '.') . "</h3>";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTW Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">BTW Calculator</h2>

    <form method="post" action="" class="border p-4 shadow-sm rounded">
        <div class="mb-3">
            <label for="bedrag" class="form-label">Bedrag exclusief BTW:</label>
            <input type="number" id="bedrag" name="bedrag" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kies BTW percentage:</label><br>
            <div class="form-check">
                <input type="radio" id="btw_9" name="btw_percentage" value="9" class="form-check-input" required>
                <label for="btw_9" class="form-check-label">9% BTW</label>
            </div>
            <div class="form-check">
                <input type="radio" id="btw_21" name="btw_percentage" value="21" class="form-check-input" required>
                <label for="btw_21" class="form-check-label">21% BTW</label>
            </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Uitrekenen</button>
    </form>
</div>


</body>
</html>
