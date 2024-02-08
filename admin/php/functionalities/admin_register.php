<!-- admin_register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Box Icons [https://boxicons.com/usage]-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Register</title>
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
    <body>
    <!--END OF SIDEBAR-->

      <!--START OF CONTENT-->
      <section id="content">
    <nav>
      <i class='bx bx-menu-alt-left'></i>
      <form action="#">
        <div class="form-input">
          <form action="room.php" method="GET" class="search-form">

          </form>
        </div>
      </form>
    </nav>

    <!-- USER/CUSTODIAN REGISTRATION --> 
<div id="room-form" class="container">
    <h2>User/Custodian Registration</h2>
    <form action="admin_register_process.php" method="post">
        <label for="username">School ID:</label>
        <input type="text" name="username" style="width: 200px;" required>

        <label for="password">Password:</label>
        <input type="password" name="password" style="width: 300px;" required>

        <label for="role">Select Role:</label>
        <select name="role" required>
            <option value="user">User</option>
            <option value="custodian">Custodian</option>
        </select>

        <button type="submit" style = "width: 200px;">Register</button>

        <a href="../pages/admin_manage_user.php" button type="go back">Go Back</button>
    </form>
</body>
</div>
<script src="../public/scripts/script.js"></script>
</html>


