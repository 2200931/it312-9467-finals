<?php

session_start();

if (isset($_SESSION["admin_id"])) {

    $mysqli = require __DIR__ . "../../db.php";

    $sql = "SELECT * FROM admin_credentials
            WHERE admin_id = {$_SESSION["admin_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    // Fetch total number of rooms
    $sqlRoomsCount = "SELECT COUNT(*) AS total_rooms FROM rooms";
    $resultRoomsCount = $mysqli->query($sqlRoomsCount);
    $totalRooms = $resultRoomsCount->fetch_assoc()['total_rooms'];

    // Fetch total number of equipments
    $sqlEquipmentsCount = "SELECT COUNT(*) AS total_equipments FROM equipments";
    $resultEquipmentsCount = $mysqli->query($sqlEquipmentsCount);
    $totalEquipments = $resultEquipmentsCount->fetch_assoc()['total_equipments'];
}

// Fetch room details including photo information
$sqlFetchRooms = "SELECT * FROM rooms";
$resultFetchRooms = $mysqli->query($sqlFetchRooms);
$rooms = $resultFetchRooms->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Box Icons [https://boxicons.com/usage]-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin</title>
    <link rel="icon" href='../public/assets/images/r-icon.svg' type="image/svg">
    <link rel="stylesheet" href="../public/styles/admin_dashboard.css">
</head>

<body>
    <!--START OF SIDEBAR-->
    <section id="sidebar">
        <a href="#" alt="Rentify Logo" class="logo-img">
            <img src='../public/assets/images/r-icon.svg' alt="Rentify Logo" class="logo-img">
        </a>
        <ul class="side-menu top">
        <li class="active">
                <a href="../pages/admin_dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
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
            <!--Profile Feature-->
            <a href="#" class="profile">
                <i class='bx bxs-user-circle'></i>
            </a>
        </nav>
        <!-- DASHBOARD GREETING-->
        <div class="content-box">
            <h1>Hello,
                <?= htmlspecialchars($user["admin_id"]) ?>
            </h1>
        </div>

           <!-- Display total number of rooms and equipments -->
    <div class="content-box">
        <h1>Total Rooms</h1>
        <p>Total Rooms: <?= $totalRooms ?></p>
    </div>

    <!-- Display total number of equipments -->
    <div class="content-box">
        <h1>Total Equipments</h1>
        <p>Total Equipments: <?= $totalEquipments ?></p>
    </div>
        <!--END OF CONTENT-->

</body>
<script src="../public/scripts/script.js"></script>

</html>