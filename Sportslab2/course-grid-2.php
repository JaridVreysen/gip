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
							<h1 class="m-0">Course Grid</h1>
							<!-- Breadcrumb -->
							<div class="d-flex justify-content-center">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb breadcrumb-dots mb-0">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Course minimal</li>
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
		<section class="pt-0">
			<div class="container">

				<!-- Filter bar START -->
				<form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative">
					<div class="row g-3">
						<!-- Input -->
						<div class="col-xl-3">
							<input class="form-control me-1" type="search" placeholder="Enter keyword">
						</div>

						<!-- Select item -->
						<div class="col-xl-8">
							<div class="row g-3">
								<!-- Select items -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice" aria-label=".form-select-sm example">
										<option value="">Categories</option>
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
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice" aria-label=".form-select-sm example">
										<option value="">Price level</option>
										<option>All</option>
										<option>Free</option>
										<option>Paid</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice" aria-label=".form-select-sm example">
										<option value="">Skill level</option>
										<option>All levels</option>
										<option>Beginner</option>
										<option>Intermediate</option>
										<option>Advanced</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice" aria-label=".form-select-sm example">
										<option value="">Language</option>
										<option>English</option>
										<option>Francas</option>
										<option>Russian</option>
										<option>Hindi</option>
										<option>Bengali</option>
										<option>Spanish</option>
									</select>
								</div>
							</div> <!-- Row END -->
						</div>
						<!-- Button -->
						<div class="col-xl-1">
							<button type="button" class="btn btn-primary mb-0 rounded z-index-1 w-100"><i class="fas fa-search"></i></button>
						</div>
					</div> <!-- Row END -->
				</form>
				<!-- Filter bar END -->

				<div class="row mt-3">
					<!-- Main content START -->
					<div class="col-12">

						<!-- Course Grid START -->
						<div class="row g-4">
							<?php
							$sql =  "SELECT c.id, c.name, c.courseImage, c.introduction, c.time, c.pages, c.path as cpath, o.name as organisationname, u.profilePicture, u.path
							FROM `course` c 
							INNER JOIN `organisation` o ON o.id = c.organisationId
							INNER JOIN `user` u ON u.id = c.authorId
							WHERE 1 ";
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
								$totaalMinuten = $row['time'];
								$uren = floor($totaalMinuten / 60);
								$minuten = $totaalMinuten % 60;
								$pages = $row['pages'];
								echo		'<!-- Card item START -->
							<div class="col-sm-6 col-lg-4 col-xl-3">
								<div class="card shadow h-100">
									<!-- Image -->
									<img style="max-height: 145px;" src="./media/' . $image . '" class="card-img-top" alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Title -->
										<h5 class="card-title"><a href="#">' . $name . '</a></h5>
										<!-- description -->
                                <p class="mb-2 text-truncate-2">' . $introduction . '</p>
									</div>
									<!-- Badge and favorite -->
										<div class="d-flex justify-content-between ms-3">
											<a href="#" class="badge bg-purple bg-opacity-10 text-purple">' . $organisation . '</a>
										</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 pb-3">
										<hr>
										<div class="d-flex justify-content-between">
											<span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-2"></i>' . $uren . 'h ' . $minuten . 'm</span>
											<span class="h6 fw-light mb-0"><i class="fas fa-table text-orange me-2"></i>' . $pages . ' fiches</span>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->';
							};
							?>
	

						</div>
						<!-- Course Grid END -->

						<!-- Pagination START -->
						<div class="col-12">
							<nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
								<ul class="pagination pagination-primary-soft d-inline-block d-md-flex rounded mb-0">
									<li class="page-item mb-0"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a></li>
									<li class="page-item mb-0"><a class="page-link" href="#">1</a></li>
									<li class="page-item mb-0 active"><a class="page-link" href="#">2</a></li>
									<li class="page-item mb-0"><a class="page-link" href="#">..</a></li>
									<li class="page-item mb-0"><a class="page-link" href="#">6</a></li>
									<li class="page-item mb-0"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>
								</ul>
							</nav>
						</div>
						<!-- Pagination END -->
					</div>
					<!-- Main content END -->
				</div><!-- Row END -->
			</div>
		</section>
		<!-- =======================
Page content END -->

		<!-- =======================


	<!-- Back to top -->
		<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

		<!-- Vendors -->
		<script src="assets/vendor/choices.js/public/assets/scripts/choices.min.js"></script>

		<?php include("partials/footer-scripts.php"); ?>

</body>

</html>