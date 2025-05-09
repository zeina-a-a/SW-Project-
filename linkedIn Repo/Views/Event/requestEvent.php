<?php
require_once '../../Controllers/EventController.php';
require_once '../shared/sessionControl.php';

$eventController = new EventController();
$userId = $_SESSION['userId'];
$error = null;
$success = null;
$justJoinedId = null;

// Handle join request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event = new Event();
    $event->id = (int)$_POST['event_id'];
    $event->userId = $userId;
    $result = $eventController->RequestEvent($event);
    if ($result) {
        // Redirect to clear POST and show success
        header("Location: " . $_SERVER['PHP_SELF'] . "?joined=" . $event->id);
        exit();
    } else {
        // Only set error if not already joined
        $justJoinedId = $event->id;
        $error = "Failed to join the event or you have already joined.";
    }
}

// Get all events
$events = $eventController->getAllEvents();

// Fetch event IDs the user has already joined
$joinedEvents = [];
$joinResult = $eventController->db->select("SELECT eventId FROM eventRequests WHERE userId = $userId");
if ($joinResult) {
    foreach ($joinResult as $row) {
        $joinedEvents[] = $row['eventId'];
    }
}

// Check for success message via GET
if (isset($_GET['joined'])) {
    $success = "You have successfully joined the event!";
    $justJoinedId = (int)$_GET['joined'];
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Winku Social Network Toolkit</title>
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
									<h3>Available Events</h3>
									<?php if ($error && !in_array($justJoinedId, $joinedEvents)): ?>
										<div class="alert alert-danger"><?php echo $error; ?></div>
									<?php endif; ?>
									<?php if ($success): ?>
										<div class="alert alert-success"><?php echo $success; ?></div>
									<?php endif; ?>
									<ul>
										<?php if (!empty($events)): ?>
											<?php foreach ($events as $event): ?>
												<li style="margin-bottom: 20px; border-bottom:1px solid #eee; padding-bottom:10px;">
													<strong><?php echo htmlspecialchars($event['title']); ?></strong><br>
													<?php echo htmlspecialchars($event['description']); ?><br>
													<?php if (in_array($event['id'], $joinedEvents)): ?>
														<span style="color:green;font-weight:bold;">You have joined this event.</span>
													<?php else: ?>
														<form method="post" style="display:inline;">
															<input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
															<button type="submit" class="btn btn-primary">Request to Join</button>
														</form>
													<?php endif; ?>
												</li>
											<?php endforeach; ?>
										<?php else: ?>
											<li>No events available.</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
							<div class="col-lg-3">
								
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