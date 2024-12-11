<?php
// Start the session at the very top of the file
session_start();
?>

<!-- PHP-bestand inladen-->
<?php
include 'back-end.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>

    <!-- CSS en lettertype-laden -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS voor styling en responsiviteit -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>

<body>
<div class="header">
    <!-- Container voor de volledige koptekst -->
    <div class="container-fluid">
        <!-- Rij binnen de container om verschillende secties horizontaal uit te lijnen -->
        <div class="row bg-primary bg-opacity-50 p-2 fixed-top">

            <!-- Kolom voor de merknaam "TechOne" -->
            <div class="col-2 d-flex justify-content-start align-items-center">
                <h2 class="text-white">TechOne</h2>
            </div>

            <!-- Kolom voor de navigatiebalk -->
            <div class="col-9">
                <!-- Navigatiebalk container voor navigatie-items en uitbreidbare menu's -->
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <!-- Toggle button for mobile view -->
                        <button class="navbar-toggler ms-auto bg-white text-white" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav d-flex justify-content-around align-items-center w-100">
                                <!-- Other menu items -->
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="index.php">HOME</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="master.php">CATEGORY</a>
                                </li>
                                <div class="dropdown">
                                    <button class="btn nav-item fs-6 mt-2 nav-link text-white" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        PRODUCTS PAGE
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Hardware</a></li>
                                        <li><a class="dropdown-item" href="#">Pre-built</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="contact-page.php">CONTACT
                                        PAGE</a>
                                </li>

                                <!-- Only show the Login/Register link if the user is NOT logged in -->
                                <?php if (!isset($_SESSION['user'])): ?>
                                    <li class="nav-item fs-6 mt-2">
                                        <a class="nav-link text-opacity-100 text-white" href="login-register.php">LOGIN
                                            / REGISTER</a>
                                    </li>
                                <?php endif; ?>

                                <!-- Optionally, show the Logout link if the user is logged in -->
                                <?php if (isset($_SESSION['user'])): ?>
                                    <li class="nav-item fs-6 d-flex flex-column align-items-center">
                                        <!-- Avatar Image on top -->
                                        <img src="<?= htmlspecialchars($_SESSION['img']); ?>"
                                             class="rounded-circle shadow-4"
                                             style="width: 50px; height: 50px;" alt="Avatar"/>
                                        <!-- User's Name Below the Avatar -->
                                        <div class="dropdown">
                                            <button class="btn nav-item fs-6 nav-link text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?= $_SESSION['user_name']; ?>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="nav-link text-opacity-100" href="profile.php">PROFILE</a></li>
                                                <li><a class="nav-link text-dark text-opacity-100" href="orders.php">ORDERS</a></li>
                                                <!-- Check if the user is an admin -->
                                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                                    <li><a class="nav-link text-dark text-opacity-100" href="admin.php">ADMIN
                                                            PRODUCTS</a></li>
                                                    <li><a class="nav-link text-dark text-opacity-100" href="admin.php">ADMIN
                                                            VENDORS</a></li>
                                                <?php endif; ?>
                                                <?php if ($_SESSION['role'] === 'store_employee'): ?>
                                                    <li><a class="nav-link text-dark text-opacity-100" href="employee.php">MANAGE
                                                            PRODUCTS</a></li>
                                                <?php endif; ?>
                                                <li><a class="nav-link text-opacity-100" href="logout.php">LOGOUT</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <?php if (isset($_SESSION['user'])): ?>
            <!-- Kolom voor het winkelmandje-icoon -->
            <div class="col d-flex justify-content-center align-items-center">
                <a href="cart.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                         class="bi bi-bag text-white" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="main">
    <!-- Start van de afbeeldingencarrousel -->
    <div class="container-fluid bg-dark">
        <!-- Rij voor de carrousel met afbeeldingen -->
        <div class="row no-gutters">
            <div class="col-xs-12 p-0 position-relative">
                <div id="carouselExampleDark" class="carousel slide">

                    <!-- Indicatoren voor carrousel dia's -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                    </div>

                    <!-- Inhoud van elke carrousel-dia -->
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="https://i.ytimg.com/vi/x-zSLV2nweU/maxresdefault.jpg" class="d-block w-100"
                                 alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="https://cf-images.us-east-1.prod.boltdns.net/v1/static/734546229001/869bfaca-9962-4ad1-892e-61110c5407c9/2212939c-5b90-4be2-9cee-673c290b8a1a/1920x1080/match/image.jpg"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://i.dell.com/is/image/DellContent/content/dam/ss2/page-specific/category-pages/alienware-desktop-aurora-r16-notebook-m18-800x620-image-v2.png"
                                 class="d-block w-100" alt="...">
                        </div>
                    </div>

                    <!-- Navigatieknoppen voor de carrousel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Teksten en knoppen over de carrousel heen geplaatst -->
                <div class="position-absolute d-flex justify-content-center align-items-center">
                    <div class="cont">
                        <h6 class="typewriter typewriter-delay-1">Today, <?= $currentDate ?></h6>
                        <h6 class="typewriter typewriter-delay-1"><?= $storeStatus ?></h6>

                        <?php if (isset($_SESSION['user'])): ?>
                            <!-- Display only the personalized greeting if the user is logged in -->
                            <h2 class="mt-3">Welcome <?= $_SESSION['user_name']; ?>!</h2>
                        <?php else: ?>
                            <!-- Display the "Get Started" button if the user is not logged in -->
                            <h5 class="typewriter typewriter-delay-1 mt-2">From Components to Complete Solutions</h5>
                            <h2 class="p-2 typewriter typewriter-delay-2 mt-2">
                                Elevate Your Tech Experience with<br>Premium Hardware and Pre-Built Systems
                            </h2>
                            <a type="button" href="login-register.php"
                               class="btn btn-primary bg-opacity-50 text-opacity-100 text-white w-25 p-2 mt-3 rounded-pill">
                                Get Started
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Einde van de afbeeldingencarrousel -->


</body>
</html>
