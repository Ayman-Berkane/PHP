<?php
// Database connection
try {
    // Make a connection to the database
    $db = new PDO('mysql:host=localhost;dbname=tech-one;charset=utf8', 'root', '');

    // Admin's email (Make sure this matches the email used for admin)
    $adminEmail = 'member@techone.com';

    // The admin password to hash
    $adminPassword = 'qwerty';

    // Hash the password
    $hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

    // Prepare the update query
    $query = $db->prepare("UPDATE user SET password = :password WHERE email = :email");
    $query->bindParam(':password', $hashedPassword);
    $query->bindParam(':email', $adminEmail);

    // Execute the query to update the password
    if ($query->execute()) {
        echo "Password updated successfully.";
    } else {
        echo "Error updating password.";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
