<!-- php file inladen -->
<?php include "backend-login-register.php"?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<!-- header ophalen -->
<?php require 'header.php'?>

<!-- start login/register container-->
<div class="container mt-5">
    <div class="row">
        <div class="col-12 p-5 text-center">
            <div class="mb-3"></div>
        </div>
    </div>
    <div class="row">
        <!-- Login Form -->
        <div class="col-md-6 d-flex justify-content-center align-items-stretch mb-5 mb-md-0">
            <form method="post" class="border p-4 rounded shadow bg-primary text-light equal-height" style="width: 100%; max-width: 400px;">
                <h4 class="mb-4 text-center">Login</h4>
                <div class="mb-3">
                    <label for="mail" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="mail"
                           value="<?php echo $inputs['email'] ?? '' ?>">
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
                <button type="submit" name="login" class="btn btn-light text-primary w-100">Login</button>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="col-md-6 d-flex justify-content-center align-items-stretch">
            <form method="post" action="" class="border p-4 rounded shadow bg-primary text-light equal-height" style="width: 100%; max-width: 400px;">
                <h4 class="mb-4 text-center">Register</h4>
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                           value="<?php echo $inputs['firstname'] ?? '' ?>">
                    <div class="form-text text-danger">
                        <?= $errors['firstname'] ?? '' ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname"
                           value="<?php echo $inputs['lastname'] ?? '' ?>">
                    <div class="form-text text-danger">
                        <?= $errors['lastname'] ?? '' ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email"
                           value="<?php echo $inputs['email'] ?? '' ?>">
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
                <input type="submit" class="btn btn-light text-primary w-100" name="send" value="Register">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-4"></div>
    </div>
</div>
<!-- end login/register container-->

<!-- footer ophalen -->
<?php require 'footer.php' ?>
</body>
</html>
