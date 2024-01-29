<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Rooms</title>
  <link rel="icon" href='../public/icons/r-icon.svg' type="image/svg">
  <link rel="stylesheet" href='../public/styles/room.css'>
  <link rel="stylesheet" href='../public/styles/custodian_dashboard.css'>
</head>

<body>
  <!--START OF SIDEBAR-->
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
      <li class="active">
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
      <li>
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
  <!--END OF SIDEBAR-->
  <!--START OF CONTENT-->
  <section id="content">
    <nav>
      <i class='bx bx-menu-alt-left'></i>
      <form action="#">
        <div class="form-input">
          <form action="room.php" method="GET" class="search-form">
            <div class="form-input">
              <input type="search" name="search" placeholder="Search for Room or Equipment" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
              <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
          </form>
        </div>
      </form>
    </nav>
    <button type="button" class="add-rooms-button" onclick="window.location.href='../functionalities/add_room.php'">Add Rooms</button>
    
    <?php
    // PHP logic for retrieving and displaying rooms
    if (isset($_SESSION['room_added']) && $_SESSION['room_added']) {
      echo '<div class="notification">Room added successfully!</div>';
      unset($_SESSION['room_added']); // Reset the session variable
    }

    include '../db.php';
    $search = isset($_GET['search']) ? '%' . $mysqli->real_escape_string($_GET['search']) . '%' : '';

    $sqlBase = "SELECT * FROM rooms";
    $whereClause = "";

    if (!empty($search)) {
      $sqlBase .= " WHERE room_no LIKE ? OR room_location LIKE ? OR room_type LIKE ?";
      $whereClause = "sss";
    }

    $stmt = $mysqli->prepare($sqlBase . $whereClause);
    if (!empty($search)) {
      $stmt->bind_param('sss', $search, $search, $search);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      echo '<div class="rooms-data">';
      echo '<div class="order">';
      echo '<div>';
      echo '<h3>Rooms Details</h3>';
      echo '</div>';

      while ($row = $result->fetch_assoc()) {
        echo '<div class="room-container">';
        echo '<div class="room-card" id="results">';
        echo '<div class="room-photo">';
        echo '<img class="room-image" src="' . $row['room_photo'] . '" alt="Room Photo">';
        echo '</div>';
        echo '<div class="room-details">';
        echo '<h4>Room Number: ' . $row['room_no'] . '</h4>';
        echo '<span>';
        echo '<i class=\'bx bxs-map-pin\'></i>';
        echo 'Location: ' . $row['room_location'];
        echo '</span>';
        echo '<p>';
        echo '<i class=\'bx bxs-group\'></i>';
        echo 'Capacity: ' . $row['room_capacity'];
        echo '</p>';
        echo '<br>';
        echo '<p data-date-format="created_at">' . $row['created_at'] . '</p>';
        echo '<p data-date-format="updated_at">' . $row['updated_at'] . '</p>';
        echo '</div>';
        echo '<section class="room-card-buttons">';
        echo '<p id="room-status">' . $row['room_status'] . '</p>';
        echo '<div class="buttons">';
        echo '<button class="edit-room-button" type="button" onclick="window.location.href=\'../functionalities/edit_room.php?id=' . $row['room_id'] . '\'">Edit Room</button>';
        echo '</div>';
        echo '</section>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>';
      echo '</div>';
    } else {
      echo '<div class="room-error-container">';
      echo '<div class="room-error-text">';
      echo '<p>No ' . (!empty($search) ? 'matching ' : '') . 'rooms found</p>';
      echo '</div>';
      echo '</div>';
    }


    $stmt->close();
    $mysqli->close();
    ?>
    <!--END OF CONTENT-->
  </section>
</body>
<script src="../public/scripts/script.js"></script>

</html>