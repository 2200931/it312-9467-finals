<?php
session_start();

$mysqli = require __DIR__ . "../db.php";

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $custodian_id = mysqli_real_escape_string($mysqli, $_POST["custodian_id"]);
    $password = mysqli_real_escape_string($mysqli, $_POST["password"]);

    // Fetch custodian details from the database based on the provided custodian_id
    $sql = "SELECT * FROM custodian_credentials WHERE custodian_id = '{$custodian_id}'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $custodian = $result->fetch_assoc();

        // Verify the password (without hashing for now)
        if ($password === $custodian["password"]) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION["custodian_id"] = $custodian["custodian_id"];
            header("Location: ../php/pages/custodian_dashboard.php");
            exit();
        } else {
            // Password is incorrect
            $is_invalid = true;
        }
    } else {
        // Custodian not found
        $is_invalid = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custodian Login</title>
    <link rel="icon" href='public/icons/r-icon.svg' type="image/svg">
    <link rel="stylesheet" href="public/styles/custodian_login.css">
</head>

<body>
    <div class="background">
        <img src='public/icons/samcis-bg.JPG' alt="SAMCIS img">
    </div>

    <div class="wrapper">
        <?php if ($is_invalid): ?>
            <div class="error-message">Invalid Login</div>
        <?php endif; ?>

        <div class="form-box login">
            <img src='public/icons/r-icon.svg' alt="Rentify Logo" class="logo-img">
            <h2>Hi there! Welcome back </h2>
            <h4>Log in to Rentify</h4>
            <form method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                    <label>Custodian ID</label>
                    <input type="number" name="custodian_id" id="custodian_id" placeholder="Custodian ID" required>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="forgot">
                    <a href="../php/pages/contact_admin.php">Forgot Password?</a>
                </div>
                <button type="submit" class="login-button">Login</button>
                <div class="login-register">
                    <p> Don't have an account?
                        <a href="../php/pages/contact_admin.php" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Ionics Icons [https://ionic.io/ionicons/usage] -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>