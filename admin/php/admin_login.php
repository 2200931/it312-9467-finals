<!-- admin_login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href='public/assets/images/r-icon.svg' type="image/svg">
    <link rel="stylesheet" href="public/styles/custodian_login.css">
</head>

<body>
    <div class="background">
        <img src='public/assets/images/samcis-bg.JPG' alt="SAMCIS img">
    </div>
    <div class="wrapper">
        <?php
        // Include login process logic without starting a new session
        include 'admin_login_process.php';

        if ($is_invalid) {
            echo '<script>alert("Invalid Login");</script>';
        }
        ?>

    <div class="form-box login">
            <img src='public/assets/images/r-icon.svg' alt="Rentify Logo" class="logo-img">
            <h2>Hi there! Welcome back </h2>
            <h4>Log in to Rentify</h4>
            <form method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                    <label>Admin ID</label>
                    <input type="number" name="admin_id" id="admin_id" value="<?= htmlspecialchars($_POST["admin_id"] ?? "") ?>"
                        placeholder="Admin ID" required>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <label>Password</label>
                    <input type="admin_password" name="admin_password" placeholder="Password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
                <div class="login-register">
                </div>
            </form>
        </div>
    </div>
    <!--Ionics Icons [https://ionic.io/ionicons/usage]-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>
