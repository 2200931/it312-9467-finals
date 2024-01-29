<?php
session_start();

// Include the necessary files
include '../pages/room.php';
$mysqli = require __DIR__ . "/../../php/db.php";

// Retrieve data from the form
$roomNo = $_POST['room_no'];
$roomLocation = $_POST['room_location'];
$roomCapacity = isset($_POST['room_capacity']) ? $_POST['room_capacity'] : 0;
$roomStatus = $_POST['room_status'];

// Upload room photo
$targetDir = "../../../public/uploads/";
$targetFile = $targetDir . basename($_FILES["room_photo"]["name"]);

// Check if the directory exists; if not, create it
if (!file_exists($targetDir) && !is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Check if the room number already exists
$checkSql = "SELECT room_no FROM rooms WHERE room_no = ?";
$checkStmt = $mysqli->prepare($checkSql);

if ($checkStmt) {
    $checkStmt->bind_param("s", $roomNo);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
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
if (move_uploaded_file($_FILES["room_photo"]["tmp_name"], $targetFile)) {
    // Insert data into the database
    $insertSql = "INSERT INTO rooms (room_no, room_location, room_capacity, room_status, room_photo) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $mysqli->prepare($insertSql);

    if ($insertStmt) {
        $insertStmt->bind_param("ssiss", $roomNo, $roomLocation, $roomCapacity, $roomStatus, $targetFile);

        if ($insertStmt->execute()) {
            echo '<div class="room-added-succesful">Room added successfully!</div>';
            echo '<br><br><a href="../pages/room.php"> Go back to Rooms.</a>';
        } else {
            echo '<div class="room-error-container">';
            echo '<div class="room-error-text">';
            echo "Error: " . $insertStmt->error;
            echo '</div>';
            echo '</div>';
        }

        $insertStmt->close();
    } else {
        echo '<div class="room-error-container">';
        echo '<div class="room-error-text">';
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

$mysqli->close();
?>
