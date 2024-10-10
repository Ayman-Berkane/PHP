<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korting Berekenen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Korting Berekenen</h2>

    <form method="post" action="" class="border p-4 shadow-sm rounded">
        <div class="mb-3">
            <label for="bedrag" class="form-label">Bedrag (€):</label>
            <input type="number" id="bedrag" name="bedrag" class="form-control" step="0.01" placeholder="Vul een bedrag in" required>
        </div>

        <div class="mb-3">
            <label for="korting" class="form-label">Korting (%):</label>
            <input type="number" id="korting" name="korting" class="form-control" step="0.01" placeholder="Vul een kortingspercentage in" required>
        </div>

        <button type="submit" name="bereken" class="btn btn-primary w-100">Uitrekenen</button>
    </form>
    <?php

    if (isset($_POST['bereken'])) {

        $amount = (float) $_POST['bedrag'];
        $discount = (float) $_POST['korting'];

        $discountAmount = ($discount / 100) * $amount;

        $amountWithDiscount = $discount - $discountAmount;

        echo "<div class='alert alert-success mt-4' role='alert'>";
        echo "<h4 class='alert-heading'>Resultaat</h4>";
        echo "<p>Het bedrag na " . number_format($discount, 2) . "% korting is: €" . number_format($amountWithDiscount, 2) . "</p>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
