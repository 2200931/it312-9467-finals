<?php
session_start();

if (isset($_SESSION["admin_id"])) {
    $mysqli = require __DIR__ . "../../db.php";

    // Fetch admin details
    $sql = "SELECT * FROM admin_credentials WHERE admin_id = {$_SESSION["admin_id"]}";
    $result = $mysqli->query($sql);
    $admin = $result->fetch_assoc();

    // Fetch user accounts
    $sqlUsers = "SELECT * FROM user_credentials";
    $resultUsers = $mysqli->query($sqlUsers);
    $users = $resultUsers->fetch_all(MYSQLI_ASSOC);

    // Fetch custodian accounts
    $sqlCustodians = "SELECT * FROM custodian_credentials";
    $resultCustodians = $mysqli->query($sqlCustodians);
    $custodians = $resultCustodians->fetch_all(MYSQLI_ASSOC);

    // Handle password reset form submission for users
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reset_password_user"])) {
        $user_id_to_reset = mysqli_real_escape_string($mysqli, $_POST["reset_user_id"]);
    
        // Redirect to the password reset page with the user ID as a parameter
        header("Location: ../functionalities/reset_password.php?user_id=" . urlencode($user_id_to_reset));
        exit();
    }

    // Handle password reset form submission for custodians
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reset_password_custodian"])) {
        $custodian_id_to_reset = mysqli_real_escape_string($mysqli, $_POST["reset_custodian_id"]);

        // Redirect to the password reset page with the custodian ID as a parameter
        header("Location: ../functionalities/reset_password.php?type=custodian&custodian_id=" . urlencode($custodian_id_to_reset));
        exit();
    }

    // Handle user deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_user"])) {
    $user_id_to_delete = mysqli_real_escape_string($mysqli, $_POST["delete_user_id"]);

    // Perform user deletion logic here
    $sqlDeleteUser = "DELETE FROM user_credentials WHERE school_id = '{$user_id_to_delete}'";
    $resultDeleteUser = $mysqli->query($sqlDeleteUser);

    if ($resultDeleteUser) {
        // Successfully deleted the user
        // You can add additional logic or messages here if needed
    } else {
        // Error occurred while deleting the user
        // You can handle the error or log it for debugging
        echo "Error: " . $mysqli->error;
    }

    // Redirect to admin_manage_user.php after deletion
    header("Location: admin_manage_user.php");
    exit();
}

 // Handle custodian deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_custodian"])) {
    $custodian_id_to_delete = mysqli_real_escape_string($mysqli, $_POST["delete_custodian_id"]);

    // Perform custodian deletion logic here
    $sqlDeleteCustodian = "DELETE FROM custodian_credentials WHERE custodian_id = '{$custodian_id_to_delete}'";
    $resultDeleteCustodian = $mysqli->query($sqlDeleteCustodian);

    if ($resultDeleteCustodian) {
        // Successfully deleted the custodian
        // You can add additional logic or messages here if needed
    } else {
        // Error occurred while deleting the custodian
        // You can handle the error or log it for debugging
        echo "Error: " . $mysqli->error;
    }

    // Redirect to admin_manage_user.php after deletion
    header("Location: admin_manage_user.php");
    exit();
}

// Handle search query
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["search_id"])) {
    $searchQuery = mysqli_real_escape_string($mysqli, $_GET["search_id"]);

    // Perform user search
    $sqlUserSearch = "SELECT * FROM user_credentials WHERE school_id LIKE '%{$searchQuery}%'";
    $resultUserSearch = $mysqli->query($sqlUserSearch);
    $users = $resultUserSearch->fetch_all(MYSQLI_ASSOC);

    // Perform custodian search
    $sqlCustodianSearch = "SELECT * FROM custodian_credentials WHERE custodian_id LIKE '%{$searchQuery}%'";
    $resultCustodianSearch = $mysqli->query($sqlCustodianSearch);
    $custodians = $resultCustodianSearch->fetch_all(MYSQLI_ASSOC);
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Box Icons [https://boxicons.com/usage]-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href='../public/assets/images/r-icon.svg' type="image/svg">
    <link rel="stylesheet" href='../public/styles/room.css'>
    <link rel="stylesheet" href="../public/styles/admin_dashboard.css">
    <link rel="stylesheet" href='../public/styles/custodian_dashboard.css'>
</head>

<body>
    <!--START OF SIDEBAR-->
    <section id="sidebar">
        <a href="#" alt="Rentify Logo" class="logo-img">
            <img src='../public/assets/images/r-icon.svg' alt="Rentify Logo" class="logo-img">
        </a>
        <ul class="side-menu top">
        <li>
                <a href="../pages/admin_dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="../pages/admin_manage_user.php">
                    <i class='bx bxs-door-open'></i>
                    <span class="text">Manage Users</span>
                </a>
            </li>
            <ul class="side-menu bottom">
                <li>
                    <a href="../../php/admin_login.php" class="logout" onclick="openLogoutModal()">
                        <i class='bx bx-log-out'></i>
                        <span class="text">Logout</span>
                    </a>
                </li>
            </ul>
    </section>
    <!--END OF SIDEBAR-->
    <!--START OF CONTENT-->
    <section id="content">
    <nav>
    <i class='bx bx-menu-alt-left'></i>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
        <div class="form-input">
            <input type="search" name="search_id" placeholder="Search for User or Custodian">
            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
    </form>
    <!-- Profile Feature -->
    <a href="#" class="profile">
        <i class='bx bxs-user-circle'></i>
    </a>
</nav>


<!-- MANAGE USERS SECTION -->
<div class="content-box">
<a href="../functionalities/admin_register.php" class="register-button">
            <i class='bx bx-user-plus'></i>
            <span class="text">Register User/Custodian</span>
        </a>
    <h1>Manage Users</h1>

    <!-- Display user accounts in a table -->
    <table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <!-- Check if "school_id" key exists in the $user array -->
                <?php if (isset($user["school_id"])) : ?>
                    <td><?= htmlspecialchars($user["school_id"]) ?></td>
                <?php else : ?>
                    <td>Undefined</td>
                <?php endif; ?>
                <td>
                    <!-- Reset Password Form -->
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="hidden" name="reset_user_id" value="<?= isset($user['school_id']) ? $user['school_id'] : '' ?>">
                        <button type="submit" name="reset_password_user">Reset Password</button>
                    </form>

                    <!-- Delete User Form -->
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return confirmDeleteUser();">
                        <input type="hidden" name="delete_user_id" value="<?= isset($user['school_id']) ? $user['school_id'] : '' ?>">
                        <button type="submit" name="delete_user">Delete User</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<!-- MANAGE CUSTODIANS SECTION -->
<div class="content-box">
    <h1>Manage Custodians</h1>

    <!-- Display custodian accounts in a table -->
    <table>
        <thead>
            <tr>
                <th>Custodian ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($custodians as $custodian) : ?>
                <tr>
                    <td><?= htmlspecialchars($custodian["custodian_id"]) ?></td>
                    <td>
                        <!-- Reset Custodian Password Form -->
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="hidden" name="reset_custodian_id" value="<?= $custodian['custodian_id'] ?>">
                            <button type="submit" name="reset_password_custodian">Reset Password</button>
                        </form>

                        <!-- Delete Custodian Form -->
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return confirmDeleteCustodian();">
                            <input type="hidden" name="delete_custodian_id" value="<?= $custodian['custodian_id'] ?>">
                            <button type="submit" name="delete_custodian">Delete Custodian</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
        <!-- END OF CONTENT -->
    </section>
        <!--END OF CONTENT-->

</body>

<script>
    function confirmDeleteUser() {
        var confirmation = confirm('Are you sure you want to delete this user?');
        if (confirmation) {
            // Redirect to admin_manage_user.php after confirmation
            window.location.href = 'admin_manage_user.php';
        }
        return confirmation;
    }
</script>

<script>
    function confirmDeleteCustodian() {
        var confirmation = confirm('Are you sure you want to delete this custodian?');
        if (confirmation) {
            // Redirect to admin_manage_user.php after confirmation
            window.location.href = 'admin_manage_user.php';
        }
        return confirmation;
    }
</script>

<script src="../public/scripts/script.js"></script>

</html>