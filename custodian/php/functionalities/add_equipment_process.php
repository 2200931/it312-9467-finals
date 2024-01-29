<?php
session_start();

include '../pages/equipment.php';
$mysqli = require __DIR__ . "/../../php/db.php";


// Retrieve data from the form
$equipName = $_POST['equip_name'];
$equipType = $_POST['equip_type'];
$equipStatus = $_POST['equip_status'];

// Upload equip photo
$targetDir = "../public/uploads/";
$targetFile = $targetDir . basename($_FILES["equip_photo"]["name"]);

// Check if the directory exists; if not, create it
if (!file_exists($targetDir) && !is_dir($targetDir)) {
  mkdir($targetDir, 0777, true);
}

// Check if the equipment name already exists
$checkSql = "SELECT equip_name FROM equipments WHERE equip_name = ?";
$checkStmt = $mysqli->prepare($checkSql);

if ($checkStmt) {
  $checkStmt->bind_param("s", $equipName);
  $checkStmt->execute();
  $checkStmt->store_result();

  if ($checkStmt->num_rows > 0) {
    echo "Equipment with the same name already exists.";
    $checkStmt->close();
    $mysqli->close();
    exit; // Stop further execution
  }

  $checkStmt->close();
} else {
  echo '<div class="room-error-container">';
  echo '<div class="room-error-text">';
  echo "Error: " . $mysqli->error;
  echo '</div>';
  echo '</div>';
  $mysqli->close();
  exit; // Stop further execution
}

// Move uploaded file
if (move_uploaded_file($_FILES["equip_photo"]["tmp_name"], $targetFile)) {
  // Insert data into the database
  $insertSql = "INSERT INTO equipments (equip_name, equip_type, equip_status, equip_photo) VALUES (?, ?, ?, ?)";
  $insertStmt = $mysqli->prepare($insertSql);

  if ($insertStmt) {
    $insertStmt->bind_param("siss", $equipName, $equipType, $equipStatus, $targetFile);

    if ($insertStmt->execute()) {
      echo "Equipment added successfully!";
      echo '<br><br><a href="../pages/equipment.php">Go Back to Equipment List</a>';
    } else {
      echo '<div class="equip-error-container">';
      echo '<div class="equip-error-text">';
      echo "Error: " . $insertStmt->error;
      echo '</div>';
      echo '</div>';
    }

    $insertStmt->close();
  } else {
    echo '<div class="equip-error-container">';
    echo '<div class="equip-error-text">';
    echo "Error: " . $mysqli->error;
    echo '</div>';
    echo '</div>';
  }
} else {
  echo '<div class="file-error-container">';
  echo '<div class="file-error-text">';
  echo "Sorry, there was an error uploading your file.";
  echo '</div>';
  echo '</div>';
}

$insertStmt->close();
$mysqli->close();
?>
