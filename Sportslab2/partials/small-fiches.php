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
													<button class="btn btn-sm btn-success-soft btn-round mb-0" onclick="vieuwFiche(\''.$id.'\')"><i class="fas fa-fw fa-eye"></i></button>
													<button class="btn btn-sm btn-danger-soft btn-round mb-0" onclick="deleteFiche(\''.$id.'\')"><i class="fas fa-fw fa-times"></i></button>
												</td>
											</tr>
										</tbody>
										<!-- Table body END -->';
                                    };