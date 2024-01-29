<?php
// edit_room_process.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentify";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve data from the form
$roomId = $_POST['room_id'];
$roomNo = $_POST['room_no'];
$roomLocation = $_POST['room_location'];
$roomCapacity = isset($_POST['room_capacity']) ? $_POST['room_capacity'] : 0;
$roomStatus = $_POST['room_status'];

// Use a switch statement to handle different actions
$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'update':
        // Update data in the database
        $updateSql = "UPDATE rooms SET room_no=?, room_location=?, room_capacity=?, room_status=? WHERE room_id=?";
        $stmt = $mysqli->prepare($updateSql);
        $stmt->bind_param("ssisi", $roomNo, $roomLocation, $roomCapacity, $roomStatus, $roomId);

        if ($stmt->execute()) {
            echo "Room updated successfully!";

            // Check if a file was uploaded
            if ($_FILES['room_photo']['size'] > 0) {
                $targetDir = "../../../public/uploads";
                $targetFile = $targetDir . basename($_FILES['room_photo']['name']);

                // Move the uploaded file to the destination
                if (move_uploaded_file($_FILES['room_photo']['tmp_name'], $targetFile)) {
                    // Update the room_photo column in the database
                    $updatePhotoSql = "UPDATE rooms SET room_photo=? WHERE room_id=?";
                    $stmtPhoto = $mysqli->prepare($updatePhotoSql);
                    $stmtPhoto->bind_param("si", $targetFile, $roomId);

                    if ($stmtPhoto->execute()) {
                        echo "Room photo updated successfully!";
                    } else {
                        echo "Error updating room photo: " . $stmtPhoto->error;
                    }

                    $stmtPhoto->close();
                } else {
                    echo "Error uploading file.";
                }
            }

            echo '<br><br><a href="../pages/room.php">Go Back to Room List</a>';
        } else {
            echo "Error updating room: " . $stmt->error;
        }

        break;

    case 'delete':
        // Delete data in the database
        $deleteSql = "DELETE FROM rooms WHERE room_id=?";
        $stmt = $mysqli->prepare($deleteSql);
        $stmt->bind_param("i", $roomId);

        if ($stmt->execute()) {
            echo "Room deleted successfully!";
            echo '<br><br><a href="../pages/room.php">Go Back to Room List</a>';
        } else {
            echo "Error deleting room: " . $stmt->error;
        }

        break;

    default:
        echo "Invalid action.";
        break;
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$mysqli->close();
?>
