<!-- add_equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Box Icons [https://boxicons.com/usage]-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Equipments</title>
  <link rel="icon" href='../public/icons/r-icon.svg' type="image/svg">
  <link rel="stylesheet" href='../public/styles/equipment.css'>
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
  <!--END OF SIDEBAR-->
  <!--START OF CONTENT-->
  <section id="content">
    <nav>
      <i class='bx bx-menu-alt-left'></i>
    </nav>
    <!--EQUIPMENTS LIST-->
    <div class="return-arrow">
      <a href="../pages/equipment.php">
        <i class='bx bx-arrow-back'></i>
        <span>Return to Equipments<span>
      </a>
    </div>
    <div id="equipment-form" class="container">
    <form action="../functionalities/add_equipment_process.php" method="POST" enctype="multipart/form-data">
        <label for="equipment_name">Equipment Name:</label>
        <input type="text" placeholder="Ex. HDMI Cable" name="equip_name" id="equip_name" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="equip_qty" id="equip_qty" style="width: 60px;" min="0" required>

        <label for="equip_type">Equipment Type:</label>
        <select name="equip_type" id="equip_type" required>
          <option value="Visual">Visual</option>
          <option value="Audio">Audio</option>
          <option value="Device">Device</option>
          <option value="Cable">Cable</option>
          <option value="Peripheral">Peripheral</option>
          <option value="Whiteboard">Whiteboard</option>
          <option value="Robotic Kit">Robotic Kit</option>
        </select>
        
        <label for="equip_status">Equipment Status:</label>
        <select name="equip_status" id="equip_status" required>
          <option value="Available">Available</option>
          <option value="Unavailable">Unavailable</option>
        </select>

        <label for="equip_photo">Equipment Photo:</label>
        <div class="input-equip-image">
          <label for="equip_photo">
            <i class='bx bxs-camera'></i>
            <input type="file" accept="image/png, image/jpg, image/jpeg" name="equip_photo" id="equip_photo" required>
            Select Image
            <span id="image-name"></span>
          </label>
        </div>
        <button class="add-equip-button" type="submit">Add Equipment</button>
      </form>
    </div>
    <script>
      let input = document.getElementById("equip_photo");
      let imageName = document.getElementById("image-name");

      input.addEventListener("change", () => {
        let inputImage = document.querySelector("input[type=file]").files[0];

        imageName.innerText = inputImage.name;
      });
    </script>

</body>

</html>