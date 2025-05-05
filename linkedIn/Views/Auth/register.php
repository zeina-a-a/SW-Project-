<?php
session_start();

require_once '../../Services/AddMedia.php';
require_once "../../Models/User.php";
require_once "../../Controllers/AuthController.php";
$errorMsg = "";

if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['isEmployer'])) {
    if (!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && isset($_POST['isEmployer'])) {



        
        $auth = new AuthController();
        $user = new User();
        $user->name = $_POST['name'];
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->email = $_POST['email'];
        $user->isEmployer = $_POST['isEmployer'];

        $mediaPath = AddMedia::upload('profilePhoto');

        if ($mediaPath === false) {
            $errorMsg = "Error in media file upload.";
        } else {
            $user->profilePhoto = $mediaPath ?? NULL;
        }

        if (empty($errorMsg)) {
            if ($auth->register($user)) {
                header("location:login.php");
                exit();
            } else {
                echo 'Error: ' . $_SESSION["errorMsg"];
                $errorMsg = $_SESSION["errorMsg"];
            }
        }
    } else {
        $errorMsg = "Please fill all fields.";
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
    <title>Z.F.R.S Social Network Toolkit</title>
    <link rel="icon" href="../../Assets/images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">

</head>

<body>
    <!--<div class="se-pre-con"></div>-->
    <div class="theme-layout">
        <div class="container-fluid pdng0">
            <div class="row merged">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="land-featurearea">
                        <div class="land-meta">
                            <h1>Z.F.R.S</h1>
                            <p>
                            Z.F.R.S,  More than a profile. It’s your professional story.
                            </p>
                            <div class="friend-logo">
                                <span><img src="../../Assets/images/wink.png" alt=""></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="login-reg-bg">
                        

                        <div class="log-reg-area reg " style="display:block;">
                            <h2 class="log-title">Register</h2>
                            
                            <form method="post" action="register.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" required="required" id="name" name="name" />
                                    <label for="name" class="control-label">Full Name</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input id="username" name="username" type="text" required="required" />
                                    <label class="control-label" for="username">User Name</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" required="required" id="password" name="password" />
                                    <label class="control-label" for="password">Password</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" required="required" id="email" name="email" />
                                    <label class="control-label" for="email">Email</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <label>Are you an Employer?</label>
                                    <div style="display: flex; gap: 20px; margin-top: 8px;">
                                        <label style="display: flex; align-items: center; gap: 5px; font-weight: 500; cursor: pointer;">
                                            <input type="radio" name="isEmployer" value="1" required>
                                            Yes
                                        </label>
                                        <label style="display: flex; align-items: center; gap: 5px; font-weight: 500; cursor: pointer;">
                                            <input type="radio" name="isEmployer" value="0" required>
                                            No
                                        </label>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                    <div  class="form-group">
                                        <label>
                                            <i class="fa fa-image"></i> Upload Photo
                                            <input name="profilePhoto" type="file" style="display: none;">

                                        </label>
                                    </div>

                                </div>


                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" checked="checked" /><i class="check-box"></i>Accept Terms & Conditions ?
                                    </label>
                                </div>
                                <a class="text-primary" href="../Auth/login.php" title="" >Already have an account</a>
                                <div class="submit-btns">
                                    <button class="mtr-btn" type="submit"><span>Register</span></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../../Assets/js/main.min.js"></script>
    <script src="../../Assets/js/script.js"></script>

</body>

</html>