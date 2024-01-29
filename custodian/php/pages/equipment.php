<!-- equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Equipments</title>
  <link rel="icon" href='../public/icons/r-icon.svg' type="image/svg">
  <link rel="stylesheet" href="../public/styles/equipment.css">
  <link rel="stylesheet" href="../public/styles/custodian_dashboard.css">
</head>

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
      <li class="active">
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
    <button type="button" id="add-equipments-button" class="add-equipments-button" onclick="location.href='../functionalities/add_equipment.php'">Add Equipments</button>
    <!-- EQUIPMENTS LIST -->
    <?php
    include '../db.php'; // Include your equipment database connection

    // Check for search query
    $search = isset($_GET['search']) ? '%' . $mysqli->real_escape_string($_GET['search']) . '%' : '';

    // Retrieve and display equipment information with search filter if provided, otherwise show all equipments
    if (!empty($search)) {
      $sql = "SELECT * FROM equipment WHERE equipment_name LIKE ? OR equip_type LIKE ?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param('ss', $search, $search);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        echo '<div class="return-arrow">';
        echo '<a href="your_return_url.php">';
        echo '<i class=\'bx bx-arrow-back\'></i>';
        echo '</a>';
        echo '</div>';
        while ($row = $result->fetch_assoc()) {
          echo '<div class="equipment">';
          echo '<h2>' . $row['equip_name'] . '</h2>';
          echo '<p>Type: ' . $row['equip_type'] . '</p>';
          echo '<p>Quantity: ' . $row['quantity'] . '</p>';
          echo '<p>Status: ' . ($row['equip_status'] ? 'Available' : 'Unavailable') . '</p>';
          echo '<img src="' . $row['equip_photo'] . '" alt="Equipment Photo" class="equipment-photo small-photo">';

          echo '<a href="../functionalities/edit_equipment.php?id=' . $row['id'] . '" class="edit-room-btn">Edit Equipment</a>';
          echo '</div>';
        }
      } else {
        echo '<div class="equip-error-container">';
        echo '<div class="equip-error-text">';
        echo 'No matching equipments found';
        echo '</div>';
        echo '</div>';
      }
    } else {
      $sql = "SELECT * FROM equipments";
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="equipment">';
          echo '<h2>' . $row['equip_name'] . '</h2>';
          echo '<p>Type: ' . $row['equip_type'] . '</p>';
          echo '<p>Status: ' . ($row['equip_status'] ? 'Available' : 'Unavailable') . '</p>';
          echo '<img src="' . $row['equip_photo'] . '" alt="Equipment Photo" class="equipment-photo">';
          echo '<a href="../functionalities/edit_equipment.php?id=' . $row['equip_id'] . '" class="edit-room-btn">Edit Equipment</a>';
          echo '</div>';
        }
      } else {
        echo '<div class="equip-error-container">';
        echo '<div class="equip-error-text">';
        echo 'No equipments available';
        echo '</div>';
        echo '</div>';
      }
    }

    if (isset($stmt)) {
      $stmt->close();
    }

    $mysqli->close();
    ?>
  </section>
  <!-- END OF CONTENT -->
</body>
<script src="../public/scripts/script.js"></script>

</html>