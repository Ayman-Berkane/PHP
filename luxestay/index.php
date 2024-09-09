<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LuxeStay</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <style>

    </style>
</head>
<body>

<div class="header">
    <div class="container-fluid">
        <div class="row bg-dark bg-opacity-50 p-4 fixed-top">
            <div class="col-2 d-flex justify-content-start align-items-center">
                <h2 class="text-white">LuxeStay</h2>
            </div>
            <div class="col-9">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button class="navbar-toggler ms-auto bg-white" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav d-flex justify-content-around align-items-center w-100">
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" aria-current="page"
                                       href="#">HOME</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="#rooms">ROOMS</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="#location">LOCATION</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="#">ACTIVITIES</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="#">RESTAURANT</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="#">GALLERY</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="#">BLOG</a>
                                </li>
                                <li class="nav-item fs-6 mt-2">
                                    <a class="nav-link text-opacity-100 text-white" href="#">CONTACT</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="main">
    <!-- start-carousel -->
    <div class="container-fluid bg-dark">
        <div class="row no-gutters">
            <div class="col-xs-12 p-0 position-relative">
                <div id="carouselExampleDark" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="https://www.welcome-hotels.com/site/assets/files/84580/welcome_hotel_darmstadt_musterziimmer_1.2560x1600.jpg"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="https://www.primalstrength.com/cdn/shop/files/gymdesign_render_Two_collumn_grid_cb1b5850-fa8e-4a7b-a2b3-190c2e45facd.jpg?v=1680719688&width=1500"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://static11.com-hotel.com/uploads/hotel/304387/photo/hotel-sb-bcn-events-4-sup_15805635281.jpg"
                                 class="d-block w-100" alt="...">
                        </div>
                    </div>
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
                <div class="position-absolute d-flex justify-content-center align-items-center">
                    <div class="cont">
                        <h5 class="text-opacity-100 typewriter">Discover Your Perfect Escape</h5>
                        <h2 class="p-2 text-opacity-100 typewriter mt-2">Experience Unmatched Comfort and Elegance<br>in
                            the
                            Heart of Luxury</h2>
                        <div class="card-body d-flex justify-content-center pr-3 mt-2">
                            <button type="button" class="btn btn-dark text-white w-25 p-3 rounded-pill">Get Started
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end-carousel -->

    <!--  start-section-Rooms  -->
    <div class="container " id="rooms">
        <div class="row mt-2">
            <div class="col-12 p-4 d-flex justify-content-center align-items-center fs-3">
                <a class="section p-3" href="#">ROOMS</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <h2>Ivory Suite</h2>
                <img src="https://cdn.prod.website-files.com/5c6d6c45eaa55f57c6367749/65045f093c166fdddb4a94a5_x-65045f0266217.webp"
                     class="img-fluid w-100 h-100" alt="">
            </div>
            <div class="col-6">
                <ul class="list-group list-group-flush mt-5 rounded-start rounded-end">
                    <li class="list-group-item bg-dark text-white p-3">Design: Crisp, minimalist design with soft white
                        walls and light wood accents.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Lighting: Natural light floods through large
                        windows, complemented by soft, warm LED lighting.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Furniture: Scandinavian-inspired furniture in
                        pale wood and cream-colored upholstery.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Features: Floor-to-ceiling sheer curtains that
                        diffuse sunlight gently across the room.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Bathroom: Spa-like en-suite bathroom with white
                        marble finishes and a glass-enclosed rain shower.
                    </li>
                </ul>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <ul class="list-group list-group-flush mt-5 rounded-start rounded-end">
                    <li class="list-group-item bg-dark text-white p-3">Design: Industrial-inspired loft with exposed
                        black brick walls and sleek metal fixtures.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Lighting: Pendant lights with exposed bulbs,
                        creating a moody atmosphere.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Furniture: Black leather sofa, reclaimed wood
                        coffee table, and minimalist bed frame.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Features: Open-concept layout with a separate
                        lounge area and large workspace.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Bathroom: Luxe bathroom with a freestanding
                        bathtub, matte black finishes, and a rainfall shower.
                    </li>
                </ul>
            </div>
            <div class="col-6">
                <h2>Obsidian Loft</h2>
                <img src="https://static.vecteezy.com/system/resources/thumbnails/034/861/172/original/3d-interior-of-dark-bedroom-black-walls-luxury-room-apartment-hotel-idea-for-design-large-bed-and-plants-panoramic-windows-with-city-view-video.jpg"
                     class="img-fluid w-100 h-100" alt="">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <h2>Noir Deluxe Room</h2>
                <img src="https://img.pikbest.com/wp/202346/luxury-hotel-bedroom-decor-modern-black-suite-in-a-and-resort-rendered-3d_9622423.jpg!sw800"
                     class="img-fluid w-100" alt="">
            </div>
            <div class="col-6">
                <ul class="list-group list-group-flush mt-5 rounded-start rounded-end">
                    <li class="list-group-item bg-dark text-white p-3">Design: Deep, moody tones with textured black
                        wallpaper and dark wood flooring.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Lighting: Adjustable dim lights with a warm glow
                        to enhance the cozy ambiance.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Furniture: Plush, dark grey velvet armchairs and
                        a king-sized bed with a black headboard.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Features: A large, wall-mounted flat-screen TV
                        with a hidden sound system.
                    </li>
                    <li class="list-group-item bg-dark text-white p-3">Bathroom: Elegant bathroom with black granite
                        countertops and a deep soaking tub.
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--  end-section-Rooms  -->

    <!--  start-section-Location  -->
    <div class="container" id="location">
        <div class="row mt-2">
            <div class="col-12 p-4 d-flex justify-content-center align-items-center fs-3">
                <a class="section p-3" href="#">LOCATION</a>
            </div>
        </div>
    </div>
    <!--  end-section-Location   -->
</div>


</body>
</html>
