<?php
session_start();
include './includes/dbh.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("partials/title-meta.php"); ?>

	<?php include("partials/head-css.php"); ?>
</head>

<body>

	<?php include("partials/navbar.php"); ?>

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Page Banner START -->
		<section class="pt-0">
			<!-- Main banner background image -->
			<div class="container-fluid px-0">
				<div class="bg-blue h-100px h-md-200px rounded-0" style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
				</div>
			</div>
			<div class="container mt-n4">
				<div class="row">
					<?php include("partials/profile-banner.php"); ?>

					<!-- Advanced filter responsive toggler START -->
					<!-- Divider -->
					<hr class="d-xl-none">
					<div class="col-12 col-xl-3 d-flex justify-content-between align-items-center">
						<a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
						<button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
							<i class="fas fa-sliders-h"></i>
						</button>
					</div>
					<!-- Advanced filter responsive toggler END -->
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
				<div class="row">

					<?php include("partials/instructor-side-bar.php"); ?>
					

					<!-- Main content START -->
					<div class="col-xl-9">
						<!-- Privacy START -->
						<div class="border rounded-3">
							<div class="row">
								<div class="col-12">
									<!-- Card START -->
									<div class="card bg-transparent">
										<!-- Card header START -->
										<div class="card-header bg-transparent border-bottom">
											<h3 class="card-header-title">Settings</h3>
										</div>
										<!-- Card header END -->

										<!-- Card body START -->
										<div class="card-body">

											<!-- Profile START -->
											<h5 class="mb-4">Profile Settings</h5>
											<div class="form-check form-switch form-check-md">
												<input class="form-check-input" type="checkbox" role="switch" id="profilePublic" checked>
												<label class="form-check-label" for="profilePublic">Your profile's public visibility</label>
											</div>
											<!-- Profile START -->

											<hr><!-- Divider -->

											<!-- Notification START -->
											<h5 class="card-header-title">Notifications Settings</h5>
											<p class="mb-2 mt-3">Choose type of notifications you want to receive</p>
											<div class="form-check form-switch form-check-md mb-3">
												<input class="form-check-input" type="checkbox" id="checkPrivacy1" checked="">
												<label class="form-check-label" for="checkPrivacy1">Notify me via email when logging in</label>
											</div>
											<div class="form-check form-switch form-check-md mb-3">
												<input class="form-check-input" type="checkbox" id="checkPrivacy2">
												<label class="form-check-label" for="checkPrivacy2">Send SMS confirmation for all online payments</label>
											</div>
											<div class="form-check form-switch form-check-md mb-3">
												<input class="form-check-input" type="checkbox" id="checkPrivacy3" checked="">
												<label class="form-check-label" for="checkPrivacy3">Check which device(s) access your account</label>
											</div>
											<div class="form-check form-switch form-check-md mb-3">
												<input class="form-check-input" type="checkbox" id="checkPrivacy4">
												<label class="form-check-label" for="checkPrivacy4">Show your profile publicly</label>
											</div>
											<!-- Notification START -->

											<!-- Buttons -->
											<div class="d-sm-flex justify-content-end">
												<button type="button" class="btn btn-sm btn-primary me-2 mb-0">Save changes</button>
												<a href="#" class="btn btn-sm btn-outline-secondary mb-0">Cancel</a>
											</div>

										</div>
										<!-- Card body END -->
									</div>
									<!-- Card END -->
								</div>
								<!-- Privacy END -->
							</div>
						</div>
						<!-- Main content END -->
					</div><!-- Row END -->
				</div>
			</div>
		</section>
		<!-- =======================
Page content END -->

	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- =======================
Footer START -->
	<footer class="bg-dark p-3">
		<div class="container">
			<div class="row align-items-center">
				<!-- Widget -->
				<div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
					<!-- Logo START -->
					<a href="index.php"> <img class="h-20px" src="assets/images/logo-light.svg" alt="logo"> </a>
				</div>

				<!-- Widget -->
				<div class="col-md-4 mb-3 mb-md-0">
					<div class="text-center text-white text-primary-hover">
						Copyrights ©2024 Eduport. Build by <a href="https://1.envato.market/stackbros-portfolio" target="_blank" class="text-white">StackBros</a>.
					</div>
				</div>
				<!-- Widget -->
				<div class="col-md-4">
					<!-- Rating -->
					<ul class="list-inline mb-0 text-center text-md-end">
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-facebook"></i></a></li>
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-instagram"></i></a></li>
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-linkedin-in"></i></a></li>
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- =======================
Footer END -->

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>



	<?php include("partials/footer-scripts.php"); ?>

</body>

</html>