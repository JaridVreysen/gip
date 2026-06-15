<?php
									$userId = $_SESSION['id'];
									$sql =  "SELECT `id`, `authorId` 
									FROM `fiche` WHERE `authorId` = ?";
									$statement = $conn->prepare($sql);
									$statement->bind_param("s", $userId);
									$statement->execute();
									$result = $statement->get_result();
									$totalFiches = 0;

									while ($row = $result->fetch_assoc()) {
										$totalFiches ++;
								}