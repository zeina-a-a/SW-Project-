<?php
require_once __DIR__ . '/../../Controllers/SearchController.php';
session_start();

$searchController = new SearchController();
$searchResults = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $searchResults = $searchController->searchUsers($_POST['username']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>User Search</title>
    <link rel="icon" href="../../assets/images/fav.png" type="image/png" sizes="16x16"> 
    <link rel="stylesheet" href="../../assets/css/main.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/color.css">
    <link rel="stylesheet" href="../../assets/css/responsive.css">
</head>
<body>
<div class="theme-layout">
    <div class="topbar transparent">
        <div class="logo">
            <a title="" href="../../index.php"><img src="../../assets/images/logo2.png" alt=""></a>
        </div>
    </div>
    <section>
        <div class="ext-gap bluesh high-opacity">
            <div class="content-bg-wrap" style="background: url(../../assets/images/resources/animated-bg2.png)"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-banner">
                            <h1>User Search</h1>
                            <nav class="breadcrumb">
                                <a class="breadcrumb-item" href="../Home/index.php">Home</a>
                                <span class="breadcrumb-item active">Search</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="gap100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="forum-warper">
                            <div class="post-filter-sec">
                                <form method="POST" class="filter-form" action="">
                                    <input type="text" name="username" placeholder="Enter username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                                    <button type="submit"><i class="ti-search"></i> Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="forum-open">
                            <h5 class=""><i class="fa fa-users"></i> User Results</h5>
                            <?php if (!empty($searchResults)): ?>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($searchResults as $user): ?>
                                    <tr>
                                        <td class="topic-data">
                                            <img src="<?php echo !empty($user['profilePhoto']) ? htmlspecialchars($user['profilePhoto']) : '../../assets/images/default-profile.png'; ?>" alt="" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                        </td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                                <div class="no-results">
                                    <p>No users found matching your search.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="../../assets/js/main.min.js"></script>
<script src="../../assets/js/script.js"></script>
</body>
</html>