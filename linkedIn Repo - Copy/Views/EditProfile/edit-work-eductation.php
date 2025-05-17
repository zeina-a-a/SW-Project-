<?php
require_once '../shared/sessionControl.php';
require_once '../../Controllers/EducationController.php';
require_once '../../Controllers/UserController.php';

// $userId = $_SESSION['userId'];
$_SESSION['user_id'] = $userId;
$userController = new UserController();
$user = $userController->getUser($userId);

$educationController = new EducationController();

$error = '';
$success = '';
$edit_education = null;

// Handle edit request
if (isset($_GET['edit'])) {
	$edit_education = $educationController->getEducationById($_GET['edit'], $userId);
	if (!$edit_education) {
		$error = "Education not found or you don't have permission to edit it.";
	}
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		if (isset($_POST['action'])) {
			if ($_POST['action'] === 'create') {
				if ($educationController->addEducation(
					$userId,
					$_POST['studying_at'],
					$_POST['from_year'],
					$_POST['to_year'],
					$_POST['description']
				)) {
					$_SESSION['success_message'] = "Education added successfully!";
					header("Location: edit-work-eductation.php");
					exit;
				}
			} elseif ($_POST['action'] === 'update') {
				if ($educationController->updateEducation(
					$_POST['id'],
					$userId,
					$_POST['studying_at'],
					$_POST['from_year'],
					$_POST['to_year'],
					$_POST['description']
				)) {
					$_SESSION['success_message'] = "Education updated successfully!";
					header("Location: edit-work-eductation.php");
					exit;
				}
			} elseif ($_POST['action'] === 'delete') {
				if ($educationController->deleteEducation($_POST['id'], $userId)) {
					$_SESSION['success_message'] = "Education deleted successfully!";
					header("Location: edit-work-eductation.php");
					exit;
				}
			}
		}
	} catch (Exception $e) {
		$error = "Error: " . $e->getMessage();
	}
}

// Get success message from session if it exists
if (isset($_SESSION['success_message'])) {
	$success_message = $_SESSION['success_message'];
	unset($_SESSION['success_message']); // Clear the message after displaying
}

$educations = $educationController->getUserEducation($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Edit your education" />
	<meta name="keywords" content="" />
	<title>Edit Education</title>
	<link rel="icon" href="../../Assets/images/fav.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="../../Assets/css/main.min.css">
	<link rel="stylesheet" href="../../Assets/css/style.css">
	<link rel="stylesheet" href="../../Assets/css/color.css">
	<link rel="stylesheet" href="../../Assets/css/responsive.css">

</head>

<body>
	<!--<div class="se-pre-con"></div>-->
	<div class="theme-layout">

		<?php require_once '../shared/header.php'; ?>
		<!-- topbar -->
		<?php require_once '../shared/timelineHeader.php'; ?>

		<section>
			<div class="gap gray-bg">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="row" id="page-contents">
								<div class="col-lg-3">
									<aside class="sidebar static">
										<div class="widget">
											<h4 class="widget-title">Edit Profile</h4>
											<ul class="naves">
												<li>
													<i class="ti-clipboard"></i>
													<a href="edit-skills.php" title="">Skills</a>
												</li>
												<li>
													<i class="ti-book"></i>
													<a href="edit-work-eductation.php" title="">Education</a>
												</li>
												<li>
													<i class="ti-briefcase"></i>
													<a href="edit-Experience.php" title="">Experience</a>
												</li>
												<li>
													<i class="ti-world"></i>
													<a href="edit-Language.php" title="">Languages</a>
												</li>
											</ul>
										</div>
									</aside>
								</div><!-- sidebar -->
								<div class="col-lg-6">
									<div class="central-meta">
										<div class="editing-info">
											<h5 class="f-title"><i class="ti-info-alt"></i> Edit Education</h5>

											<?php if (isset($error)): ?>
												<div class="text-danger mb-3"><?php echo htmlspecialchars($error); ?></div>
											<?php endif; ?>

											<?php if (isset($success_message)): ?>
												<div class="text-success mb-3"><?php echo htmlspecialchars($success_message); ?></div>
											<?php endif; ?>

											<!-- Add New Education Form -->
											<?php if (!$edit_education): ?>
												<form method="post">
													<input type="hidden" name="action" value="create">
													<div class="form-group">
														<label for="studying_at">School/University</label>
														<input type="text" class="form-control" id="studying_at" name="studying_at" required>
													</div>
													<div class="form-group">
														<label for="from_year">From Year</label>
														<input type="date" class="form-control" id="from_year" name="from_year" required>
													</div>
													<div class="form-group">
														<label for="to_year">To Year</label>
														<input type="date" class="form-control" id="to_year" name="to_year">
													</div>
													<div class="form-group">
														<label for="description">Description</label>
														<textarea class="form-control" id="description" name="description" rows="3"></textarea>
													</div>
													<button type="submit" class="btn btn-primary">Add Education</button>
												</form>
												<hr>
											<?php endif; ?>

											<!-- Edit Education Form -->
											<?php if ($edit_education): ?>
												<form method="post">
													<input type="hidden" name="action" value="update">
													<input type="hidden" name="id" value="<?php echo $edit_education->getId(); ?>">
													<div class="form-group">
														<label for="edit_studying_at">School/University</label>
														<input type="text" class="form-control" id="edit_studying_at" name="studying_at" value="<?php echo htmlspecialchars($edit_education->getStudyingAt()); ?>" required>
													</div>
													<div class="form-group">
														<label for="edit_from_year">From Year</label>
														<input type="date" class="form-control" id="edit_from_year" name="from_year" value="<?php echo htmlspecialchars($edit_education->getFromYear()); ?>" required>
													</div>
													<div class="form-group">
														<label for="edit_to_year">To Year</label>
														<input type="date" class="form-control" id="edit_to_year" name="to_year" value="<?php echo htmlspecialchars($edit_education->getToYear()); ?>">
													</div>
													<div class="form-group">
														<label for="edit_description">Description</label>
														<textarea class="form-control" id="edit_description" name="description" rows="3"><?php echo htmlspecialchars($edit_education->getDescription()); ?></textarea>
													</div>
													<button type="submit" class="btn btn-primary">Update Education</button>
													<a href="edit-work-eductation.php" class="btn btn-secondary">Cancel</a>
												</form>
												<hr>
											<?php endif; ?>

											<!-- Display Education List -->
											<div class="education-list mt-4">
												<h5>Your Education</h5>
												<?php if (empty($educations)): ?>
													<p class="text-muted">No education entries yet. Add your first education entry above.</p>
												<?php else: ?>
													<?php foreach ($educations as $edu): ?>
														<div class="education-item card mb-3">
															<div class="card-body">
																<div class="d-flex justify-content-between align-items-start">
																	<div>
																		<h6 class="card-title mb-1"><?php echo htmlspecialchars($edu->getStudyingAt()); ?></h6>
																		<p class="card-text text-muted mb-1">
																			<?php echo htmlspecialchars($edu->getFromYear()); ?> -
																			<?php echo !empty($edu->getToYear()) ? htmlspecialchars($edu->getToYear()) : 'Present'; ?>
																		</p>
																		<?php if (!empty($edu->getDescription())): ?>
																			<p class="card-text"><?php echo nl2br(htmlspecialchars($edu->getDescription())); ?></p>
																		<?php endif; ?>
																	</div>
																	<div>
																		<a href="edit-work-eductation.php?edit=<?php echo $edu->getId(); ?>" class="btn btn-primary btn-sm mr-2">
																			<i class="fa fa-edit"></i> Edit
																		</a>
																		<form method="post" class="delete-form d-inline">
																			<input type="hidden" name="action" value="delete">
																			<input type="hidden" name="id" value="<?php echo $edu->getId(); ?>">
																			<button type="submit" class="btn btn-danger btn-sm p-1" onclick="return confirm('Are you sure you want to delete this education entry?')">
																				<i class="fa fa-trash"></i> Delete
																			</button>
																		</form>
																	</div>
																</div>
															</div>
														</div>
													<?php endforeach; ?>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div><!-- centerl meta -->
								<!-- sidebar -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Edit Education Modal -->
		<div class="modal fade" id="editExperienceModal" tabindex="-1" role="dialog" aria-labelledby="editExperienceModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editExperienceModalLabel">Edit Experience</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post" id="editExperienceForm" action="">
							<input type="hidden" name="action" value="update">
							<input type="hidden" name="id" id="edit_experience_id">
							<div class="form-group">
								<label for="edit_company_name">Company/Organization</label>
								<input type="text" class="form-control" id="edit_company_name" name="company_name" required>
							</div>
							<div class="form-group">
								<label for="edit_from_year">From Year</label>
								<input type="date" class="form-control" id="edit_from_year" name="from_year" required>
							</div>
							<div class="form-group">
								<label for="edit_to_year">To Year</label>
								<input type="date" class="form-control" id="edit_to_year" name="to_year">
							</div>
							<div class="form-group">
								<label for="edit_description">Description</label>
								<textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
							</div>
							<button type="submit" class="btn btn-primary">Update Experience</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script src="../../Assets/js/main.min.js"></script>
		<script src="../../Assets/js/script.js"></script>
		<script src="../../Assets/js/map-init.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
		<script>
			$(document).ready(function() {
				// Handle edit button click
				$('.edit-btn').on('click', function() {
					var id = $(this).data('id');
					var studying_at = $(this).data('studying');
					var from_year = $(this).data('from');
					var to_year = $(this).data('to');
					var description = $(this).data('description');

					$('#edit_education_id').val(id);
					$('#edit_studying_at').val(studying_at);
					$('#edit_from_year').val(from_year);
					$('#edit_to_year').val(to_year);
					$('#edit_description').val(description);
					$('#editEducationModal').modal('show');
				});

				// Handle delete confirmation
				$('.delete-form').on('submit', function(e) {
					if (!confirm('Are you sure you want to delete this education entry?')) {
						e.preventDefault();
					}
				});
			});
		</script>

		<?php require_once '../shared/footer.php'; ?>

</body>

</html>