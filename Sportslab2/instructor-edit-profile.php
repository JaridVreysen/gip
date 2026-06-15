<?php
session_start();
include './includes/dbh.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" type="text/css" href="assets/vendor/choices.js/public/assets/styles/choices.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
				<div class="bg-blue h-100px h-md-200px rounded-0"
					style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
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
						<button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas"
							data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
							<i class="fas fa-sliders-h"></i>
						</button>
					</div>
					<!-- Advanced filter responsive toggler END -->
				</div>
			</div>
			</div>
		</section>
		<!-- ======================= Page Banner END -->

		<!-- Page content START -->
		<section class="pt-0">
			<div class="container">
				<div class="row">

					<?php include("partials/instructor-side-bar.php"); ?>





					<?php
					if (isset($_SESSION['id'])) {
						$userId = $_SESSION['id'];

						$sql = "SELECT * FROM `organisation`";
						$statement = $conn->prepare($sql);
						$statement->execute();
						$result = $statement->get_result();
						$organistationArray = array();
						while ($row = $result->fetch_assoc()) {
							$organistationArray[$row['id']] = $row['name'];
						}


						$sql = "SELECT * FROM `user` WHERE id = ?";
						$statement = $conn->prepare($sql);
						$statement->bind_param("s", $userId);
						$statement->execute();
						$result = $statement->get_result();

						if ($row = $result->fetch_assoc()) {
							$currentUserId = $row['id'];
							$username = $row['username'];
							$firstname = $row['firstname'];
							$lastname = $row['lastname'];
							$email = $row['email'];
							$profilePicture = $row['path'];
							$age = $row['age'];
							$weight = $row['weight'];
							$length = $row['length'];
							$gender = $row['gender'];
							$about = $row['about'];
							$name = $row['name'];

							$organistationOption = '';
							foreach ($organistationArray as $key => $organisation) {
								$organistationOption .= '<option value="' . $key . '" ' . $userOrganisationId = $row['id'] . '>' . $organisation . '</option>';
							}


							echo '<div class="col-xl-9">
						<!-- Edit profile START -->
						<div class="card bg-transparent border rounded-3">
							<!-- Card header -->
							<div class="card-header bg-transparent border-bottom">
								<h3 class="card-header-title mb-0">Edit Profile</h3>
							</div>
							<!-- Card body START -->
							<div class="card-body">
								<!-- Form -->
								<div class="row g-4 mb-4">
								<p id="editProfileUploadProfilePicture" class="text-danger"></p>
								<!-- Profile picture -->
									<div class="col-12 justify-content-center align-items-center">
										<label class="form-label">Profile picture</label>
										<div class="d-flex align-items-center">
											<!-- Upload button -->
    										<input type="file" class="form-control" id="file">
											 <!-- enkel afbeelding selecteren -->
   											 <button class="btn btn-primary m-2" onclick="uploadFile()">Upload</button>
										</div>
									</div> 

									<!-- Full name -->
									<div class="col-12">
										<label class="form-label">Full name</label>
										<div class="input-group">
											<input id="firstName" type="text" class="form-control" value="' . $firstname . '" placeholder="First name">
											<input id="lastName" type="text" class="form-control" value="' . $lastname . '" placeholder="Last name">
										</div>
									</div>

									<!-- Username -->
									<div class="col-md-6">
										<label class="form-label">Username</label>
										<div class="input-group">
											<!--<span class="input-group-text">Eduport.com</span>-->
											<input id="userName" type="text" class="form-control" value="' . $username . '" placeholder="Disabled input" aria-label="Disabled input example" disabled>
										</div>
									</div>

									<!-- Email id -->
									<div class="col-md-6">
										<label class="form-label">Email id</label>
										<input id="email" class="form-control" type="email" value="' . $email . '" placeholder="Disabled input" aria-label="Disabled input example" disabled>
									</div>

									<!-- age -->
									<div class="col-md-3">
										<label class="form-label">age</label>
										<input id="age" class="form-control" type="number" min="0" max="99" value="' . $age . '" placeholder="age">
									</div>


									<!-- gender -->
									<div class="col-md-3">	
										<label class="form-label">gender</label>
										<select id="gender" class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="false" data-remove-item-button="true">
											<option value="" readonly disabled>- Select gender -</option>
											<option value="0" ' . ($gender == 0 ? 'selected' : '') . '>Male</option>
											<option value="1" ' . ($gender == 1 ? 'selected' : '') . '>Female</option>
											<option value="2" ' . ($gender == 2 ? 'selected' : '') . '>Other</option>
										</select>
									</div>

									<!-- length -->
									<div class="col-md-3">
										<label class="form-label">length</label>
										<input id="length" class="form-control" type="number" min="0" max="255" value="' . $length . '" placeholder="length (cm)">
										
									</div>

									<!-- weight -->
									<div class="col-md-3 unit-input">
										<label class="form-label">weight</label>
										<input id="weight" class="form-control" type="number" min="0" max="255" value="' . $weight . '" placeholder="weight (kg)">
									</div>

									<!-- About me -->
									<div class="col-12">
										<label class="form-label">About me</label>
										<textarea id="about" class="form-control" rows="3">' . $about	. '</textarea>
										<div class="form-text">Brief description for your profile.</div>
									</div>

									<!-- organisation -->
									<div class="col-md-3">	
										<label class="form-label">organisation</label>
										<select id="organisation" class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="false" data-remove-item-button="true">
											<option value="" readonly disabled>- Select organisation -</option>
											'.$organistationOption.'
										</select>
									</div>

									<!-- Save button -->
									<div class="d-sm-flex justify-content-end">
										<button type="button" onclick="changeprofile(); refresh();" class="btn btn-primary mb-0">Save changes</button>
									</div>
								</div>
							</div>
							<!-- Card body END -->
						</div>
						<!-- Edit profile END -->';
						} else {
							echo '<div class="col-xl-9">
						<!-- Edit profile START -->
						<div class="card bg-transparent border rounded-3">
							<!-- Card header -->
							<div class="card-header bg-transparent border-bottom">
								<h3 class="card-header-title mb-0">Edit Profile</h3>
							</div>							
							<!-- Card body END -->
						</div>
						<!-- Edit profile END -->';
						};
					} else {
						echo "<h1No login information<h1>";
					};
					?>


					<!-- pfp url -->
					<!-- <div class="col-md-6"> -->
					<!-- <label class="form-label">Profile picture URL</label> -->
					<!-- <input id="profilePicture" class="form-control" type="URL" svalue="' . $profilePicture . '" placeholder="URL"> -->
					<!-- </div> -->





					<!-- Main content START -->
				</div><!-- Row END -->
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
						Copyrights ©2024 Eduport. Build by <a href="https://1.envato.market/stackbros-portfolio"
							target="_blank" class="text-white">StackBros</a>.
					</div>
				</div>
				<!-- Widget -->
				<div class="col-md-4">
					<!-- Rating -->
					<ul class="list-inline mb-0 text-center text-md-end">
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-facebook"></i></a>
						</li>
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-instagram"></i></a>
						</li>
						<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-linkedin-in"></i></a>
						</li>
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

	<script src="assets/vendor/choices.js/public/assets/scripts/choices.min.js"></script>


	<?php include("partials/footer-scripts.php"); ?>

</body>
<script src="/js/instructor-edit-profile.js"></script>
<script src="/js/main.js"></script>

</html>