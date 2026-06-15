<?php
session_start();
include './includes/dbh.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("partials/title-meta.php"); ?>

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/choices.js/public/assets/styles/choices.min.css">
    <script src="https://kit.fontawesome.com/4887620887.js" crossorigin="anonymous"></script>
    <?php include("partials/head-css.php"); ?>
</head>

<body>

    <?php include("partials/navbar.php"); ?>

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
Page Banner START -->
        <section class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bg-light p-4 text-center rounded-3">
                            <h1 class="m-0">Fiche Grid</h1>
                            <!-- Breadcrumb -->
                            <div class="d-flex justify-content-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-dots mb-0">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Fiches</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
Page Banner END -->

        <!-- =======================
Page content START -->
        <section class="pt-5">
            <div class="container">
                <!-- Search option START -->
                <div class="row mb-4 align-items-center">
                    <!-- Search bar -->
                    <div class="col-sm-6 col-xl-4">
                        <form class="border rounded p-2">
                            <div class="input-group input-borderless">
                                <input class="form-control me-1" type="search" placeholder="Search fiche">
                                <button type="button" class="btn btn-primary mb-0 rounded"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Select option -->
                    <div class="col-sm-6 col-xl-3 mt-3 mt-lg-0">
                        <form class="border rounded p-2 input-borderless">
                            <select class="form-select form-select-sm js-choice" aria-label=".form-select-sm">
                                <option value="">Category</option>
                                <option>All</option>
                                <option>Development</option>
                                <option>Design</option>
                                <option>Accounting</option>
                                <option>Translation</option>
                                <option>Finance</option>
                                <option>Legal</option>
                                <option>Photography</option>
                                <option>Writing</option>
                                <option>Marketing</option>
                            </select>
                        </form>
                    </div>

                    <!-- Select option -->
                    <div class="col-sm-6 col-xl-3 mt-3 mt-xl-0">
                        <form class="border rounded p-2 input-borderless">
                            <select class="form-select form-select-sm js-choice" aria-label=".form-select-sm">
                                <option value="">Sort by</option>
                                <option>Free</option>
                                <option>Most viewed</option>
                                <option>Popular</option>
                            </select>
                        </form>
                    </div>

                    <!-- Button -->
                    <div class="col-sm-6 col-xl-2 mt-3 mt-xl-0 d-grid">
                        <a href="#" class="btn btn-lg btn-primary mb-0">Filter Results</a>
                    </div>
                </div>
                <!-- Search option END -->

                <!-- fiche list START -->
                <div class="row g-4 justify-content-center">
                    <?php
                    $sql =  "SELECT f.id, f.title, f.niveau, f.muscles, f.time, f.exercise, f.cName, f.cPath, f.cExtension,
                                u.profilePicture, u.firstname, u.lastname, u.username
                            FROM `fiche` f 
                            INNER JOIN `user` u ON u.id = f.authorId 
                            WHERE 1";
                    $statement = $conn->prepare($sql);
                    // $statement->bind_param('s', $user);
                    $statement->execute();
                    $result = $statement->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $title = $row['title'];
                        $username = $row['username'];
                        $image = $row['cPath'];
                        $niveau = $row['niveau'] + 1;
                        $muscles = $row['muscles'];
                        $totaalMinuten = $row['time'];
                        $uren = floor($totaalMinuten / 60);
                        $minuten = $totaalMinuten % 60;
                        echo '<!-- Card item START -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="card shadow h-100">
                                            <!-- Image -->
                                            <img style="max-height: 145px; object-fit: cover;" src="./media/' . $image . '" class="card-img-top" alt="course image">
                                            <!-- Card body -->
                                            <div class="card-body pb-0">
                                                <!-- Title -->
                                                 <div class="d-flex justify-content-between">
                                                    <span class="h5 fw-light mb-0"><i class="me-2"></i>' . $title . '</span>
                                                    <span class="h8 fw-light mb-0"><i class="me-2"></i>' . $username . '</span>
                                                </div>

                                                <!-- description -->
                                                 <p class="mt-1 text-truncate-2">' . $muscles . '</p>
                                            </div>
                                            <!-- Card footer -->
                                            <div class="card-footer pt-0 pb-3"><hr>
                                                <div class="d-flex justify-content-between">
                                                    <span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-2"></i>' . $uren . 'h ' . $minuten . 'm</span>
                                                    <span class="h6 fw-light mb-0"><i class="fas fa-arrow-trend-up text-primary me-2"></i>Niveau ' . $niveau . '</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card item END -->';
                    };
                    ?>

                    <!-- Pagination START -->
                    <div class="col-12">
                        <nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
                            <ul class="pagination pagination-primary-soft d-inline-block d-md-flex rounded mb-0">
                                <li class="page-item mb-0"><a class="page-link" href="#" tabindex="-1"><i
                                            class="fas fa-angle-double-left"></i></a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#">1</a></li>
                                <li class="page-item mb-0 active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#">..</a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#">6</a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#"><i
                                            class="fas fa-angle-double-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Pagination END -->

                </div>
        </section>
        <!-- =======================
Page content END -->

        <!-- =======================
Action box START -->
        <section class="pt-0">
            <div class="container position-relative">
                <!-- SVG -->
                <figure class="position-absolute top-50 start-50 translate-middle ms-3">
                    <svg>
                        <path
                            d="m496 22.999c0 10.493-8.506 18.999-18.999 18.999s-19-8.506-19-18.999 8.507-18.999 19-18.999 18.999 8.506 18.999 18.999z"
                            fill="#fff" fill-rule="evenodd" opacity=".502" />
                        <path
                            d="m775 102.5c0 5.799-4.701 10.5-10.5 10.5-5.798 0-10.499-4.701-10.499-10.5 0-5.798 4.701-10.499 10.499-10.499 5.799 0 10.5 4.701 10.5 10.499z"
                            fill="#fff" fill-rule="evenodd" opacity=".102" />
                        <path
                            d="m192 102c0 6.626-5.373 11.999-12 11.999s-11.999-5.373-11.999-11.999c0-6.628 5.372-12 11.999-12s12 5.372 12 12z"
                            fill="#fff" fill-rule="evenodd" opacity=".2" />
                        <path
                            d="m20.499 10.25c0 5.66-4.589 10.249-10.25 10.249-5.66 0-10.249-4.589-10.249-10.249-0-5.661 4.589-10.25 10.249-10.25 5.661-0 10.25 4.589 10.25 10.25z"
                            fill="#fff" fill-rule="evenodd" opacity=".2" />
                    </svg>
                </figure>
            </div>
        </section>
        <!-- =======================
Action box END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

    <!-- Vendors -->
    <script src="assets/vendor/choices.js/public/assets/scripts/choices.min.js"></script>

    <?php include("partials/footer-scripts.php"); ?>

</body>

</html>