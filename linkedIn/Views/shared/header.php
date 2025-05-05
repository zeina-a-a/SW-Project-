<?php


require_once '../../Controllers/UserController.php';
$userId = $_SESSION['userId'];
$userController = new UserController();
$user = $userController->getUser($userId);
$isEmployer = $user->isEmployer;

?>


        <div class="responsive-header">
            <div class="mh-head first Sticky">
                <span class="mh-btns-left">
                    <a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
                </span>
                <span class="mh-text">
                    <a href="../Home/index.php" title=""><img src="../../Assets/images/logo2.png" alt=""></a>
                </span>
                <span class="mh-btns-right">
                    <a class="fa fa-sliders" href="#shoppingbag"></a>
                </span>
            </div>
            <div class="mh-head second">
                <form class="mh-form">
                    <input placeholder="search" />
                    <a href="#/" class="fa fa-search"></a>
                </form>
            </div>
            <nav id="menu" class="res-menu">
                <ul>
                    <li><span>Home</span>
                        <ul>
                            <li><a href="../Home/index.php" title="">Home</a></li>
                            <li><a href="../auth/landing.php" title="">Groups</a></li>
                            <li><a href="../auth/" title="">Jobs</a></li>
                            <li><a href="../auth/" title="">Events</a></li>
                            <li><a href="../auth/" title="">Connections</a></li>
                        </ul>
                    </li>
                    <li><span>Time Line</span>
                        <ul>
                            <li><a href="../Timeline/timeline.php" title="">Profile</a></li>
                            <li><a href="../auth/landing.php" title="">My Groups</a></li>
                            <li><a href="../auth/landing.php" title="">Articles</a></li>
                            <?php if (!$isEmployer) : ?>
                                <li><a href="../JobsUser/jobs.php" title="">All Jobs</a></li>
                                <li><a href="../JobsUser/myApplications.php" title="">Job Applications</a></li>
                                <li><a href="../JobsUser/mySavedJobs.php" title="">Saved Jobs</a></li>
                            <?php else: ?>
                                <li><a href="../Job/jobsEmp.php" title="">All Jobs</a></li>
                                <li><a href="../Job/myPublished.php" title="">Published Jobs</a></li>
                                
                            <?php endif; ?>

                            

                            <li><a href="../auth/" title="">Events</a></li>
                            <li><a href="../auth/" title="">My Connections</a></li>
                            <li><a href="../premium/upgrade.php" title="">Upgrade Profile</a></li>

                        </ul>
                    </li>
                    <li><span>Account Setting</span>
                        <ul>
                            <li><a href="edit-account-setting.html" title="">Edit Personal Info</a></li>
                            <li><a href="edit-interest.html" title="">Edit Account</a></li>
                            <li><a href="edit-password.html" title="">Log Out</a></li>

                        </ul>
                    </li>
                    </li>
                    <li><span>More pages</span>
                        <ul>
                            <li><a href="404-2.html" title="">404 error page</a></li>
                            <li><a href="about.html" title="">about</a></li>
                            <li><a href="contact.html" title="">contact</a></li>

                        </ul>
                    </li>
                </ul>
            </nav>
        </div><!-- responsive header -->

        <div class="topbar stick">
            <div class="logo">
                <a title="" href="index.html"><img src="../images/logo.png" alt=""></a>
            </div>

            <div class="top-area">
                <ul class="main-menu">
                    <li>
                        <a href="#" title="">Home</a>
                        <ul>
                            <li><a href="../post/index.php" title="">Home</a></li>
                            <li><a href="../auth/landing.php" title="">Groups</a></li>
                            <li><a href="../auth/" title="">Jobs</a></li>
                            <li><a href="../auth/" title="">Events</a></li>
                            <li><a href="../auth/" title="">Connections</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" title="">timeline</a>
                        <ul>
                            <li><a href="../Timeline/timeline.php" title="">Profile</a></li>
                            <li><a href="" title="">My Groups</a></li>
                            <li><a href="" title="">Articles</a></li>
                            
                            <?php if (!$isEmployer) : ?>
                                <li><a href="../JobsUser/jobs.php" title="">All Jobs</a></li>
                                <li><a href="../JobsUser/myApplications.php" title="">Job Applications</a></li>
                                <li><a href="../JobsUser/mySavedJobs.php" title="">Saved Jobs</a></li>
                            <?php else: ?>
                                <li><a href="../Job/jobsEmp.php" title="">All Jobs</a></li>
                                <li><a href="../Job/myPublished.php" title="">Published Jobs</a></li>
                                
                            <?php endif; ?>

                            <li><a href="../auth/" title="">Events</a></li>
                            <li><a href="../auth/" title="">My Connections</a></li>
                            <li><a href="../premium/upgrade.php" title="">Upgrade Profile</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" title="">account settings</a>
                        <ul>
                            <li><a href="edit-account-setting.html" title="">Edit Personal Info</a></li>
                            <li><a href="edit-interest.html" title="">Edit Account</a></li>
                            <li><a href="edit-password.html" title="">Log Out</a></li>

                        </ul>
                    </li>

                    <li>
                        <a href="#" title="">more pages</a>
                        <ul>
                            <li><a href="404-2.html" title="">404 error page</a></li>
                            <li><a href="about.html" title="">about</a></li>
                            <li><a href="contact.html" title="">contact</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="setting-area">
                    <li>
                        <a href="#" title="Home" data-ripple=""><i class="ti-search"></i></a>
                        <div class="searched">
                            <form method="post" class="form-search">
                                <input type="text" placeholder="Search Friend">
                                <button data-ripple><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </li>
                </ul>
                <span class="ti-menu main-menu" data-ripple=""></span>
            </div>
        </div>
