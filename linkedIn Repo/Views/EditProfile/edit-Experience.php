<?php
require_once '../shared/sessionControl.php';
require_once '../../Controllers/ExperienceController.php';
require_once '../../Controllers/UserController.php';

$userId = $_SESSION['userId'];
$userController = new UserController();
$user = $userController->getUser($userId);

$experienceController = new ExperienceController();
$edit_experience = null;

// Handle edit request
if (isset($_GET['edit'])) {
    $edit_experience = $experienceController->getExperienceById($_GET['edit'], $userId);
    if (!$edit_experience) {
        $error = "Experience not found or you don't have permission to edit it.";
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'create') {
                if ($experienceController->addExperience(
                    $userId,
                    $_POST['work_at'],
                    $_POST['from_year'],
                    $_POST['to_year'],
                    $_POST['description']
                )) {
                    $_SESSION['success_message'] = "Experience added successfully!";
                    header("Location: edit-Experience.php");
                    exit;
                }
            } elseif ($_POST['action'] === 'update') {
                if ($experienceController->updateExperience(
                    $_POST['id'],
                    $userId,
                    $_POST['work_at'],
                    $_POST['from_year'],
                    $_POST['to_year'],
                    $_POST['description']
                )) {
                    $_SESSION['success_message'] = "Experience updated successfully!";
                    header("Location: edit-Experience.php");
                    exit;
                }
            } elseif ($_POST['action'] === 'delete') {
                if ($experienceController->deleteExperience($_POST['id'], $userId)) {
                    $_SESSION['success_message'] = "Experience deleted successfully!";
                    header("Location: edit-Experience.php");
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

// Get all experiences for the user
$experiences = $experienceController->getUserExperience($userId);

// Debug output
echo "<!-- Debug: Number of experiences: " . count($experiences) . " -->";
if (!empty($experiences)) {
    echo "<!-- Debug: First experience: " . print_r($experiences[0], true) . " -->";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edit your work experience">
    <meta name="keywords" content="" />
	<title>Edit Experience - Profile</title>
    <link rel="icon" href="../../Assets/images/fav.png" type="../../Assets/image/png" sizes="16x16"> 
    
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
							</div>
							<div class="col-lg-6">
								<div class="central-meta">
									<div class="editing-interest">
										<h5 class="f-title"><i class="ti-clipboard"></i>Work Experience</h5>
										
										<?php if (isset($error)): ?>
											<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
										<?php endif; ?>

										<?php if (isset($success_message)): ?>
											<div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
										<?php endif; ?>

										<!-- Add New Experience Form -->
										<?php if (!$edit_experience): ?>
											<form method="post">
												<input type="hidden" name="action" value="create">
												<div class="form-group">
													<label for="work_at">Work at</label>
													<input type="text" class="form-control" id="work_at" name="work_at" required>
												</div>
												<div class="form-group">
													<label for="from_year">From Year</label>
													<input type="number" class="form-control" id="from_year" name="from_year" min="1900" max="2099" required>
												</div>
												<div class="form-group">
													<label for="to_year">To Year</label>
													<input type="number" class="form-control" id="to_year" name="to_year" min="1900" max="2099">
													
												</div>
												<div class="form-group">
													<label for="description">Description</label>
													<textarea class="form-control" id="description" name="description" rows="3"></textarea>
												</div>
												<button type="submit" class="btn btn-primary">Add Experience</button>
											</form>
											<hr>
										<?php endif; ?>

										<!-- Edit Experience Form -->
										<?php if ($edit_experience): ?>
											<form method="post">
												<input type="hidden" name="action" value="update">
												<input type="hidden" name="id" value="<?php echo $edit_experience->getId(); ?>">
												<div class="form-group">
													<label for="edit_work_at">Work at</label>
													<input type="text" class="form-control" id="edit_work_at" name="work_at" value="<?php echo htmlspecialchars($edit_experience->getWorkAt()); ?>" required>
												</div>
												<div class="form-group">
													<label for="edit_from_year">From Year</label>
													<input type="number" class="form-control" id="edit_from_year" name="from_year" min="1900" max="2099" value="<?php echo htmlspecialchars($edit_experience->getFromYear()); ?>" required>
												</div>
												<div class="form-group">
													<label for="edit_to_year">To Year</label>
													<input type="number" class="form-control" id="edit_to_year" name="to_year" min="1900" max="2099" value="<?php echo htmlspecialchars($edit_experience->getToYear()); ?>">
												</div>
												<div class="form-group">
													<label for="edit_description">Description</label>
													<textarea class="form-control" id="edit_description" name="description" rows="3"><?php echo htmlspecialchars($edit_experience->getDescription()); ?></textarea>
												</div>
												<button type="submit" class="btn btn-primary">Update Experience</button>
												<a href="edit-Experience.php" class="btn btn-secondary">Cancel</a>
											</form>
											<hr>
										<?php endif; ?>

										<!-- Display Experience List -->
										<div class="experience-list mt-4">
											<h5>Your Work Experience</h5>
											<?php if (empty($experiences)): ?>
												<p class="text-muted">No work experience added yet. Add your first experience above.</p>
											<?php else: ?>
												<?php foreach ($experiences as $experience): ?>
												<div class="experience-item card mb-3">
													<div class="card-body">
														<div class="d-flex justify-content-between align-items-start">
															<div>
																<h6 class="card-title mb-1"><?php echo htmlspecialchars($experience->getWorkAt()); ?></h6>
																<p class="card-text text-muted">
																	<?php echo htmlspecialchars($experience->getFromYear()); ?> - 
																	<?php echo !empty($experience->getToYear()) ? htmlspecialchars($experience->getToYear()) : 'Present'; ?>
																</p>
																<?php if (!empty($experience->getDescription())): ?>
																	<p class="card-text"><?php echo nl2br(htmlspecialchars($experience->getDescription())); ?></p>
																<?php endif; ?>
															</div>
															<div>
																<a href="edit-Experience.php?edit=<?php echo $experience->getId(); ?>" class="btn btn-primary btn-sm mr-2">
																	<i class="fa fa-edit"></i> Edit
																</a>
																<form method="post" class="delete-form d-inline">
																	<input type="hidden" name="action" value="delete">
																	<input type="hidden" name="id" value="<?php echo $experience->getId(); ?>">
																	<button type="submit" class="btn btn-danger btn-sm p-1" onclick="return confirm('Are you sure you want to delete this experience?')">
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</section>

	<!-- Edit Experience Modal -->
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
							<input type="text" class="form-control" id="edit_company_name" name="work_at" required>
						</div>
						<div class="form-group">
							<label for="edit_from_year">From Year</label>
							<input type="number" class="form-control" id="edit_from_year" name="from_year" required>
						</div>
						<div class="form-group">
							<label for="edit_to_year">To Year</label>
							<input type="number" class="form-control" id="edit_to_year" name="to_year">
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


	<?php require_once '../shared/footer.php'; ?>
	<script>
	// Form validation
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();

	function editExperience(id, work_at, from_year, to_year, description) {
		document.getElementById('edit_experience_id').value = id;
		document.getElementById('edit_company_name').value = work_at;
		document.getElementById('edit_from_year').value = from_year;
		document.getElementById('edit_to_year').value = to_year || '';
		document.getElementById('edit_description').value = description || '';
		$('#editExperienceModal').modal('show');
	}
	</script>

</body>	

</html>