<?php
session_start();

if (isset($_SESSION["admin_id"])) {
    $mysqli = require __DIR__ . "../../db.php";

    // Retrieve transactions for the admin to monitor
    $sql = "SELECT * FROM transactions ORDER BY transaction_date DESC";
    $result = $mysqli->query($sql);

    $transactions = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Box Icons [https://boxicons.com/usage]-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Custodian Dashboard</title>
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
            <li>
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
            <li class="active">
                <a href="../pages/admin_monitor_transactions.php">
                    <i class='bx bx-clipboard'></i>
                    <span class="text">Transactions</span>
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
            <!--Profile Feature-->
            <a href="#" class="profile">
                <i class='bx bxs-user-circle'></i>
            </a>
        </nav>

        <!-- Transaction History Section -->
        <section id="transaction-history">
            <div class="content-box">
                <h2>Transaction History</h2>
                <?php if (isset($transactions) && !empty($transactions)) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Transaction Number</th>
                                <th>User ID</th>
                                <th>Custodian ID</th>
                                <th>Room ID</th>
                                <th>Equipment ID</th>
                                <th>Transaction Date</th>
                                <th>Status</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Contact Number</th>
                                <th>School Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $transaction) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($transaction['transaction_id']) ?></td>
                                    <td><?= htmlspecialchars($transaction['transaction_num']) ?></td>
                                    <td><?= htmlspecialchars($transaction['user_id']) ?></td>
                                    <td><?= htmlspecialchars($transaction['custodian_id']) ?></td>
                                    <td><?= htmlspecialchars($transaction['room_id']) ?></td>
                                    <td><?= htmlspecialchars($transaction['equip_id']) ?></td>
                                    <td><?= htmlspecialchars($transaction['transaction_date']) ?></td>
                                    <td><?= htmlspecialchars($transaction['transaction_status']) ?></td>
                                    <td><?= htmlspecialchars($transaction['first_name']) ?></td>
                                    <td><?= htmlspecialchars($transaction['last_name']) ?></td>
                                    <td><?= htmlspecialchars($transaction['contact_number']) ?></td>
                                    <td><?= htmlspecialchars($transaction['school_email']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No transactions found.</p>
                <?php endif; ?>
            </div>
        </section>
        <!--END OF CONTENT-->

</body>
<script src="../public/scripts/script.js"></script>

</html>