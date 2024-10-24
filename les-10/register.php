<?php
$db = new PDO('mysql:host=localhost;dbname=tech-one;charset=utf8', 'root', '');
$query = $db->prepare('SELECT *FROM user');
$query->execute();

include_once 'modules/database.php';
include_once 'modules/function.php';

const FIRSTNAME_REQUIRED = 'Voornaam invullen';
const LASTNAME_REQUIRED = 'Achternaam invullen';
const EMAIL_REQUIRED = 'E-mail invullen';
const PASSWORD_REQUIRED = 'Password invullen';

$errors = [];
$inputs = [];

if (isset($_POST['send'])) {
    //firstname part
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
    $inputs['firstname'] = $firstname;
    $firstname = trim($firstname);
    if (empty($firstname)) {
        $errors['firstname'] = FIRSTNAME_REQUIRED;
    }


    //lastname part
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
    $inputs["lastname"] = $lastname;

    $lastname = trim($lastname);
    if (empty($lastname)) {
        $errors['lastname'] = LASTNAME_REQUIRED;
    }

    //email part
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email === false) {
        $errors['email'] = EMAIL_REQUIRED;
    } else {
        $inputs["email"] = $email;
    }

    //password part
    $password = filter_input(INPUT_POST, 'password');

    if($password ==='') {
        $errors['password'] = PASSWORD_REQUIRED;
    } else {
        $inputs["password"] = password_hash($password, PASSWORD_DEFAULT);
    }


    if (count($errors) === 0) {
        var_dump($inputs);
        var_dump($errors);
        global $db;

        // Correct SQL statement
        $sth = $db->prepare('INSERT INTO user (email, password, first_name, last_name, role) VALUES (:email, :password, :firstname, :lastname, "member")');
        $sth->bindParam(':firstname', $inputs['firstname']);
        $sth->bindParam(':lastname', $inputs['lastname']);
        $sth->bindParam(':email', $inputs['email']);
        $sth->bindParam(':password', $inputs['password']);

        $result = $sth->execute();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/homepage.css">
</head>
<body>

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Register</h3>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Voornaam</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $inputs['firstname'] ?? '' ?>">
                                <div class="form-text text-danger">
                                    <?= $errors['firstname'] ?? '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Achternaam</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $inputs['lastname'] ?? '' ?>">
                                <div class="form-text text-danger">
                                    <?= $errors['lastname'] ?? '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email adres</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $inputs['email'] ?? '' ?>">
                                <div class="form-text text-danger">
                                    <?= $errors['email'] ?? '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                                <div class="form-text text-danger">
                                    <?= $errors['password'] ?? '' ?>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" name="send" value="Registreren">
                        </form>

                        <div class="text-center mt-3">
                            <a href="login.php" class="text-decoration-none">have an account? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>