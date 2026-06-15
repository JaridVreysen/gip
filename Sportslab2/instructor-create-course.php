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

	<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">






	<?php include("partials/head-css.php"); ?>
	<?php include("partials/navbar.php"); ?>


	<!-- jQuery first (only once) -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

	<!-- Then jQuery UI (includes sortable, only once) -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.14.2/jquery-ui.min.js"></script>

	<style>.sortable-card {
  cursor: move;
}

.sortable-card > div {
  display: block !important;   /* override flex during drag calc */
}

.ui-sortable-placeholder {
  border: 2px dashed #ccc;
  background: #f8f9fa;
  visibility: visible !important;
  height: 80px !important;
}
</style>
</head>

<body>
	<!-- full header -->


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
						<h1 class="text-white">Create new Course</h1>
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












							<!-- Step 1 content START -->
							<role="tabpanel">
								<!-- Title -->
								<h4 class="mt-3">Course details</h4>

								<hr> <!-- Divider -->

								<!-- Basic information START -->
								<div class="row g-4 mb-4">
									<!-- course Title -->
									<div class="col-6">
										<label class="form-label">Course Title</label>
										<input class="form-control" type="text" placeholder="Enter Course Title"
											id="courseTitle" name="courseTitle">
									</div>

									<!-- average level -->
									<div class="col-md-6">
										<label class="form-label">Average Course Level</label>
										<select id="niveau" class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="false" data-remove-item-button="true">
											<option value="0">1 Beginner</option>
											<option value="1">2 Gemiddeld</option>
											<option value="2">3 Gevorderd</option>
											<option value="3">4 Expert</option>
										</select>
									</div>
								</div>
								<div class="row">
									<!-- Cover picture -->
									<div class="col-12 justify-content-center align-items-center">
										<label class="form-label">Cover picture</label>
										<div class="d-flex align-items-center">
											<!-- Upload button -->
											<input type="file" class="form-control" id="file">
										</div>
									</div>
								</div>


								<div class="row mt-3">
									<!-- Fiche description -->
									<div class="col-12">
										<label class="form-label">description</label>
										<!-- Editor toolbar -->
										<div class="bg-light border border-bottom-0 rounded-top py-3" id="toolbar-description">
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
										<div id="descriptionEditor" class="quill-editor" data-toolbar="#toolbar-description"></div>
										<!-- Dit wordt naar je database gestuurd -->
										<!--<input type="hidden" name="execute" id="execute">-->
									</div>




										<div class="row g-4 mt-7">
											<div class="col-12 col-lg-6">
												<div class="card shadow-sm border-0">
													<div class="card-header bg-white border-0 pb-0">
														<h5 class="mb-0">Available fiches</h5>
														<small class="text-muted">Drag items to the other column</small>
													</div>

													<div class="card-body pt-3">
														<div class="table-responsive">
															<table class="table align-middle fiche-table mb-0">
																<thead class="table-light">
																	<tr>
																		<th class="border-0 rounded-start">Fiche Title</th>
																		<th class="border-0">Niveau</th>
																		<th class="border-0">Created At</th>
																	</tr>
																</thead>

																<tbody id="sortable1" class="connectedSortable">
																	<?php
																	$userId = $_SESSION['id'];
																	$sql = "SELECT `id`, `createdAt`, `title`, `niveau`, `time`, `cPath`
																	FROM `fiche` WHERE `authorId` = ?";
																	$statement = $conn->prepare($sql);
																	$statement->bind_param("s", $userId);
																	$statement->execute();
																	$result = $statement->get_result();

																	while ($row = $result->fetch_assoc()) {
																		$id = $row['id'];
																		$image = $row['cPath'];
																		$title = $row['title'];
																		$createdAt = $row['createdAt'];
																		$niveau = $row['niveau'] + 1;

																		$totaalMinuten = $row['time'];
																		$uren = floor($totaalMinuten / 60);
																		$minuten = $totaalMinuten % 60;

																															
																	echo '
																			<tr class="sortable-card" id="'.$id.'">
																			<td class="rounded-start">
																				<div class="d-flex align-items-center gap-3">
																				<span class="handle text-muted" title="Drag">
																					<i class="fas fa-grip-vertical"></i>
																				</span>

																				<img src="./media/' . $image . '" class="rounded-3 object-fit-cover" style="width:54px;height:54px" alt="">

																				<div class="min-w-0">
																					<div class="fw-semibold text-truncate">' . $title . '</div>
																					<div class="small text-muted">
																					<i class="far fa-clock me-1"></i>' . $uren . 'h ' . $minuten . 'm
																					</div>
																				</div>
																				</div>
																			</td>

																			<td>
																				<span class="badge bg-primary-subtle text-primary">' . $niveau . '</span>
																			</td>

																			<td class="text-muted">' . $createdAt . '</td>

													
																			</tr>
																		';
																	}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>

											<div class="col-12 col-lg-6">
												<div class="card shadow-sm border-0">
													<div class="card-header bg-white border-0 pb-0">
														<h5 class="mb-0">Selected</h5>
														<small class="text-muted">Drop items here</small>
													</div>

													<div class="card-body pt-3">
														<div class="table-responsive">
															<table class="table align-middle fiche-table mb-0">
																<thead class="table-light">
																	<tr>
																		<th class="border-0 rounded-start">Fiche Title</th>
																		<th class="border-0">Niveau</th>
																		<th class="border-0">Created At</th>
																	</tr>
																</thead>

																<tbody id="sortable2" class="connectedSortable">
																	<!-- empty by default -->
																	<tr class="empty-row">
																		<td colspan="4" class="rounded-3">
																		<div class="py-4 text-center text-muted">
																			<div class="fw-semibold">Drop fiches here</div>
																			<div class="small">Drag from the left table</div>
																		</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>

														<div class="text-center text-muted small mt-3 empty-hint">
															Drag a fiche here to add it
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row mt-7">
											<a class="btn btn-success m-3 mt-4" onclick="createcourse(); refresh();">Submit course</a>
										</div>
									</div>
							</div>


						<!-- Basic information START -->


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



<script>
	$(function() {
		$(function() {
			$("#sortable1, #sortable2").sortable({
				connectWith: ".connectedSortable"
			}).disableSelection();
		});
	});
</script>
<script src="/js/main.js"></script>
<script src="/js/instructor-create-course.js"></script>
<script src="/assets/vendor/quill/js/quill.min.js"></script>


</html>