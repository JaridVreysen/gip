<?php include("partials/totalFiches.php"); ?>
<?php
							if(isset($_SESSION['id'])){
                            $userId = $_SESSION['id'];
                            $sql = "SELECT `id`, `firstname`,`lastname`, `path`,`email` FROM `user` WHERE id = ?;";
                            $statement = $conn->prepare($sql);
                            $statement->bind_param("i", $userId);
                            $statement->execute();
                            $result = $statement->get_result();
                            if($row = $result->fetch_assoc()){
                                $currentUserId = $row['id'];
                                $firstname = $row['firstname'];
								$lastname = $row['lastname'];
								$email = $row['email'];
								$profilePicture = $row['path'];
								
								echo '<!-- Profile banner START -->
								<div class="col-12">
									<div class="card bg-transparent card-body p-0">
										<div class="row d-flex justify-content-between">
											<!-- Avatar -->
											<div class="col-auto mt-4 mt-md-0">
												<div class="avatar avatar-xxl mt-n3">
													<img class="avatar-img rounded-circle border border-white border-3 shadow" src="./media/'.$profilePicture.'" alt="">
												</div>
											</div>
											<!-- Profile info -->
											<div class="col d-md-flex justify-content-between align-items-center mt-4">
												<div>
													<h1 class="my-1 fs-4">'.$firstname.' '.$lastname.' <i class="bi bi-patch-check-fill text-info small"></i></h1>
													<ul class="list-inline mb-0">
														<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"><i class="fas fa-star text-warning me-2"></i>4.5/5.0</li>
														<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"><i class="fas fa-user-graduate text-orange me-2"></i>12k Enrolled Students</li>
														<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"><i class="fas fa-book text-purple me-2"></i>'.$totalFiches.' Fiches</li>
													</ul>
												</div>

											</div>
										</div>
									</div>
									<!-- Profile banner END -->';
							};
						} else {
							echo '<!-- Profile banner START -->
								<div class="col-12">
									<div class="card bg-transparent card-body p-0">
										<div class="row d-flex justify-content-between">
											<!-- Profile info -->
											<div class="col d-md-flex justify-content-between align-items-center mt-4">
												<div>
													<h1 class="my-1 fs-4">No login information<i></i></h1>
												</div>
											</div>
										</div>
									</div>
									<!-- Profile banner END -->';
						};
?>

