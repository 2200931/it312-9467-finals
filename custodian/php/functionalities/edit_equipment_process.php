<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../db.php';

  // Retrieve data from the form
  $equipmentId = $_POST['id'];
  $equipmentName = $_POST['equip_name'];

  // Update data in the database using prepared statement
  $sql = "UPDATE equipments SET equip_name=? WHERE equip_id=?";
  $stmt = $mysqli->prepare($sql);

  if ($stmt) {
      $stmt->bind_param("si", $equipmentName,$equipmentId);

      if ($stmt->execute()) {
          echo "Equipment updated successfully!";
          echo '<br><br><a href="../pages/equipment.php">Go Back to Equipment List</a>';
      } else {
          echo "Error: " . $stmt->error;
      }

      // Close the prepared statement
      $stmt->close();
  } else {
      echo "Error: " . $mysqli->error;
  }

  // Close the database connection
  $mysqli->close();
}

?>
