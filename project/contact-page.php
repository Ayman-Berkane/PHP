<?php
// Establish a connection to the database
$db = new PDO('mysql:host=localhost;dbname=tech-one;charset=utf8', 'root', '');
// Prepare a query to select all records from the contact table
$query = $db->prepare('SELECT * FROM contact');
$query->execute();

// Include external files for database functions and utility functions
include_once 'modules/database.php';
include_once 'modules/function.php';

// Define constants for error messages
const NAME_REQUIRED = 'Please enter your name';
const EMAIL_REQUIRED = 'Please enter your email';
const SUBJECT_REQUIRED = 'Please enter a subject';
const MESSAGE_REQUIRED = 'Please enter your message';

// Initialize arrays to store errors and user inputs
$errors = [];
$inputs = [];

// Check if the form is submitted
if (isset($_POST['send'])) {
    // Validate and sanitize the name input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $inputs['name'] = $name;
    $name = trim($name);
    if (empty($name)) {
        $errors['name'] = NAME_REQUIRED;
    }

    // Validate and sanitize the email input
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($email === false) {
        $errors['email'] = EMAIL_REQUIRED;
    } else {
        $inputs['email'] = $email;
    }

    // Validate and sanitize the subject input
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty(trim($subject))) {
        $errors['subject'] = SUBJECT_REQUIRED;
    } else {
        $inputs['subject'] = $subject;
    }

    // Validate and sanitize the message input
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty(trim($message))) {
        $errors['message'] = MESSAGE_REQUIRED;
    } else {
        $inputs['message'] = $message;
    }

    // If no errors are found, insert the data into the database
    if (count($errors) === 0) {
        $sth = $db->prepare('INSERT INTO contact (name, email, subject, message) VALUES (:name, :email, :subject, :message)');
        $sth->bindParam(':name', $inputs['name']);
        $sth->bindParam(':email', $inputs['email']);
        $sth->bindParam(':subject', $inputs['subject']);
        $sth->bindParam(':message', $inputs['message']);

        // Execute the prepared statement
        $result = $sth->execute();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact page</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <style>
        /*   section styling    */
        .section {
            position: relative;
            padding-bottom: 0.5rem;
            text-decoration: none;
            color: #0d6efd; /* Primary color for the text */
        }
        /* section styling after*/
        .section::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%; /* Full width by default */
            height: 2px;
            background-color: #0d6efd; /* Primary color for the underline */
            transition: width 0.3s ease; /* This can be kept or removed */
        }
    </style>
</head>

<body>

<!-- header ophalen -->
<?php require 'header.php' ?>

<div class="main">
    <!-- Begin contactsectie -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-5"></div> <!-- Ruimte bovenaan -->
        </div>
        <div class="row mt-2">
            <div class="col-md-12 p-4 d-flex justify-content-center align-items-center fs-3">
                <a class="section p-3">Contact pagina</a> <!-- Titel van de contactpagina -->
            </div>
        </div>
        <div class="row bg-primary p-3 rounded-start rounded-end"> <!-- Achtergrondkleur en opmaak voor de sectie -->
            <div class="col-6 mt-2">
                <!-- Inbedden van Google Maps -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9826.582411490077!2d4.325177147380541!3d51.9951127877131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5b44da6447e33%3A0x14cba2b592fbdf15!2s2635%20DJ%20Den%20Hoorn!5e0!3m2!1sen!2snl!4v1726056179443!5m2!1sen!2snl"
                        class="rounded-end rounded-start" width="600" height="450" style="border:0;"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe> <!-- Kaart van de locatie -->
            </div>
            <div class="col-6 p-0">
                <div class="title-box-2">
                    <h5 class="text-center text-white mb-4">
                        Stuur mij een bericht! <!-- Titel voor het formulier -->
                    </h5>
                </div>
                <div>
                    <form method="post" class="">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                           id="name" placeholder="Je naam" value="<?= $_SESSION['user_name']; ?>">
                                    <?php if (isset($errors['name'])): ?>
                                        <div class="text-danger"><?= htmlspecialchars($errors['name']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email"
                                           id="email" placeholder="Je e-mailadres" value="<?= htmlspecialchars($inputs['email'] ?? '') ?>">
                                    <?php if (isset($errors['email'])): ?>
                                        <div class="text-danger"><?= htmlspecialchars($errors['email']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject"
                                           id="subject" placeholder="Onderwerp" value="<?= htmlspecialchars($inputs['subject'] ?? '') ?>">
                                    <?php if (isset($errors['subject'])): ?>
                                        <div class="text-danger"><?= htmlspecialchars($errors['subject']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5"
                                              placeholder="Bericht"><?= htmlspecialchars($inputs['message'] ?? '') ?></textarea>
                                    <?php if (isset($errors['message'])): ?>
                                        <div class="text-danger"><?= htmlspecialchars($errors['message']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12 text-center mt-5">
                                <button type="submit" name="send" class="btn btn-light text-primary">Verstuur bericht</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-3"></div> <!-- Ruimte onderaan -->
    <!-- Einde contactsectie -->
</div>

<!-- footer ophalen -->
<?php require 'footer.php' ?>

</body>
</html>