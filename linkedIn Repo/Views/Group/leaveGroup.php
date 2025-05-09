<?php

require_once  '../../Controllers/GroupController.php';
require_once '../../Models/GroupMember.php';
require_once '../../Models/Group.php';
require_once '../shared/sessionControl.php';

$groupController = new GroupController();
$groups = $groupController->getMyGroups($userId);

if (isset($_POST['groupId'])) {
    $groupId = $_POST['groupId'];

    $groupController = new GroupController();
    if ($groupController->leaveGroup($groupId, $userId)) {
        header("Location: leaveGroup.php?left=1");
        exit();
    } else {
        echo "Error leaving the group.";
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
    <link rel="icon" href="../../Assets/images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">

</head>

<body>
    <div class="theme-layout">

        <?php require_once '../shared/header.php'; ?>
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
                                        <div class="groups">
                                            <span><i class="fa fa-users"></i> joined Groups</span>
                                        </div>

                                        <?php if (!empty($groups)): ?>
                                            <?php foreach ($groups as $group): ?>

                                                <li>
                                                    <div class="nearly-pepls">

                                                        <div class="pepl-info">
                                                            <h4><a href="time-line.html" title=""><?php echo $group['name'] ?></a></h4>
                                                            <br>
                                                            <h11><a href="time-line.html" title=""><?php echo $group['description'] ?></a></h11>
                                                            <!--<span>public group</span>The Social Media Marketing Group-->
                                                            <form action="leaveGroup.php" method="POST">
                                                                <input type="hidden" name="groupId" value="<?php echo $group["groupId"] ?>">
                                                                <button type="submit" class="add-butn">Leave Group</button>

                                                                <span class="tf-icons bx bx-trash"></span>

                                                            </form>


                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?><p>No Groups Found. </p> <?php endif; ?>

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