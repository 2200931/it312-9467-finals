<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Box Icons [https://boxicons.com/usage]-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Custodian Dashboard</title>
    <link rel="icon" href='../public/icons/r-icon.svg' type="image/svg">
    <link rel="stylesheet" href="../public/styles/custodian_dashboard.css">
</head>

<body>
    <!--START OF SIDEBAR-->
    <section id="sidebar">
        <a href="#" alt="Rentify Logo" class="logo-img">
            <img src='../public/icons/r-icon.svg' alt="Rentify Logo" class="logo-img">
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="custodian_dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="room.php">
                    <i class='bx bxs-door-open'></i>
                    <span class="text">Rooms</span>
                </a>
            </li>
            <li>
                <a href="equipment.php">
                    <i class='bx bxs-cabinet'></i>
                    <span class="text">Equipments</span>
                </a>
            </li>
            <li>
                <a href="transaction_history">
                    <i class='bx bx-clipboard'></i>
                    <span class="text">Transaction History</span>
                </a>
            </li>
            <ul class="side-menu bottom">
                <li>
                    <a href="../custodian_login.php" class="logout" onclick="openLogoutModal()">
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
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search for Room or Equipment">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
        </nav>

        <!-- Greeting Section -->
                <div class="content-box">
            <?php
            session_start();
            if (isset($_SESSION["custodian_id"])) {
                // Fetch the custodian ID from the session
                $custodianID = $_SESSION["custodian_id"];
                echo "<p>Good Morning, Custodian $custodianID!</p>";
            } else {
                echo "<p>Welcome, Custodian!</p>";
            }
            ?>
            <ul>
                <li><a href="room.php">Manage Rooms</a></li>
                <li><a href="equipment.php">Manage Equipments</a></li>
                <li><a href="transaction_history.php">View Transaction History</a></li>
            </ul>
        </div>
        <!--END OF CONTENT-->

</body>
<script src="../public/scripts/script.js"></script>

</html>