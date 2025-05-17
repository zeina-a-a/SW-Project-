<?php
require_once '../shared/sessionControl.php';
require_once '../../controllers/LanguageController.php';
require_once '../../controllers/UserController.php';

// $userId = $_SESSION['user_id'];
$userController = new UserController();
$user = $userController->getUser($userId);

$languageController = new LanguageController();
$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'create') {
                if ($languageController->addLanguage($userId, $_POST['language_name'])) {
                    $_SESSION['success_message'] = "Language added successfully!";
                    header("Location: edit-Language.php");
                    exit;
                }
            } elseif ($_POST['action'] === 'update') {
                if ($languageController->updateLanguage($_POST['id'], $userId, $_POST['language_name'])) {
                    $_SESSION['success_message'] = "Language updated successfully!";
                    header("Location: edit-Language.php");
                    exit;
                }
            } elseif ($_POST['action'] === 'delete') {
                if ($languageController->deleteLanguage($_POST['id'], $userId)) {
                    $_SESSION['success_message'] = "Language deleted successfully!";
                    header("Location: edit-Language.php");
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

$languages = $languageController->getUserLanguages($userId);
$edit_language = null;
if (isset($_GET['edit'])) {
    $edit_language = $languageController->getLanguageById($_GET['edit'], $userId);
    if (!$edit_language) {
        $error_message = "Language not found or you don't have permission to edit it.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<!-- change all where the user add interest in input , save it to DB , then show them in EX...Table   -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edit your languages" />
    <meta name="keywords" content="" />
	<title>Edit Languages</title>
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
											<h5 class="f-title"><i class="ti-clipboard"></i>Languages</h5>
											
											<?php if (isset($error)): ?>
												<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
											<?php endif; ?>
											
											<?php if (isset($success_message)): ?>
												<div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
											<?php endif; ?>

											<!-- Add New Language Form -->
											<?php if (!$edit_language): ?>
												<form method="post">
													<input type="hidden" name="action" value="create">
													<div class="form-group">
														<label for="language_name">Language</label>
														<input type="text" class="form-control" id="language_name" name="language_name" required>
													</div>
													<button type="submit" class="btn btn-primary">Add Language</button>
												</form>
												<hr>
											<?php endif; ?>

											<!-- Edit Language Form -->
											<?php if ($edit_language): ?>
												<form method="post">
													<input type="hidden" name="action" value="update">
													<input type="hidden" name="id" value="<?php echo $edit_language->getId(); ?>">
													<div class="form-group">
														<label for="edit_language_name">Language</label>
														<input type="text" class="form-control" id="edit_language_name" name="language_name" value="<?php echo htmlspecialchars($edit_language->getLanguageName()); ?>" required>
													</div>
													<button type="submit" class="btn btn-primary">Update Language</button>
													<a href="edit-Language.php" class="btn btn-secondary">Cancel</a>
												</form>
												<hr>
											<?php endif; ?>

											<!-- Display Languages List -->
											<div class="languages-list mt-4">
												<h5>Your Languages</h5>
												<?php if (empty($languages)): ?>
													<p class="text-muted">No languages added yet. Add your first language above.</p>
												<?php else: ?>
													<?php foreach ($languages as $language): ?>
													<div class="language-item card mb-3">
														<div class="card-body">
															<div class="d-flex justify-content-between align-items-start">
																<div>
																	<h6 class="card-title mb-1"><?php echo htmlspecialchars($language['language_name']); ?></h6>
																</div>
																<div>
																	<a href="edit-Language.php?edit=<?php echo $language['id']; ?>" class="btn btn-primary btn-sm mr-2">
																		<i class="fa fa-edit"></i> Edit
																	</a>
																	<form method="post" class="delete-form d-inline">
																		<input type="hidden" name="action" value="delete">
																		<input type="hidden" name="id" value="<?php echo $language['id']; ?>">
																		<button type="submit" class="btn btn-danger btn-sm p-1" onclick="return confirm('Are you sure you want to delete this language?')">
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
							</div>	
						</div>
					</div>
				</div>
			</div>	
		</section>

		<!-- Edit Language Modal -->
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

	<?php require_once '../shared/footer.php'; ?>
		<script>
		function editLanguage(id, language_name) {
			document.getElementById('edit_language_id').value = id;
			document.getElementById('edit_language_name').value = language_name;
			$('#editLanguageModal').modal('show');
		}
		</script>

		
	

</body>	

</html>