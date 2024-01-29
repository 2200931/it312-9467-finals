<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Box Icons [https://boxicons.com/usage]-->
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
    <!--ROOMS LIST-->
    <div class="return-arrow">
      <a href="../pages/room.php">
        <i class='bx bx-arrow-back'></i>
        <span>Return to Rooms<span>
      </a>
    </div>
    <div id="room-form" class="container">
      <form action="../functionalities/add_room_process.php" method="POST" enctype="multipart/form-data">
        <label for="room_no">Room Number:</label>
        <input type="text" placeholder="Ex. D321" name="room_no" id="room_no" required>

        <label for="room_location">Room Location:</label>
        <input type="text" placeholder="3rd Floor" name="room_location" id="room_location" required>

        <label for="capacity">Capacity:</label>
        <input type="number" name="room_capacity" id="room_capacity" style="width: 60px;" min="10" required>

        <label for="room_status">Room Status:</label>
        <select name="room_status" id="room_status" required>
          <option value="Available">Available</option>
          <option value="Unavailable">Unavailable</option>
        </select>

        <label for="room_photo">Room Photo:</label>
        <div class="input-room-image">
          <label for="room_photo">
            <i class='bx bxs-camera'></i>
            <input type="file" accept="image/png, image/jpg, image/jpeg" name="room_photo" id="room_photo" required>
            Select Image
            <span id="image-name"></span>
          </label>
        </div>
        <button class="add-room-button" type="submit">Add Room</button>
      </form>
    </div>
    <script>
      let input = document.getElementById("room_photo");
      let imageName = document.getElementById("image-name")

      input.addEventListener("change", () => {
        let inputImage = document.querySelector("input[type=file]").files[0];

        imageName.innerText = inputImage.name;
      })
    </script>
  </section>

  <script src="../public/scripts/script.js"></script>
</body>

</html>