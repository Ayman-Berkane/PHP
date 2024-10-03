<?php
if (isset($_POST['submit'])) {
    // Sanitize input data to prevent malicious entries
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $postcode = htmlspecialchars($_POST['postcode']);
    $city = htmlspecialchars($_POST['city']);
    $agreed = isset($_POST['agree']);

    echo "Het formulier is verzonden<br>";
    echo "Voornaam: $firstName<br>";
    echo "Achternaam: $lastName<br>";
    echo "Email: $email<br>";
    echo "Adres: $address<br>";
    echo "Postcode: $postcode<br>";
    echo "Woonplaats: $city<br>";
    echo "Akkoord met voorwaarden: " . ($agreed ? 'Ja' : 'Nee') . "<br>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="first_name" class="form-label">Voornaam:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Achternaam:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Adres:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="postcode" class="form-label">Postcode:</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Woonplaats:</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                    <label class="form-check-label" for="agree">Ik ga akkoord met de voorwaarden</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Verzend</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
