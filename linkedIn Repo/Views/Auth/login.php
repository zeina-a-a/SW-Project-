<?php
session_start();

require_once "../../Models/user.php";
require_once "../../Controllers/AuthController.php";
$errMsg = "";


if (isset($_POST['email']) && isset($_POST['password'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $user = new User();
        $auth = new AuthController();
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];


        if (!$auth->login($user)) {
            $_SESSION["errMsg"] = "Invalid username or password";
        } else {
            header("location:../Home/index.php");
            exit();
        }
    } else {
        $_SESSION["errMsg"] = "Please fill all fields";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Winku</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">
</head>

<body>
    <div class="theme-layout">
        <div class="container-fluid pdng0">
            <div class="row merged">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="land-featurearea">
                        <div class="land-meta">
                            <h1>Z.F.R.S</h1>
                            <p>Z.F.R.S,  More than a profile. It’s your professional story.</p>
                            <div class="friend-logo">
                                <span><img src="../../Assets/images/wink.png" alt=""></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="login-reg-bg">
                        <div class="log-reg-area sign">
                            <h2 class="log-title">Login</h2>
                            <p>Don’t have an account? <a href="register.php" title="">Register here</a></p>

                            <?php if (!empty($errorMsg)) : ?>
                                <p style="color:red;"><?php echo $errorMsg; ?></p>
                            <?php endif; ?>

                            <form method="post" action="login.php">
                                <div class="form-group">
                                    <input type="text" name="email" required="required" />
                                    <label class="control-label">Email</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" required="required" />
                                    <label class="control-label">Password</label><i class="mtrl-select"></i>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /><i class="check-box"></i>Always Remember Me.
                                    </label>
                                </div>
                                <a href="#" title="" class="forgot-pwd">Forgot Password?</a>
                                <div class="submit-btns">
                                    <div class="submit-btns" style="display: flex; gap: 10px;">
                                        <button class="mtr-btn signin" type="submit"><span>Login</span></button>

                                        <a href="register.php" class="mtr-btn signup" style="display: inline-flex; align-items: center; justify-content: center; height: 40px; padding: 0 20px;">
                                            <span>Register</span>
                                        </a>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Files -->
    <script src="../../Assets/js/main.min.js"></script>
    <script src="../../Assets/js/script.js"></script>

</body>

</html>