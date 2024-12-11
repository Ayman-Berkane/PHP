<?php
// Start the session at the top of the file
session_start();

// Database connection
try {
    // Make a connection to the database
    $db = new PDO('mysql:host=localhost;dbname=tech-one;charset=utf8', 'root', '');

    // Login Logic
    if (isset($_POST['login'])) {

        // Sanitize input
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if (empty($email)) {
            $errors['email'] = 'E-mail invullen';
        }
        if (empty($password)) {
            $errors['password'] = 'Password invullen';
        }

        // Prepare the query to find the user by email
        $query = $db->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email);

        // Execute the query
        $query->execute();

        // Check if a user with the given email exists
        if ($query->rowCount() == 1) {
            // Get user data
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Verify the password
            if (password_verify($password, $result['password'])) {
                // Debug: Output the password verification success
                echo "Password is correct.<br>";

                // Store user details in session
                $_SESSION['user'] = $result['email'];
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_name'] = $result['first_name'];  // Store first name
                $_SESSION['last_name'] = $result['last_name'];  // Store last name
                $_SESSION['email'] = $result['email'];          // Store email
                $_SESSION['role'] = $result['role'];            // Store role
                $_SESSION['img'] = $result['img'];              // Store profile picture path

                // Debug: Output the role of the user
                echo "User role: " . $result['role'] . "<br>";

                // Redirect based on user role
                if ($result['role'] === 'admin') {
                    echo "Redirecting to admin page...<br>";
                    header("Location: admin.php");  // Redirect to admin page
                } else if ($result['role'] === 'store_employee') {
                    header("Location: employee.php");
                }else {
                    echo "Redirecting to member page...<br>";
                    header("Location: index.php");  // Redirect to member homepage
                }
                exit();
            } else {
                // Debug: Password verification failed
                echo "Password verification failed.<br>";
                $error_message = "Onjuiste gegevens";
            }
        }
    }

    // Registration Logic
    if (isset($_POST['send'])) {
        // Sanitize and validate input
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $errors = [];

        // Validate fields
        if (empty($firstname)) {
            $errors['firstname'] = 'Voornaam invullen';
        }
        if (empty($lastname)) {
            $errors['lastname'] = 'Achternaam invullen';
        }
        if ($email === false) {
            $errors['email'] = 'E-mail invullen';
        }
        if (empty($password)) {
            $errors['password'] = 'Password invullen';
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }

        // If there are no errors, insert the new user into the database
        if (count($errors) === 0) {
            // Prepare the SQL query to insert the new user
            $sth = $db->prepare('INSERT INTO user (email, password, first_name, last_name, role) VALUES (:email, :password, :firstname, :lastname, "member")');
            $sth->bindParam(':firstname', $firstname);
            $sth->bindParam(':lastname', $lastname);
            $sth->bindParam(':email', $email);
            $sth->bindParam(':password', $hashedPassword);

            // Execute the query and check if the insert was successful
            if ($sth->execute()) {
                $_SESSION['success_message'] = "Account succesvol aangemaakt!";
                header("Location: login-register.php");
                exit();
            } else {
                $error_message = "Er is iets misgegaan, probeer het later opnieuw.";
            }
        }
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

?>