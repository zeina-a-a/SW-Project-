<?php

require_once "../../Controllers/GroupController.php";
require_once "../../Models/Group.php";
require_once '../shared/sessionControl.php';

$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['description'])) {
        //$group = new Group();
        $groupController = new GroupController();

        $name = $_POST['name'];
        $description = $_POST['description'];
        $group = new Group($name, $description, $userId);
        //$group->name = $_POST['name'];
        //$group->description = $_POST['description'];
        //$group->adminId = $userId;

        var_dump($_POST);

        if ($groupController->addGroup($group)) {
            header("Location: joinGroup.php?success=1");
            exit();
        } else {
            $errorMsg = isset($_SESSION["errorMsg"]) ? $_SESSION["errorMsg"] : "Error adding group.";
        }
    } else {
        $errorMsg = "Please fill all required fields.";
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
    <link rel="icon" href="../../Assets/images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">

</head>

<body>

    <div class="theme-layout">

        <?php require_once '../shared/header.php'; ?>

        <section>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <div class="col-lg-3">

                                </div>
                                <div class="col-lg-6">
                                    <div class="central-meta">
                                        <div class="new-postbox">

                                            <form action="addGroup.php" method="POST">
                                                <input type="text" name="name" placeholder="Group Name" required
                                                    style="width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 6px; border: 1px solid #ccc;">

                                                <textarea name="description" rows="4" placeholder="Group Description" required
                                                    style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid #ccc; margin-bottom: 20px;"></textarea>

                                                <div class="attachments" style="margin-top: 20px;">
                                                    <ul>
                                                        <li>
                                                            <button type="submit"
                                                                style="padding: 12px 40px; background-color: #007bff; color: white; border: none; border-radius: 6px; font-size: 16px; margin-top: 10px;">
                                                                Add Group
                                                            </button>
                                                            <?php if (isset($_GET['success'])): ?>
                                                                <div style="color: green; margin-bottom: 15px;">Group added successfully!</div>
                                                            <?php endif; ?>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>

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