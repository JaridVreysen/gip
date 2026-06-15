<?php
session_start();
include './includes/dbh.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("partials/title-meta.php"); ?>

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/tiny-slider/tiny-slider.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/glightbox/css/glightbox.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <?php include("includes/header.php"); ?>

    <?php include("partials/head-css.php"); ?>
    <?php include("partials/navbar.php"); ?>
</head>

<body>



    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
Main Banner START -->
        <section class="bg-light">
            <div class="container pt-5 mt-0 mt-lg-5">

                <!-- Title and SVG START -->
                <div class="row position-relative mb-0 mb-sm-5 pb-0 pb-lg-5">
                    <div class="col-lg-8 text-center mx-auto position-relative">

                        <!-- SVG decoration -->
                        <figure
                            class="position-absolute top-100 start-50 translate-middle mt-4 ms-n9 pe-5 d-none d-lg-block">
                            <svg>
                                <path class="fill-success"
                                    d="m181.6 6.7c-0.1 0-0.2-0.1-0.3 0-2.5-0.3-4.9-1-7.3-1.4-2.7-0.4-5.5-0.7-8.2-0.8-1.4-0.1-2.8-0.1-4.1-0.1-0.5 0-0.9-0.1-1.4-0.2-0.9-0.3-1.9-0.1-2.8-0.1-5.4 0.2-10.8 0.6-16.1 1.4-2.7 0.3-5.3 0.8-7.9 1.3-0.6 0.1-1.1 0.3-1.8 0.3-0.4 0-0.7-0.1-1.1-0.1-1.5 0-3 0.7-4.3 1.2-3 1-6 2.4-8.8 3.9-2.1 1.1-4 2.4-5.9 3.9-1 0.7-1.8 1.5-2.7 2.2-0.5 0.4-1.1 0.5-1.5 0.9s-0.7 0.8-1.1 1.2c-1 1-1.9 2-2.9 2.9-0.4 0.3-0.8 0.5-1.2 0.5-1.3-0.1-2.7-0.4-3.9-0.6-0.7-0.1-1.2 0-1.8 0-3.1 0-6.4-0.1-9.5 0.4-1.7 0.3-3.4 0.5-5.1 0.7-5.3 0.7-10.7 1.4-15.8 3.1-4.6 1.6-8.9 3.8-13.1 6.3-2.1 1.2-4.2 2.5-6.2 3.9-0.9 0.6-1.7 0.9-2.6 1.2s-1.7 1-2.5 1.6c-1.5 1.1-3 2.1-4.6 3.2-1.2 0.9-2.7 1.7-3.9 2.7-1 0.8-2.2 1.5-3.2 2.2-1.1 0.7-2.2 1.5-3.3 2.3-0.8 0.5-1.7 0.9-2.5 1.5-0.9 0.8-1.9 1.5-2.9 2.2 0.1-0.6 0.3-1.2 0.4-1.9 0.3-1.7 0.2-3.6 0-5.3-0.1-0.9-0.3-1.7-0.8-2.4s-1.5-1.1-2.3-0.8c-0.2 0-0.3 0.1-0.4 0.3s-0.1 0.4-0.1 0.6c0.3 3.6 0.2 7.2-0.7 10.7-0.5 2.2-1.5 4.5-2.7 6.4-0.6 0.9-1.4 1.7-2 2.6s-1.5 1.6-2.3 2.3c-0.2 0.2-0.5 0.4-0.6 0.7s0 0.7 0.1 1.1c0.2 0.8 0.6 1.6 1.3 1.8 0.5 0.1 0.9-0.1 1.3-0.3 0.9-0.4 1.8-0.8 2.7-1.2 0.4-0.2 0.7-0.3 1.1-0.6 1.8-1 3.8-1.7 5.8-2.3 4.3-1.1 9-1.1 13.3 0.1 0.2 0.1 0.4 0.1 0.6 0.1 0.7-0.1 0.9-1 0.6-1.6-0.4-0.6-1-0.9-1.7-1.2-2.5-1.1-4.9-2.1-7.5-2.7-0.6-0.2-1.3-0.3-2-0.4-0.3-0.1-0.5 0-0.8-0.1s-0.9 0-1.1-0.1-0.3 0-0.3-0.2c0-0.4 0.7-0.7 1-0.8 0.5-0.3 1-0.7 1.5-1l5.4-3.6c0.4-0.2 0.6-0.6 1-0.9 1.2-0.9 2.8-1.3 4-2.2 0.4-0.3 0.9-0.6 1.3-0.9l2.7-1.8c1-0.6 2.2-1.2 3.2-1.8 0.9-0.5 1.9-0.8 2.7-1.6 0.9-0.8 2.2-1.4 3.2-2 1.2-0.7 2.3-1.4 3.5-2.1 4.1-2.5 8.2-4.9 12.7-6.6 5.2-1.9 10.6-3.4 16.2-4 5.4-0.6 10.8-0.3 16.2-0.5h0.5c1.4-0.1 2.3-0.1 1.7 1.7-1.4 4.5 1.3 7.5 4.3 10 3.4 2.9 7 5.7 11.3 7.1 4.8 1.6 9.6 3.8 14.9 2.7 3-0.6 6.5-4 6.8-6.4 0.2-1.7 0.1-3.3-0.3-4.9-0.4-1.4-1-3-2.2-3.9-0.9-0.6-1.6-1.6-2.4-2.4-0.9-0.8-1.9-1.7-2.9-2.3-2.1-1.4-4.2-2.6-6.5-3.5-3.2-1.3-6.6-2.2-10-3-0.8-0.2-1.6-0.4-2.5-0.5-0.2 0-1.3-0.1-1.3-0.3-0.1-0.2 0.3-0.4 0.5-0.6 0.9-0.8 1.8-1.5 2.7-2.2 1.9-1.4 3.8-2.8 5.8-3.9 2.1-1.2 4.3-2.3 6.6-3.2 1.2-0.4 2.3-0.8 3.6-1 0.6-0.2 1.2-0.2 1.8-0.4 0.4-0.1 0.7-0.3 1.1-0.5 1.2-0.5 2.7-0.5 3.9-0.8 1.3-0.2 2.7-0.4 4.1-0.7 2.7-0.4 5.5-0.8 8.2-1.1 3.3-0.4 6.7-0.7 10-1 7.7-0.6 15.3-0.3 23 1.3 4.2 0.9 8.3 1.9 12.3 3.6 1.2 0.5 2.3 1.1 3.5 1.5 0.7 0.2 1.3 0.7 1.8 1.1 0.7 0.6 1.5 1.1 2.3 1.7 0.2 0.2 0.6 0.3 0.8 0.2 0.1-0.1 0.1-0.2 0.2-0.4 0.1-0.9-0.2-1.7-0.7-2.4-0.4-0.6-1-1.4-1.6-1.9-0.8-0.7-2-1.1-2.9-1.6-1-0.5-2-0.9-3.1-1.3-2.5-1.1-5.2-2-7.8-2.8-1-0.8-2.4-1.2-3.7-1.4zm-64.4 25.8c4.7 1.3 10.3 3.3 14.6 7.9 0.9 1 2.4 1.8 1.8 3.5-0.6 1.6-2.2 1.5-3.6 1.7-4.9 0.8-9.4-1.2-13.6-2.9-4.5-1.7-8.8-4.3-11.9-8.3-0.5-0.6-1-1.4-1.1-2.2 0-0.3 0-0.6-0.1-0.9s-0.2-0.6 0.1-0.9c0.2-0.2 0.5-0.2 0.8-0.2 2.3-0.1 4.7 0 7.1 0.4 0.9 0.1 1.6 0.6 2.5 0.8 1.1 0.4 2.3 0.8 3.4 1.1z">
                                </path>
                            </svg>
                        </figure>
                        <!-- SVG decoration -->
                        <figure class="position-absolute top-0 start-0 ms-n9">
                            <svg width="22px" height="22px" viewBox="0 0 22 22">
                                <polygon class="fill-orange"
                                    points="22,8.3 13.7,8.3 13.7,0 8.3,0 8.3,8.3 0,8.3 0,13.7 8.3,13.7 8.3,22 13.7,22 13.7,13.7 22,13.7 ">
                                </polygon>
                            </svg>
                        </figure>
                        <!-- SVG decoration -->
                        <figure class="position-absolute top-100 start-100 translate-middle ms-5 d-none d-lg-block">
                            <svg width="21.5px" height="21.5px" viewBox="0 0 21.5 21.5">
                                <polygon class="fill-danger"
                                    points="21.5,14.3 14.4,9.9 18.9,2.8 14.3,0 9.9,7.1 2.8,2.6 0,7.2 7.1,11.6 2.6,18.7 7.2,21.5 11.6,14.4 18.7,18.9 ">
                                </polygon>
                            </svg>
                        </figure>
                        <!-- SVG decoration -->
                        <figure class="position-absolute top-0 start-100 translate-middle d-none d-md-block">
                            <svg width="27px" height="27px">
                                <path class="fill-purple"
                                    d="M13.122,5.946 L17.679,-0.001 L17.404,7.528 L24.661,5.946 L19.683,11.533 L26.244,15.056 L18.891,16.089 L21.686,23.068 L15.400,19.062 L13.122,26.232 L10.843,19.062 L4.557,23.068 L7.352,16.089 L-0.000,15.056 L6.561,11.533 L1.582,5.946 L8.839,7.528 L8.565,-0.001 L13.122,5.946 Z">
                                </path>
                            </svg>
                        </figure>

                        <!-- Title -->
                        <?php
                        if (isset($_SESSION['id'])) {
                            $userId = $_SESSION['id'];

                            $sql = "SELECT `id`, `firstname` FROM `user` WHERE id = ?";
                            $statement = $conn->prepare($sql);
                            $statement->bind_param("i", $userId);
                            $statement->execute();
                            $result = $statement->get_result();

                            if ($row = $result->fetch_assoc()) {
                                $currentUserId = $row['id'];
                                $firstname = $row['firstname'];
                                echo "<h1>Welcome " . $firstname . "<h1>";
                            } else {
                                echo "<h1>Welcome to Provil Sportslab<h1>";
                            }
                        } else {
                            echo "<h1>Welcome to Provil Sportslab<h1>";
                        };


                        ?>


                        <!-- Search course -->
                        <div class="col-md-8 text-center mx-auto pb-5">
                            <form class="bg-body shadow rounded p-2">
                                <div class="input-group">
                                    <input class="form-control border-0 me-1" type="search"
                                        placeholder="Find your course">
                                    <button type="button" class="btn btn-primary mb-0 rounded z-index-1"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Title and SVG END -->
            </div>
        </section>
        <!-- =======================
Main Banner END -->

        <!-- =======================
Sporters Image START -->
        <section class="pb-0 py-sm-0 mt-n8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 text-center mx-auto">
                        <div class="card card-body shadow p-2">
                            <img src="sporters.jpeg" class="card-img rounded-2" alt="Sporters" style="object-fit:cover; max-height:400px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sporters Image END -->

        <!-- =======================
Category START -->
        <section>
            <div class="container">
                <div class="row g-4">
                    <?php
                    $sql = "SELECT `id`, `name`, `icon`, `landingspage`, `color` FROM `label` LIMIT 8";
                    $statement = $conn->prepare($sql);
                    // $statement->bind_param('s', $user);
                    $statement->execute();
                    $result = $statement->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $icon = $row['icon'];
                        $color = $row['color'];

                        $sql2 = "SELECT COUNT(*) AS total FROM `course`";
                        $statement2 = $conn->prepare($sql2);
                        $statement2->execute();
                        $result2 = $statement2->get_result();
                        $row2 = $result2->fetch_assoc();


                        echo ' <!-- Category item -->
			<div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card card-body shadow rounded-3">
                    <div class="d-flex align-items-center">
                        <!-- Icon -->
                        <div class="icon-lg bg-' . $color . ' bg-opacity-10 rounded-circle text-' . $color . '">' . $icon . '<i></i></div>
                            <div class="ms-3">
                                <h5 class="mb-0"><a href="#" class="stretched-link">' . $name . ' </a></h5>
                                <span>'. $row2['total'] .' Courses</span>
                            </div>
                        </div>
                	</div>
                </div>';
                    };

                    ?>
                </div>
            </div>
            </div>
        </section>;

        <!-- =======================
Category END -->

        <!-- =======================
Featured course START -->
        <section class="pt-0 pt-md-5">
            <div class="container">
                <!-- Title -->
                <div class="row mb-4">
                    <div class="col-lg-8 text-center mx-auto">
                        <h2 class="fs-1 mb-0">Featured Courses</h2>
                        <p class="mb-0">Explore top picks of the week </p>
                    </div>
                </div>

                <div class="row g-4">


                    <?php
                    $sql =  "SELECT c.id, c.name, c.courseImage, c.introduction, c.time, c.pages, c.path as cpath, o.name as organisationname, u.path
                    FROM `course` c 
                    INNER JOIN `organisation` o ON o.id = c.organisationId
                    INNER JOIN `user` u ON u.id = c.authorId
                    WHERE 1 LIMIT 8";
                    $statement = $conn->prepare($sql);
                    // $statement->bind_param('s', $user);
                    $statement->execute();
                    $result = $statement->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $image = $row['cpath'];
                        $introduction = $row['introduction'];
                        $organisation = $row['organisationname'];
                        $profilePicture = $row['path'];




                        echo '<!-- Card Item START -->
                    <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="card p-2 shadow h-100"><div class="rounded-top overflow-hidden">
                                <div class="card-overlay-hover">
                                    <!-- Image -->
                                    <img style="max-height: 145px;" src="./media/' . $image . '" class="card-img-top"
                                        alt="course image">
                                </div>
                                <!-- Hover element -->
                                <div class="card-img-overlay">
                                    <div class="card-element-hover d-flex justify-content-end">
                                        <a href="#" class="icon-md bg-white rounded-circle">
                                            <i class="fas fa-shopping-cart text-danger"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card body -->
                            <div class="card-body px-2">
                                <!-- Title -->
                                <div class="d-flex justify-content-between">
                                    <h5	 class="card-title mt-2"><a href="#">' . $name . '</a></h5>
                                    <!-- Avatar -->
                                    <div class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle" src="./media/' . $profilePicture . '"
                                            alt="avatar">
                                    </div>
                                </div>
                                <!-- Divider -->
                                <hr>
                                <!-- description -->
                                <h6 class="card-title"><a href="#">' . $introduction . '</a></h6>
                                <!-- Badge and Price -->
                                <div class="d-flex justify-content-between align-items-center mb-0">
                                    <div><a href="#" class="badge bg-info bg-opacity-10 text-info me-2"><i
                                        class="fas fa-circle small fw-bold"></i> ' . $organisation . '</a></div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- Card Item END -->';
                    };
                    ?>
                </div>
                <!-- Button -->
                <div class="text-center mt-5">
                    <a href="course-grid-2.php" class="btn btn-primary-soft">View more<i
                            class="fas fa-sync ms-2"></i></a>
                </div>
            </div>
        </section>
        <!-- =======================
Featured course END -->

        <!-- =======================
Action box START -->

        <!-- =======================
Action box END -->

        <!-- =======================
IT courses START -->

        <!-- =======================
IT courses END -->

        <!-- =======================
Live courses START -->

        <!-- =======================
Live courses END -->

        <!-- =======================
Action box START -->

        <!-- =======================
Action box END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- =======================
Footer START -->
    <footer class="bg-light pt-5">
        <div class="container">
            <!-- Row START -->
            <div class="row g-4">

                <!-- Widget 1 START -->
                <div class="col-lg-3">
                    <!-- logo -->
                    <a class="me-0" href="index.php">
                        <img class="light-mode-item h-60px" src="./logo.png" alt="logo">
                        <img class="dark-mode-item h-60px" src="./logo.png" alt="logo">
                    </a>
                    <p class="my-3">Eduport education theme, built specifically for the education centers which is
                        dedicated to teaching and involve learners. </p>
                    <!-- Social media icon -->
                    <ul class="list-inline mb-0 mt-3">
                        <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-facebook"
                                href="#"><i class="fab fa-fw fa-facebook-f"></i></a> </li>
                        <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-instagram"
                                href="#"><i class="fab fa-fw fa-instagram"></i></a> </li>
                        <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-twitter"
                                href="#"><i class="fab fa-fw fa-twitter"></i></a> </li>
                        <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-linkedin"
                                href="#"><i class="fab fa-fw fa-linkedin-in"></i></a> </li>
                    </ul>
                </div>
                <!-- Widget 1 END -->

                <!-- Widget 2 START -->
                <div class="col-lg-6">
                    <div class="row g-4">
                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4">Company</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="#">About us</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">News and Blogs</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Library</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Career</a></li>
                            </ul>
                        </div>

                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4">Community</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="#">Documentation</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Faq</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Forum</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Sitemap</a></li>
                            </ul>
                        </div>

                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4">Teaching</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="#">Become a teacher</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">How to guide</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Terms &amp; Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Widget 2 END -->

                <!-- Widget 3 START -->
                <div class="col-lg-3">
                    <h5 class="mb-2 mb-md-4">Contact</h5>
                    <!-- Time -->
                    <p class="mb-2">
                        Toll free:<span class="h6 fw-light ms-2">+1234 568 963</span>
                        <span class="d-block small">(9:AM to 8:PM IST)</span>
                    </p>

                    <p class="mb-0">Email:<span class="h6 fw-light ms-2">example@gmail.com</span></p>

                    <div class="row g-2 mt-2">
                        <!-- Google play store button -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-6">
                            <a href="#"> <img src="assets/images/client/google-play.svg" alt=""> </a>
                        </div>
                        <!-- App store button -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-6">
                            <a href="#"> <img src="assets/images/client/app-store.svg" alt="app-store"> </a>
                        </div>
                    </div> <!-- Row END -->
                </div>
                <!-- Widget 3 END -->
            </div><!-- Row END -->

            <!-- Divider -->
            <hr class="mt-4 mb-0">

            <!-- Bottom footer -->
            <div class="py-3">
                <div class="container px-0">
                    <div class="d-lg-flex justify-content-between align-items-center py-3 text-center text-md-left">
                        <!-- copyright text -->
                        <div class="text-body text-primary-hover"> Copyrights ©2026 Provil Sportslab. Build by <a
                                href="http://provil-ict.be/" target="_blank"
                                class="text-body">6ICW</a></div>
                        <!-- copyright links-->
                        <div class="justify-content-center mt-3 mt-lg-0">
                            <ul class="nav list-inline justify-content-center mb-0">
                                <li class="list-inline-item">
                                    <!-- Language selector -->
                                    <div class="dropup mt-0 text-center text-sm-end">
                                        <a class="dropdown-toggle nav-link" href="#" role="button" id="languageSwitcher"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-globe me-2"></i>Language
                                        </a>
                                        <ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
                                            <li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2"
                                                        src="assets/images/flags/uk.svg" alt="">English</a></li>
                                            <li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2"
                                                        src="assets/images/flags/gr.svg" alt="">German </a></li>
                                            <li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2"
                                                        src="assets/images/flags/sp.svg" alt="">French</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="list-inline-item"><a class="nav-link" href="#">Terms of use</a></li>
                                <li class="list-inline-item"><a class="nav-link pe-0" href="#">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- =======================
Footer END -->

    <!-- Info -->

    </div>


    <!-- Sticky element START -->

    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

    <!-- Vendors -->
    <script src="assets/vendor/tiny-slider/min/tiny-slider.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

    <?php include("partials/footer-scripts.php"); ?>

</body>
<script src="./js/main.js"></script>

</html>