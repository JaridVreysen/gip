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
Main Banner START -->
		<section class="pt-0">
			<!-- Main banner background image -->
			<div class="container-fluid px-0">
				<div class="bg-blue h-100px h-md-200px rounded-0" style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
				</div>
			</div>
			<div class="container mt-n4">
				<div class="row">
					<?php include("partials/profile-banner.php") ?>
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
Main Banner END -->

		<!-- =======================
Inner part START -->
		<section class="pt-0">
			<div class="container">
				<div class="row">
					<?php include("partials/instructor-side-bar.php"); ?>
					

					<!-- Main content START -->
					<div class="col-xl-9">
						<!-- Card START -->
						<div class="card border bg-transparent rounded-3">
							<!-- Card header START -->
							<div class="card-header bg-transparent border-bottom">
								<h3 class="mb-0">My Fiches</h3>
							</div>
							<!-- Card header END -->

							<!-- Card body START -->
							<div class="card-body">
								<!-- Search and select END -->

								<!-- Course list table START -->
								<div class="table-responsive border-0">
									<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
										<!-- Table head -->
										<thead>
											<tr>
												<th scope="col" class="border-0 rounded-start">Fiche Title</th>
												<th scope="col" class="border-0">Niveau</th>
												<th scope="col" class="border-0">Created At</th>
												<th scope="col" class="border-0 rounded-end">Action</th>
											</tr>
										</thead>

									<?php
									$userId = $_SESSION['id'];
									$sql =  "SELECT `id`, `createdAt`, `updatedAt`, `title`, `niveau`, `time`, `introduction`, `cName`, `cPath`, `cExtension`, `authorId` 
									FROM `fiche` WHERE `authorId` = ?";
									$statement = $conn->prepare($sql);
									$statement->bind_param("s", $userId);
									$statement->execute();
									$result = $statement->get_result();
									$aantal = 0;
									$total = 0;

									while ($row = $result->fetch_assoc()) {
										$aantal += 1;
										$total +=1;
										$id = $row['id'];
										$image = $row['cPath'];
										$title = $row['title'];
										$createdAt = $row['createdAt'];
										$niveau = $row['niveau'] + 1 ;
										$totaalMinuten = $row['time'];
                        				$uren = floor($totaalMinuten / 60);
                       					$minuten = $totaalMinuten % 60;

										echo '<!-- Table body START -->
											<tbody>
												<!-- Table item -->
												<tr>
													<!-- Course item -->
													<td>
														<div class="d-flex align-items-center">
															<!-- Image -->
															<div class="w-60px">
																<img src="./media/' . $image . '" class="rounded" alt="">
															</div>
															<div class="mb-0 ms-2">
																<!-- Title -->
																<h6><a href="#">'.$title.'</a></h6>
																<!-- Info -->
																<div class="d-sm-flex">
																	<span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-2"></i>' . $uren . 'h ' . $minuten . 'm</span>
																</div>
															</div>
														</div>
													</td>
													<!-- Enrolled item -->
													<td class="text-center text-sm-start">'.$niveau.'</td>
												
													<!-- created at item -->
													<td>'.$createdAt.'</td>
													<!-- Action item -->
													<td>
														<a href="fiche-styling.php?id='.$id.'" class="btn btn-sm btn-success-soft btn-round mb-0"><i class="fas fa-fw fa-eye"></i></a>
														<button class="btn btn-sm btn-danger-soft btn-round mb-0" onclick="deleteFiche(\''.$id.'\')"><i class="fas fa-fw fa-times"></i></button>
													</td>
												</tr>
											</tbody>
										<!-- Table body END -->';
                                    }; ?>
									

										
										
									</table>
								</div>
								<!-- Course list table END -->

								<!-- Pagination START -->
								<div class="d-sm-flex justify-content-sm-between align-items-sm-center mt-4 mt-sm-3">
								</div>
								<!-- Pagination END -->
							</div>
							<!-- Card body START -->
						</div>
						<!-- Card END -->
					</div>
					<!-- Main content END -->
				</div><!-- Row END -->
			</div>
		</section>
		<!-- =======================
Inner part END -->

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

	<!-- Vendors -->
	<script src="assets/vendor/choices.js/public/assets/scripts/choices.min.js"></script>

	<?php include("partials/footer-scripts.php"); ?>

</body>
<script src="/js/delete-fiche.js"></script>
<script src="/js/edit-fiche.js"></script>


</html>