<?php
session_start();

try {
    // Maak verbinding met de database
    $db = new PDO('mysql:host=localhost;dbname=tech-one;charset=utf8', 'root', '');

    // Controleer of het formulier is ingediend
    if (isset($_POST['login'])) { // Aangepast van 'submit' naar 'login'
        // Sanitize input
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        // Bereid de query voor om op basis van e-mailadres te zoeken
        $query = $db->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email);

        // Voer de query uit
        $query->execute();

        // Controleer of er een gebruiker met het opgegeven e-mailadres is gevonden
        if ($query->rowCount() == 1) {
            // Haal de gegevens van de gebruiker op
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Controleer of het ingevoerde wachtwoord overeenkomt met het gehashte wachtwoord
            if (password_verify($password, $result['password'])) {
                // Sla een succesbericht op in de sessie
                $_SESSION['success_message'] = "U bent succesvol ingelogd!";

                // Optioneel: sla ook gebruikersinformatie op in de sessie
                $_SESSION['user'] = $result['email'];

                // Redirect naar de homepage
                header("Location: register.php");
                exit(); // Stop verdere uitvoering van het script
            } else {
                echo "Onjuiste gegevens";
            }
        } else {
            echo "De gegevens zijn onjuist";
        }

        echo "<br>";
    }
} catch(PDOException $e) {
    die("Fout! : " . $e->getMessage());
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/homepage.css">
</head>
<body>

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Inloggen</h3>
                        <form method="post">
                            <div class="mb-3">
                                <label for="mail" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="mail"
                                       value="<?php echo $inputs['email'] ?? '' ?>"> <!-- Gebruik email consistent -->
                                <div class="form-text text-danger">
                                    <?= $errors['email'] ?? '' ?> <!-- Gebruik email consistent -->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                                <div class="form-text text-danger">
                                    <?= $errors['password'] ?? '' ?>
                                </div>
                            </div>
                            <button type="submit" name="login" class="btn btn-dark text-white w-100">Login</button> <!-- Zorg dat 'login' consistent is -->
                        </form>
                        <div class="text-center mt-3">
                            <a href="register.php" class="text-decoration-none">Don't have an account? Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
