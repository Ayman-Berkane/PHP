<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db = new PDO('mysql:host=localhost;dbname=tech-one;charset=utf8', 'root', '');

        // Sanitize input
        $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $currentEmail = $_SESSION['email'];

        if (!$email) {
            die("Invalid email format.");
        }

        // Handle file upload
        $profileImagePath = null; // Default to null
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = basename($_FILES['image']['name']);
            $targetFilePath = $uploadDir . uniqid() . "_" . $fileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['image']['type'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    $profileImagePath = $targetFilePath;
                } else {
                    die("Error uploading the file.");
                }
            } else {
                die("Invalid file type. Allowed types are JPEG, PNG, and GIF.");
            }
        }

        // Build update query
        $updateFields = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
        ];

        if (!empty($password)) {
            $updateFields['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($profileImagePath) {
            $updateFields['img'] = $profileImagePath;
        }

        $setClause = [];
        foreach ($updateFields as $field => $value) {
            $setClause[] = "$field = :$field";
        }
        $setClauseString = implode(", ", $setClause);

        $query = $db->prepare("UPDATE user SET $setClauseString WHERE email = :current_email");
        foreach ($updateFields as $field => $value) {
            $query->bindValue(":$field", $value);
        }
        $query->bindValue(":current_email", $currentEmail);

        if ($query->execute()) {
            // Update session variables
            $_SESSION['user_name'] = $firstName;
            $_SESSION['last_name'] = $lastName;
            $_SESSION['email'] = $email;
            if ($profileImagePath) {
                $_SESSION['img'] = $profileImagePath;
            }

            $_SESSION['success_message'] = "Profile updated successfully!";
            header("Location: profile.php");
            exit();
        } else {
            echo "Failed to update profile.";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Page</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>

<body>

<?php require 'header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-12 mt-5"></div>
        <div class="col-12 mt-5"></div>
    </div>
</div>

<?php if (isset($_SESSION['user'])): ?>
    <div class="container rounded bg-white">
        <div class="row">
            <div class="col-12 mt-5"></div>
        </div>
        <div class="row">
            <!-- Profile Sidebar -->
            <div class="col-md-3 border-right bg-primary">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-end rounded-start mt-5" height="200px" width="200px"
                         src="<?= htmlspecialchars($_SESSION['img']); ?>">
                    <span class="font-weight-bold text-white mt-3"><?= $_SESSION['user_name']; ?></span>
                    <span class="text-white-50 mt-3"><?= htmlspecialchars($_SESSION['role']); ?></span>
                </div>
            </div>

            <!-- Profile Settings -->
            <div class="col-md-9 border-right bg-primary">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right text-white">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels text-white">First Name</label>
                                <input type="text" class="form-control" name="first_name" placeholder="First name" value="<?= htmlspecialchars($_SESSION['user_name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labels text-white">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Surname" value="<?= htmlspecialchars($_SESSION['last_name']); ?>" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels text-white">E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?= htmlspecialchars($_SESSION['email']); ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <label for="image" class="form-label text-white">Profile picture</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels text-white">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter new password">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-light text-primary profile-button" type="submit">Save Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php else: ?>
    <h2>Sign in!</h2>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-12 mt-5"></div>
        <div class="col-12 mt-5"></div>
    </div>
</div>

<?php require 'footer.php' ?>
</body>

</html>
