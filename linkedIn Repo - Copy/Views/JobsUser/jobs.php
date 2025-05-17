<?php
require_once '../../Models/Job.php';
require_once '../../Controllers/JobController.php';
require_once '../shared/sessionControl.php';


$jobcontroller = new JobController();
$Jobs = $jobcontroller->getAllJobs();
$errMsg = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Social Media Network</title>
    <link rel="icon" href="../../../Assets/images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="../../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../../Assets/css/style.css">
    <link rel="stylesheet" href="../../../Assets/css/color.css">
    <link rel="stylesheet" href="../../../Assets/css/responsive.css">

</head>
<body>
<div class="theme-layout">
	
<?php require_once '../shared/header.php'; ?>
<section>
	<div class="gap100 pattern">
		<div class="bg-image" style="background-image:url(../../Assets/images/resources/newsletter-bg.jpg); background-repeat: no-repeat;"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="news-letter">
						<h2>Find Your <span>Job</span></h2>
						<span>Shortest Way To Find Your Dream Job</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--<div class="se-pre-con"></div>-->

		
	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<div class="col-lg-3">
								
							</div><!-- sidebar -->
							<div class="col-lg-6">
								<!-- <div class="central-meta">
									<h1>Find Your Job</h1>
								</div> -->
								<!-- add post new box -->

                    <!-- START   START    START    START            -->
				
					
<div class="loadMore">
	<?php if(!empty($Jobs)):?>
	<?php
	foreach($Jobs as $job): 
	?>
	<div class="central-meta item">
		<div class="user-post">
			<div class="friend-info">
				<figure>
					<img src="../../Assets/images/job2.png" alt="">
				</figure>

				<div class="friend-name">
					<ins><a href="#" title=""><?php echo $job['companyName']?></a></ins>
					<span>Published: <?= date("F j, Y", strtotime($job['createdAt'] ?? 'now')) ?></span>
				</div>

				<div class="post-meta">
					<!-- Description / Job details -->
					<div class="description">
					<p><strong>Job Title:</strong> <?= htmlspecialchars($job['jobTitle']) ?></p>
					<p><strong>Company:</strong> <?= htmlspecialchars($job['companyName']) ?></p>
					<p><strong>Employment Type:</strong> <?= htmlspecialchars($job['employmentType']) ?></p>
					<p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
					<p><strong>City:</strong> <?= htmlspecialchars($job['city']) ?></p>
					<p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
					<p><strong>Deadline:</strong> <?= htmlspecialchars($job['applicationDeadline']) ?></p>
					<p><strong>Contact Email:</strong> <?= htmlspecialchars($job['contactEmail']) ?></p>
					<p><strong>Description:</strong> <?= htmlspecialchars($job['jobDescription']) ?></p>
				    </div>

					<!-- Apply button -->
					<div style="margin-top: 15px;">
					
		 			<form action="applyJob.php" method="GET">
                       <input type="hidden" name="jobId" value="<?php echo $job['id']; ?>">
					   <button type="submit" class="mtr-btn"><span>Apply</span></button>
                     </form></div>
					 <div style="margin-top: 15px;">
					 <form action="saveJob.php" method="GET">
                       <input type="hidden" name="jobId" value="<?php echo $job['id']; ?>">
					   <button type="submit" class="mtr-btn"><span>Save</span></button>
                     </form>


					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php endforeach; ?>
	<?php else:?>
		<p>No posts found </p>
	<?php endif;?>	
	
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