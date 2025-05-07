<?php

require_once '../../Models/GroupMember.php';
require_once '../../Models/Group.php';
require_once  '../../Controllers/GroupController.php';
require_once '../shared/sessionControl.php';

$groupController = new GroupController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['groupId'])) {
    $group = new GroupMember();
    $group->groupId = $_POST['groupId'];
    $group->userId = $userId; 

    if ($groupController->join($group)) {
        header("Location: joinGroup.php?joined=1");
        exit();
    } else {
        $errorMsg = isset($_SESSION["errorMsg"]) ? $_SESSION["errorMsg"] : "Error adding group.";
    }
} else {
    $errorMsg = "Please fill all required fields.";
}

$errMsg = "";
$groups = $groupController->getAllGroups($userId);


?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Join Groups</title>
    <link rel="icon" href="../../Assets/images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">

</head>

<body>
    <!--<div class="se-pre-con"></div>-->
    <div class="theme-layout">

        
		<?php require_once '../shared/header.php'; ?>
		

        <section>
            <div class="page-header">
                <div class="header-inner">
                    <h2>your Searched Groups</h2>
                    <nav class="breadcrumb">
                        <a href="index-2.html" class="breadcrumb-item"><i class="fa fa-home"></i></a>
                        <span class="breadcrumb-item active">Groups</span>
                    </nav>
                </div>
            </div>
        </section>

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

                                        <form action="addGroup.php" method="POST">
                                            <button type="submit" class="mtr-butn"
                                                style="font-size: 18px; color: white; padding: 12px 228px; border: none; border-radius: 6px;">
                                                Add Group
                                            </button>
                                        </form>
                                        <div class="groups">
                                            <span><i class="fa fa-users"></i> Groups</span>
                                        </div>
                                        <ul class="nearby-contct">

                                            <?php if (!empty($groups)): ?>
                                                <?php foreach ($groups as $group): ?>

                                                    <li>
                                                        <div class="nearly-pepls">
                                                            
                                                            <div class="pepl-info">
                                                                <h4><a href="time-line.html" title=""><?php echo $group['name'] ?></a></h4>
                                                                <br>
                                                                <h11><a href="time-line.html" title=""><?php echo $group['description'] ?></a></h11>
                                                                <!--<span>public group</span>The Social Media Marketing Group-->
                                                                <form action="joinGroup.php" method="POST">
                                                                    <input type="hidden" name="groupId" value="<?php echo $group["groupId"] ?>">
                                                                    <button type="submit" class="mtr-butn">Join Group</button>
                                                                    <!--  -->
                                                                    <span class="tf-icons bx bx-trash"></span>

                                                                </form>


                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?><p>No Groups Found. </p> <?php endif; ?>

                                        </ul>
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