<!-- edit_equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Edit Equipment</title>
  <link rel="stylesheet" href="../public/styles/equipment.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <h1>Edit Equipment</h1>

    <?php
    include '../db.php'; // Include your database connection code

    // Check if the equipment ID is provided in the URL
    if (isset($_GET['id'])) {
      $equipmentId = $_GET['id'];

      // Retrieve equipment information based on the ID
      $sql = "SELECT * FROM equipments WHERE equip_id = $equipmentId";
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
      ?>
        <form action="edit_equipment_process.php" method="post">
          <!-- Include hidden input field for the equipment ID -->
          <input type="hidden" name="id" value="<?php echo $equipmentId; ?>">

          <label for="equipment_name">Equipment Name:</label>
          <input type="text" id="equip_name" name="equip_name" value="<?php echo $row['equip_name']; ?>" required>

          <label for="equip_type">Equipment Type:</label>
          <input type="text" id="equip_type" name="equip_type" value="<?php echo $row['equip_type']; ?>" required>

          <label for="equip_status">Equipment Status:</label>
          <select id="equip_status" name="equip_status" required>
            <option value="available" <?php echo ($row['equip_status'] === 'available') ? 'selected' : ''; ?>>Available</option>
            <option value="not_available" <?php echo ($row['equip_status'] === 'not_available') ? 'selected' : ''; ?>>Unavailable</option>
          </select>

          <label for="equip_photo">Equipment Photo:</label>
          <input type="file" id="equip_photo" name="equip_photo" accept="image/*">
          <p class="note">Note: Select a new photo only if you want to update the existing one.</p>

          <button type="submit">Update Equipment</button>
        </form>
    <?php
      } else {
        echo 'Equipment not found.';
      }
    } else {
      echo 'Equipment ID not provided.';
    }
    ?>
  </div>
</body>

</html>
