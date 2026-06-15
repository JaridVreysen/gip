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
	<link rel="stylesheet" type="text/css" href="assets/vendor/aos/aos.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/glightbox/css/glightbox.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/quill/css/quill.snow.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bs-stepper/css/bs-stepper.min.css">

		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

	<?php include("partials/head-css.php"); ?>
</head>

<body>
				<!-- full header -->
				<?php include("partials/navbar.php"); ?>


	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Page Banner START -->
		<section class="py-0 bg-blue h-100px align-items-center d-flex h-200px rounded-0" style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
			<!-- Main banner background image -->
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<!-- Title -->
						<h1 class="text-white">Edit Fiche</h1>
						<!-- <p class="text-white mb-0">Read our <a href="#" class="text-white"><u>"Before you create a course"</u></a> article before submitting!</p> -->
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Page Banner END -->

		<!-- =======================
Steps START -->
		<section>
			<div class="container">
				<div class="card bg-white border rounded-3 mb-5 ">
					<div id="stepper" class="bs-stepper stepper-outline">
						<!-- Card header -->
						<div class="card-header bg-white border-bottom px-lg-5">
							







						<?php
						$id = $_GET['id'];
						$sql ="SELECT `id`,`title`, `niveau`, `excecute`, `muscles`, `time`, `exercise` FROM `fiche` WHERE id = ?";
						$statement = $conn->prepare($sql);
						$statement->bind_param("s", $id);
						$statement->execute();
						$result = $statement->get_result();
						if ($row = $result->fetch_assoc()) {
							$id = $row['id'];
							$title = $row['title'];
							$niveau = $row['niveau'];
							$excecute = $row['excecute'];
							$muscles = $row['muscles'];
							$time = $row['time'];
							$exercise = $row['exercise'];
					echo '<!-- Step 1 content START -->
									<role="tabpanel">
										<!-- Title -->
										<h4 class="mt-3">Fiche details</h4>

										<hr> <!-- Divider -->

										<!-- Basic information START -->
										<div class="row g-4 mb-4">
											<!-- Fiche Title -->
											<div class="col-6">
												<label class="form-label">Fiche title</label>
												<input class="form-control" type="text" placeholder="Enter Fiche Title"
												id="ficheTitle" value="'.$title.'" name="ficheTitle">
											</div>

											<!-- Fiche level -->
											<div class="col-md-6">
												<label class="form-label">Fiche level</label>
												<select id="niveau" class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="false" data-remove-item-button="true">
													<option value="0">1 Beginner</option>
													<option value="1">2 Gemiddeld</option>
													<option value="2">3 Gevorderd</option>
													<option value="3">4 Expert</option>
												</select>
											</div>
										</div>
										<div class"row">
											<!-- Cover picture -->
											<div class="col-12 justify-content-center align-items-center">
												<label class="form-label">Cover picture</label>
												<div class="d-flex align-items-center">
													<!-- Upload button -->
    												<input type="file" class="form-control" id="coverFile">
												</div> 
											</div> 
										</div> 


										<div class="row mt-3">
											<!-- Fiche uitvoering -->
											<div class="col-6">
												<label class="form-label">Uitvoering</label>
												<!-- Editor toolbar -->
												<div class="bg-light border border-bottom-0 rounded-top py-3" id="toolbar-uitvoering">
													<span class="ql-formats">
														<select class="ql-size"></select>
													</span>
													<span class="ql-formats">
														<button class="ql-bold"></button>
														<button class="ql-italic"></button>
														<button class="ql-underline"></button>
														<button class="ql-strike"></button>
													</span>
													<span class="ql-formats">
														<select class="ql-color"></select>
														<select class="ql-background"></select>
													</span>
													<span class="ql-formats">
														<button class="ql-code-block"></button>
													</span>
													<span class="ql-formats">
														<button class="ql-list" value="ordered"></button>
														<button class="ql-list" value="bullet"></button>
														<button class="ql-indent" value="-1"></button>
														<button class="ql-indent" value="+1"></button>
													</span>
													<span class="ql-formats">
														<button class="ql-link"></button>
													</span>
												</div>
												<div id="uitvoeringEditor" class="quill-editor" data-toolbar="#toolbar-uitvoering"></div>
												<!-- Dit wordt naar je database gestuurd -->
  												<!--<input type="hidden" name="execute" id="execute">-->
											</div>
												

											<!-- Fiche aandachtspunten -->
											<div class="col-6">
												<label class="form-label">Aandachtspunten</label>
												<!-- Editor toolbar -->
												<div class="bg-light border border-bottom-0 rounded-top py-3" id="toolbar-aandachtspunten">
													<span class="ql-formats">
														<select class="ql-size"></select>
													</span>
													<span class="ql-formats">
														<button class="ql-bold"></button>
														<button class="ql-italic"></button>
														<button class="ql-underline"></button>
														<button class="ql-strike"></button>
													</span>
													<span class="ql-formats">
														<select class="ql-color"></select>
														<select class="ql-background"></select>
													</span>
													<span class="ql-formats">
														<button class="ql-code-block"></button>
													</span>
													<span class="ql-formats">
														<button class="ql-list" value="ordered"></button>
														<button class="ql-list" value="bullet"></button>
														<button class="ql-indent" value="-1"></button>
														<button class="ql-indent" value="+1"></button>
													</span>
													<span class="ql-formats">
														<button class="ql-link"></button>
													</span>
												</div>
												<div id="exerciseEditor" class="quill-editor" data-toolbar="#toolbar-aandachtspunten"></div>
											</div>
										</div>

										<!--muscles -->
										<div class="row g-4 mb-4 mt-7">
											<!-- Fiche muscles -->
											<div class="col-6">
												<label class="form-label">Muscles</label>
												<input class="form-control" type="text" placeholder="Enter Muscle Type"
												  placeholder="muscles" id="muscles" value="'.$muscles.'" name="muscles">
											</div>

											<!-- Fiche exersise -->
											<div class="col-6">
												<label class="form-label">Exersise</label>
												<input class="form-control" type="text" placeholder="Enter Exercise Name"
												  placeholder="exercise" id="exercise" value="'.$exercise.'" name="exercise">
											</div>
										</div>

										<div class="row">
  											<!-- Muscle picture -->
 											<div class="col-6">
   											 	<label class="form-label" for="muscleFile">Muscle picture</label>
												<div class="align-items-center">
													<input type="file" class="form-control" id="muscleFile">
												</div>
											</div>

											<div class="col-6">
												<label class="form-label" for="exerciseFile">Exercise picture</label>
												<div class="align-items-center">
													<input type="file" class="form-control" id="exerciseFile">
												</div>
											</div>

											<!-- time -->
											<div class="col-2 mt-3">
												<label class="form-label">Hours</label>
												<input class="form-control" type="number" placeholder="Enter Hours" id="ficheHours" name="ficheHours">
											</div>
											<div class="col-4 mt-3">
												<label class="form-label">Minutes</label>
												<input class="form-control" type="number" placeholder="Enter Minutes" id="ficheMinutes" name="ficheMinutes">
											</div>

											<div class="row">
												<a  class="btn btn-success m-3 mt-4" onclick="submitFiche(); refresh();">Submit fiche</a>
											</div>
										</div>

										

										<!-- Basic information START -->
									</div>';
									};?>

								</form>
							</div>
						</div>
						<!-- Card body END -->
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Steps END -->

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

	<!-- Popup modal for add lecture START -->
	<div class="modal fade" id="addLecture" tabindex="-1" aria-labelledby="addLectureLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h5 class="modal-title text-white" id="addLectureLabel">Add Lecture</h5>
					<button type="button" class="btn btn-sm btn-light mb-0 ms-auto" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
				</div>
				<div class="modal-body">
					<form class="row text-start g-3">
						<!-- Course name -->
						<div class="col-12">
							<label class="form-label">Course name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Enter course name">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success my-0">Save Lecture</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Popup modal for add lecture END -->

	<!-- Popup modal for add topic START -->
	<div class="modal fade" id="addTopic" tabindex="-1" aria-labelledby="addTopicLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h5 class="modal-title text-white" id="addTopicLabel">Add topic</h5>
					<button type="button" class="btn btn-sm btn-light mb-0 ms-auto" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
				</div>
				<div class="modal-body">
					<form class="row text-start g-3">
						<!-- Topic name -->
						<div class="col-md-6">
							<label class="form-label">Topic name</label>
							<input class="form-control" type="text" placeholder="Enter topic name">
						</div>
						<!-- Video link -->
						<div class="col-md-6">
							<label class="form-label">Video link</label>
							<input class="form-control" type="text" placeholder="Enter Video link">
						</div>
						<!-- Description -->
						<div class="col-12 mt-3">
							<label class="form-label">Course description</label>
							<textarea class="form-control" rows="4" placeholder="" spellcheck="false"></textarea>
						</div>
						<!-- Buttons -->
						<div class="col-6 mt-3">
							<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
								<!-- Free button -->
								<input type="radio" class="btn-check" name="options" id="option1" checked="">
								<label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0" for="option1">Free</label>
								<!-- Premium button -->
								<input type="radio" class="btn-check" name="options" id="option2">
								<label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0" for="option2">Premium</label>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success my-0">Save topic</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Popup modal for add topic END -->

	<!-- Popup modal for add faq START -->
	<div class="modal fade" id="addQuestion" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h5 class="modal-title text-white" id="addQuestionLabel">Add FAQ</h5>
					<button type="button" class="btn btn-sm btn-light mb-0 ms-auto" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
				</div>
				<div class="modal-body">
					<form class="row text-start g-3">
						<!-- Question -->
						<div class="col-12">
							<label class="form-label">Question</label>
							<input class="form-control" type="text" placeholder="Write a question">
						</div>
						<!-- Answer -->
						<div class="col-12 mt-3">
							<label class="form-label">Answer</label>
							<textarea class="form-control" rows="4" placeholder="Write a answer" spellcheck="false"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success my-0">Save topic</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Popup modal for add faq END -->

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<!-- Vendors -->
	<script src="assets/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
	<script src="assets/vendor/aos/aos.js"></script>
	<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="assets/vendor/quill/js/quill.min.js"></script>
	<script src="assets/vendor/bs-stepper/js/bs-stepper.min.js"></script>

	<?php include("partials/footer-scripts.php"); ?>

</body>
<script src="/js/main.js"></script>
<script src="/js/instructor-create-fiche.js"></script>
</html>