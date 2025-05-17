<?php


require_once '../../Controllers/UserController.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/ShowcaseController.php';
$userId = $_SESSION['userId'];
$userController = new UserController();
$user = $userController->getUser($userId);
$isEmployer = $user->getIsEmployer();
$showcaseController = new ShowcaseController();
$myShowcase = $showcaseController->getShowcasePageByUserId($userId);

if (isset($_POST['action'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'logout') {
        $auth = new AuthController();
        $auth->logout();
    }
}


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
                    <li><a href="../Group/joinGroup.php" title="">Groups</a></li>
                    <!-- <li><a href="../auth/" title="">Jobs</a></li> -->
                    <li><a href="../Event/requestEvent.php" title="">Events</a></li>
                    <li><a href="../Timeline/timeline-friends.php" title="">Connections</a></li>
                </ul>
            </li>
            <li><span>Time Line</span>
                <ul>
                    <li><a href="../Timeline/timeline.php" title="">Profile</a></li>
                    <li><a href="../Group/leaveGroup.php" title="">My Groups</a></li>
                    <li><a href="../Article/Article.php" title="">Articles</a></li>
                    <?php if (!$isEmployer) : ?>
                        <li><a href="../JobsUser/jobs.php" title="">All Jobs</a></li>
                        <li><a href="../JobsUser/myApplications.php" title="">Job Applications</a></li>
                        <li><a href="../JobsUser/mySavedJobs.php" title="">Saved Jobs</a></li>
                    <?php else: ?>
                        <li><a href="../Job/jobsEmp.php" title="">All Jobs</a></li>
                        <li><a href="../Job/myPublished.php" title="">Published Jobs</a></li>

                    <?php endif; ?>



                    <li><a href="../Event/publishEvent.php" title="">Publish Event</a></li>
                    <li><a href="" title="">My Connections</a></li>
                    <li><a href="../premium/upgrade.php" title="">Upgrade Profile</a></li>

                </ul>
            </li>
            <li><span>Account Setting</span>
                <ul>
                    <li><a href="../EditProfile/edit-work-eductation.php" title="">Edit Profile</a></li>
                    <li>
                        <!-- <a href="" title="Log Out">Log Out</a> -->
                        <form method="post">
                            <button type="submit" name="action" value="logout">Logout</button>
                        </form>
                    </li>

                </ul>
            </li>
            </li>
        </ul>
    </nav>
</div><!-- responsive header -->

<div class="topbar stick">
    <div class="logo">
        <a title="" href="index.html"><img src="../../Assets/images/logo.png" alt=""></a>
    </div>

    <div class="top-area">
        <ul class="main-menu">
            <li>
                <a href="#" title="">Home</a>
                <ul>
                    <li><a href="../Home/index.php" title="">Home</a></li>
                    <li><a href="../Group/joinGroup.php" title="">Groups</a></li>
                    <!-- <li><a href="../auth/" title="">Jobs</a></li> -->
                    <li><a href="../Event/requestEvent.php" title="">Events</a></li>
                    <li><a href="../Timeline/timeline-friends.php" title="">Connections</a></li>

                </ul>
            </li>
            <li>
                <a href="#" title="">timeline</a>
                <ul>
                    <li><a href="../Timeline/timeline.php" title="">Profile</a></li>
                    <li><a href="../Group/leaveGroup.php" title="">My Groups</a></li>
                    <li><a href="../Article/Article.php" title="">Articles</a></li>
                    <?php if (!$isEmployer) : ?>
                        <li><a href="../JobsUser/jobs.php" title="">All Jobs</a></li>
                        <li><a href="../JobsUser/myApplications.php" title="">Job Applications</a></li>
                        <li><a href="../JobsUser/mySavedJobs.php" title="">Saved Jobs</a></li>
                    <?php else: ?>
                        <li><a href="../Job/jobsEmp.php" title="">All Jobs</a></li>
                        <li><a href="../Job/myPublished.php" title="">Published Jobs</a></li>

                    <?php endif; ?>



                    <li><a href="../Event/publishEvent.php" title="">Publish Event</a></li>
                    <li><a href="../Timeline/timeline-friends.php" title="">My Connections</a></li>
                    <li><a href="../premium/upgrade.php" title="">Upgrade Profile</a></li>

                </ul>
            </li>
            <li>
                <a href="#" title="">account settings</a>
                <ul>
                    <li><a href="../EditProfile/edit-work-eductation.php" title="">Edit Profile</a></li>
                    <li>
                        <!-- <a href="" title="Log Out">Log Out</a> -->
                        <form method="post">
                            <button style="width: 100%;" type="submit" name="action" value="logout">Logout</button>
                        </form>
                    </li>

                </ul>

            <li>
                <a href="#" title="">Showcase Page</a>
                <ul>
                    <?php if ($myShowcase): ?>
                        <li>
                            <a href="#" title="" onclick="document.getElementById('showcase-modal').style.display='block';return false;">View My Showcase</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="../../Views/Showcase/Createshowcasepage.php" title="">Create Showcase Page</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>

            </li>
        </ul>
        <ul class="">
            <li>
                <a href="../Search/searchView.php"><i class="ti-search"></i> Search</a>
            </li>
        </ul>

        <span class="ti-menu main-menu" data-ripple=""></span>
    </div>
</div>

<?php if ($myShowcase): ?>
    <div id="showcase-modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%); background:#fff; padding:30px; border-radius:10px; box-shadow:0 0 20px #0008; z-index:9999;">
        <h2><?php echo htmlspecialchars($myShowcase->getTitle()); ?></h2>
        <p><strong>Body:</strong> <?php echo htmlspecialchars($myShowcase->getBody()); ?></p>
        <p><strong>Website:</strong> <a href="<?php echo htmlspecialchars($myShowcase->getWebsite()); ?>" target="_blank"><?php echo htmlspecialchars($myShowcase->getWebsite()); ?></a></p>
        <p><strong>Industry:</strong> <?php echo htmlspecialchars($myShowcase->getIndustry()); ?></p>
        <?php if ($myShowcase->getImagePath()): ?>
            <img src="<?php echo htmlspecialchars($myShowcase->getImagePath()); ?>" alt="Logo" style="max-width:200px;max-height:200px;">
        <?php endif; ?>
        <br><br>
        <button onclick="document.getElementById('showcase-modal').style.display='none';">Close</button>
    </div>
<?php endif; ?>