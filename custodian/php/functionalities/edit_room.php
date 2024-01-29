<!-- edit_room.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Box Icons [https://boxicons.com/usage]-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Rooms</title>
  <link rel="icon" href='../public/icons/r-icon.svg' type="image/svg">
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
      <!--Profile Feature-->
      <a href="#" class="profile">
        <i class='bx bxs-user-circle'></i>
      </a>
    </nav>
    </div>
    <?php
    session_start();
    include '../db.php';

    if (isset($_GET['id'])) {
      $roomId = $_GET['id'];

      // Retrieve room information based on the ID
      $sql = "SELECT * FROM rooms WHERE room_id = ?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param('i', $roomId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // The HTML form for editing the room
        echo '<link rel="stylesheet" href="../public/styles/room.css">';
        echo '<div id="room-form" class="container">';
        echo '<form action="edit_room_process.php" method="post" enctype="multipart/form-data">';
        echo '<input type="hidden" name="room_id" value="' . $row['room_id'] . '">';

        echo '<label for="room_no">Room Number:</label>';
        echo '<input type="text" id="room_no" name="room_no" value="' . $row['room_no'] . '" required>';

        echo '<label for="room_location">Room Location:</label>';
        echo '<input type="text" id="room_location" name="room_location" value="' . $row['room_location'] . '" required>';

        echo '<label for="capacity">Capacity:</label>';
        echo '<input type="number" id="room_capacity" name="room_capacity" value="' . $row['room_capacity'] . '" required>';

        echo '<label for="room_status">Availability:</label>';
        echo '<select id="room_status" name="room_status" required>';
        echo '<option value="Available" ' . ($row['room_status'] ? 'selected' : '') . '>Available</option>';
        echo '<option value="Unavailable" ' . (!$row['room_status'] ? 'selected' : '') . '>Unavailable</option>';
        echo '</select>';

        echo '<label for="room_photo">Room Photo:</label>';
        echo '<input type="file" id="room_photo" name="room_photo" accept="image/*">';
        echo '<p class="note">Note: Please upload an image file (JPEG, PNG, GIF).</p>';

        echo '<button type="submit" name="action" value="update" id="update_room">Update Room</button>';
        echo '<button type="submit" name="action" value="delete" id="delete_room">Delete Room</button>';
        echo '</form>';
        echo '</div>';
      } else {
        echo 'Room not found.';
      }

      $stmt->close();
    } else {
      echo 'Room ID not provided.';
    }

    $mysqli->close();
    ?>
  </section>
  </div>
  <!--END OF CONTENT-->
</body>
<script src="../public/scripts/script.js"></script>

</html>