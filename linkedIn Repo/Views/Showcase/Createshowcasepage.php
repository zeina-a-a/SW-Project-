<?php
session_start();
require_once '../../Controllers/ShowcaseController.php';
require_once '../../Models/showcasepage.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save form data to session
    $_SESSION['showcase_form'] = [
        'org_page' => $_POST['org_page'],
        'name' => $_POST['name'],
        'website' => $_POST['website'],
        'industry' => $_POST['industry']
    ];

    $showcasePage = new ShowcasePage();
    $showcasePage->setTitle($_POST['org_page']) ;
    $showcasePage->setBody($_POST['name']) ;
    $showcasePage->setWebsite($_POST['website']) ;
    $showcasePage->setIndustry($_POST['industry']);
    // imagePath will be set by the controller after upload

    $controller = new ShowcaseController();
    $result = $controller->addShowcasePage($showcasePage);

    if ($result) {
        // Clear session data and redirect
        unset($_SESSION['showcase_form']);
        echo "<script>window.location.href='../../Views/home/index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error creating showcase page.');</script>";
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
	<title>Winku Social Network Toolkit</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16"> 
	
    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">

    <style>
        .central-meta .editing-info input.form-control,
        .central-meta .editing-info textarea.form-control {
            border: 2px solid #0a66c2 !important;
            border-radius: 6px;
            box-shadow: none;
        }
        .central-meta .editing-info input.form-control:focus,
        .central-meta .editing-info textarea.form-control:focus {
            outline: none;
            border-color: #004182;
        }
        .central-meta .editing-info .form-group input[type="file"] {
            border: none;
        }
        .central-meta .editing-info .form-group > div[style*="dashed"] {
            border: 2px dashed #0a66c2 !important;
            background: #fff;
            color: #888;
        }
    </style>

</head>
<body>
<?php include '../../Views/shared/header.php'; ?>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<div class="col-lg-6 mx-auto">
								<div class="central-meta">
									<div class="editing-info">
										<form method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label for="org_page">Title*</label>
												<input type="text" id="org_page" name="org_page" class="form-control" placeholder="Title" required
													value="<?php echo isset($_SESSION['showcase_form']['org_page']) ? htmlspecialchars($_SESSION['showcase_form']['org_page']) : ''; ?>">
											</div>
											<div class="form-group">
												<label for="name">Body*</label>
												<input type="text" id="name" name="name" class="form-control" placeholder="Add a body description" required
													value="<?php echo isset($_SESSION['showcase_form']['name']) ? htmlspecialchars($_SESSION['showcase_form']['name']) : ''; ?>">
											</div>
											<div class="form-group">
												<label for="website">Website</label>
												<input type="url" id="website" name="website" class="form-control" placeholder="Begin with http://, https:// or www."
													value="<?php echo isset($_SESSION['showcase_form']['website']) ? htmlspecialchars($_SESSION['showcase_form']['website']) : ''; ?>">
											</div>
											<div class="form-group">
												<label for="industry">Industry*</label>
												<input type="text" id="industry" name="industry" class="form-control" placeholder="ex: Information Services" required
													value="<?php echo isset($_SESSION['showcase_form']['industry']) ? htmlspecialchars($_SESSION['showcase_form']['industry']) : ''; ?>">
											</div>
											<div class="form-group">
												<label for="logo">Logo</label>
												<div style="border: 2px dashed #ccc; border-radius: 8px; padding: 24px; text-align: center; background: #fff; color: #888;">
													<input type="file" id="logo" name="logo" accept="image/png, image/jpeg" style="display:none;" onchange="document.getElementById('logo-filename').textContent = this.files[0]?.name || 'Choose file'">
													<label for="logo" style="cursor:pointer; color:#0a66c2;">
														<div style="font-size:24px; margin-bottom:8px;">&#8682;</div>
														<span id="logo-filename">Choose file</span>
														<div style="font-size:12px; color:#888; margin-top:8px;">Upload to see preview</div>
														<div style="font-size:12px; color:#888;">300 x 300px recommended. JPGs, JPEGs, and PNGs supported.</div>
													</label>
												</div>
											</div>
											<div class="submit-btns" style="margin-top:24px;">
												<button type="submit" class="mtr-btn" style="background:#0a66c2; color:#fff; border:none;">Create Page</button>
											</div>
										</form>
									</div>
								</div>
							</div><!-- centerl meta -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    
    <?php require_once '../shared/footer.php'; ?>

</body>	

</html>