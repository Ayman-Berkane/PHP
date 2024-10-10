<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achtergrondkleur Instellen</title>
    <!-- Bootstrap CSS voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>

<body
<?php
if (isset($_POST['color'])) {
    $color = $_POST['color'];
    echo "style='background-color: $color;'";
}
?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Kies een achtergrondkleur</h2>

    <form method="post" action="" class="border p-4 shadow-sm rounded">
        <div class="mb-3">
            <label class="form-label">Kies een kleur:</label><br>
            <div class="form-check">
                <input type="radio" id="color_red" name="color" value="red" class="form-check-input"
                    <?php if (isset($color) && $color == 'red') echo 'checked'; ?> required>
                <label for="color_red" class="form-check-label">Rood</label>
            </div>
            <div class="form-check">
                <input type="radio" id="color_green" name="color" value="green" class="form-check-input"
                    <?php if (isset($color) && $color == 'green') echo 'checked'; ?> required>
                <label for="color_green" class="form-check-label">Groen</label>
            </div>
            <div class="form-check">
                <input type="radio" id="color_blue" name="color" value="blue" class="form-check-input"
                    <?php if (isset($color) && $color == 'blue') echo 'checked'; ?> required>
                <label for="color_blue" class="form-check-label">Blauw</label>
            </div>
            <div class="form-check">
                <input type="radio" id="color_pink" name="color" value="pink" class="form-check-input"
                    <?php if (isset($color) && $color == 'pink') echo 'checked'; ?> required>
                <label for="color_pink" class="form-check-label">Roze</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Verzend</button>
    </form>
</div>

</body>
</html>
