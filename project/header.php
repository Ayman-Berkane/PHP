<?php
// Start the session at the very top of the file
session_start();
?>


<style>
    /* Start van de navigatie stijlen */
    .nav-link {
        position: relative;
        padding-bottom: 0.5rem;
        text-decoration: none;
        color: #ffffff;
    }

    /* Onderstrepingseffect voor navigatielinks */
    .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: #ffffff;
        transition: width 0.3s ease;
    }

    /* Effect bij hoveren over navigatielinks */
    .nav-link:hover::after {
        width: 100%;
    }
</style>

<div class="header">
    <!-- Container for the full header -->
    <div class="container-fluid">
        <!-- Row inside the container to align sections horizontally -->
        <div class="row bg-primary p-2 fixed-top">

            <!-- Column for the brand name "TechOne" -->
            <div class="col-2 d-flex justify-content-start align-items-center">
                <h2 class="text-white">TechOne</h2>
            </div>

            <!-- Column for the navigation bar -->
            <div class="col-9">
                <!-- Navigation bar container for navigation items and expandable menus -->
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <!-- Toggle button for mobile navigation -->
                        <button class="navbar-toggler ms-auto bg-white text-white" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Collapsible menu options -->
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav d-flex justify-content-around align-items-center w-100">
                                <!-- Menu options in the navigation bar -->
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="index.php">HOME</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="master.php">CATEGORY</a>
                                </li>

                                <!-- Dropdown menu for "PRODUCTS PAGE" -->
                                <div class="dropdown">
                                    <button class="btn nav-item fs-6 mt-2 nav-link text-white" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        PRODUCTS PAGE
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="products-page.php">Hardware</a></li>
                                        <li><a class="dropdown-item" href="products-page-pre.php">Pre-built</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>

                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="contact-page.php">CONTACT
                                        PAGE</a>
                                </li>

                                <?php if (isset($_SESSION['user'])): ?>
                                    <li class="nav-item fs-6 d-flex flex-column align-items-center">
                                        <!-- Avatar Image on top -->
                                        <img src="<?= htmlspecialchars($_SESSION['img']); ?>"
                                             class="rounded-circle shadow-4"
                                             style="width: 50px; height: 50px;" alt="Avatar"/>
                                        <!-- User's Name Below the Avatar -->
                                        <div class="dropdown">
                                            <button class="btn nav-item fs-6 nav-link text-white" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <?= $_SESSION['user_name']; ?>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="nav-link text-dark text-opacity-100" href="profile.php">PROFILE</a>
                                                <li><a class="nav-link text-dark text-opacity-100" href="orders.php">ORDERS</a></li>
                                                </li>
                                                <!-- Check if the user is an admin -->
                                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                                    <li><a class="nav-link text-dark text-opacity-100" href="admin.php">ADMIN
                                                            PRODUCTS</a></li>
                                                    <li><a class="nav-link text-dark text-opacity-100" href="admin-vendor.php">ADMIN
                                                            VENDORS</a></li>
                                                <?php endif; ?>
                                                <?php if ($_SESSION['role'] === 'store_employee'): ?>
                                                    <li><a class="nav-link text-dark text-opacity-100" href="employee.php">MANAGE
                                                            PRODUCTS</a></li>
                                                <?php endif; ?>
                                                <li><a class="nav-link text-dark text-opacity-100" href="logout.php">LOGOUT</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php else: ?>
                                    <!-- Display login/register link if the user is not logged in -->
                                    <li class="nav-item fs-6 mt-2">
                                        <a class="nav-link text-opacity-100 text-white" href="login-register.php">LOGIN
                                            / REGISTER</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <?php if (isset($_SESSION['user'])): ?>
                <!-- Column for the shopping cart icon -->
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

