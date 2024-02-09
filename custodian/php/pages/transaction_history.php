<!-- transaction_history.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Box Icons [https://boxicons.com/usage] -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Transaction History</title>
    <link rel="icon" href='../public/icons/r-icon.svg' type="image/svg">
    <link rel="stylesheet" href="../public/styles/custodian_dashboard.css">
</head>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px; /* Adjust the padding as needed */
        text-align: left; /* Align text to the left within cells */
        border-bottom: 1px solid #ddd; /* Add a bottom border to each cell */
    }

    th {
        background-color: #f2f2f2; /* Background color for header cells */
    }
</style>

<body>
    <!-- START OF SIDEBAR -->
    <section id="sidebar">
        <a href="#" alt="Rentify Logo" class="logo-img">
            <img src='../public/icons/r-icon.svg' alt="Rentify Logo" class="logo-img">
        </a>
        <ul class="side-menu top">
            <li>
                <a href="../pages/custodian_dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../pages/room.php">
                    <i class='bx bxs-door-open'></i>
                    <span class="text">Rooms</span>
                </a>
            </li>
            <li>
                <a href="../pages/equipment.php">
                    <i class='bx bxs-cabinet'></i>
                    <span class="text">Equipments</span>
                </a>
            </li>
            <li class="active">
                <a href="../pages/transaction_history.php">
                    <i class='bx bx-clipboard'></i>
                    <span class="text">Transaction History</span>
                </a>
            </li>
            <ul class="side-menu bottom">
                <li>
                    <a href="../custodian_login.php" class="logout">
                        <i class='bx bx-log-out'></i>
                        <span class="text">Logout</span>
                    </a>
                </li>
            </ul>
    </section>
    <!-- END OF SIDEBAR -->

    <!-- START OF CONTENT -->
    <section id="content">
        <nav>
            <i class='bx bx-menu-alt-left'></i>
            <form action="#">
                <div class="form-input">
                    <form action="equipment.php" method="GET" class="search-form">
                        <div class="form-input">
                            <input type="search" name="search" placeholder="Search for Room or Equipment" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                        </div>
                    </form>
                </div>
            </form>
        </nav>
        <!-- TRANSACTION HISTORY -->
        <div class="content-box">
            <?php
            // Include your database connection file
            include '../db.php';

            // Retrieve and display transaction history
            $sql = "SELECT * FROM transactions";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Transaction Number</th>';
                echo '<th>Room No</th>';
                echo '<th>Equip No</th>';
                echo '<th>Resource ID</th>';
                echo '<th>Date</th>';
                echo '<th>Status</th>';
                echo '</tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['transaction_id'] . '</td>';
                    echo '<td>' . $row['room_no'] . '</td>';
                    echo '<td>' . $row['equip_name'] . '</td>';
                    echo '<td>' . $row['resource_type'] . '</td>';
                    echo '<td>' . $row['transaction_date'] . '</td>';
                    echo '<td>' . $row['transaction_status'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo 'No transaction history available';
            }

            $mysqli->close();
            ?>
    </section>
    <!-- END OF CONTENT -->
    </div>
    <!-- END OF TRANSACTION HISTORY -->
    <script src="../../public/scripts/script.js"></script>
</body>