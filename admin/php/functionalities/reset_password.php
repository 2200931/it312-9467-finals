<?php
session_start();

$mysqli = require __DIR__ . "../../db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form submission for resetting password

    // Sanitize and validate input
    $user_id_to_reset = mysqli_real_escape_string($mysqli, $_POST["user_id_to_reset"]);
    $new_password = mysqli_real_escape_string($mysqli, $_POST["new_password"]);

    // Update the user's password in the database (without hashing)
    $update_sql = "UPDATE user_credentials SET password = '{$new_password}' WHERE school_id = '{$user_id_to_reset}'";
    $update_result = $mysqli->query($update_sql);

    if ($update_result) {
        // Password reset successful
        $_SESSION["success_message"] = "Password reset successfully!";
        header("Location: ../pages/admin_manage_user.php");
        exit();
    } else {
        // Password reset failed
        $_SESSION["error_message"] = "Password reset failed. Please try again.";
    }
}

// If not a POST request or after handling the form submission, display the password reset form

$user_id_to_reset = isset($_GET['user_id']) ? mysqli_real_escape_string($mysqli, $_GET['user_id']) : '';

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
    <!-- END OF CONTENT-->

    <!-- Profile Feature -->
    <a href="#" class="profile">
        <i class='bx bxs-user-circle'></i>
    </a>
</nav>
<div id="room-form" class="container">
    <h1>Reset Password</h1>
    <form action="reset_password.php" method="post">
        <input type="hidden" name="user_id_to_reset" value="<?php echo htmlspecialchars($user_id_to_reset); ?>">
        <label for="new_password">New Password:</label>
        <input type="text" name="new_password" required> <!-- Use 'text' for plain text password -->
        <button type="submit">Reset Password</button>
        <a href="../pages/admin_manage_user.php" button type="go back">Go Back</button>
    </form>
</body>
</div>
<script src="../public/scripts/script.js"></script>
</html>
