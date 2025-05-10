<?php
require_once '../../Controllers/EventController.php';
require_once '../shared/sessionControl.php';

$eventController = new EventController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['description'])) {
    $event = new Event();
    $event->setTitle($_POST['title']);
    $event->setDescription($_POST['description']);
    $event->setPostedBy($_SESSION['userName']);

    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../../uploads/events/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = "uploads/events/" . $fileName; // relative to project root
        }
    }
    $event->setImagePath($imagePath);

    $result = $eventController->PublishEvent($event);
    if ($result !== false) {
        $success = "Event published successfully!";
    } else {
        $error = "Failed to publish event.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Social Media Network</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16"> 
    
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
								
							</div><!-- sidebar -->
							<div class="col-lg-6">
								<div class="central-meta">
									<div class="new-postbox">
										<h3>Publish a New Event</h3>
										<?php if (!empty($success)): ?>
											<div class="alert alert-success"><?php echo $success; ?></div>
										<?php elseif (!empty($error)): ?>
											<div class="alert alert-danger"><?php echo $error; ?></div>
										<?php endif; ?>
										<form method="post" action="" enctype="multipart/form-data">
											<input type="text" name="title" placeholder="Event Title" required class="form-control mb-2">
											<textarea name="description" placeholder="Event Description" required class="form-control mb-2"></textarea>
											
											<label for="image-upload" style="cursor:pointer;">
												🖼️ Add Image
											</label>
											<input id="image-upload" type="file" name="image" accept="image/*" style="display:none;">
											<span id="file-name"></span>
											
											<button type="submit" class="btn btn-primary">Publish Event</button>
										</form>
										<script>
										document.getElementById('image-upload').addEventListener('change', function(){
											document.getElementById('file-name').textContent = this.files[0]?.name || '';
										});
										</script>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

	<?php require_once '../shared/footer.php'; ?>

</body>	

</html>