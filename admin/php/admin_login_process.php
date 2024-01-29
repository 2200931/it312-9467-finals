<?php
session_start();

// Initialize the variable
$is_invalid = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php'; // Include your database connection code

    $admin_id = $_POST['admin_id'];
    $admin_password = $_POST['admin_password'];

    $sql = "SELECT * FROM admin_credentials WHERE admin_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $storedPassword = $user['admin_password']; // Assuming your hashed password is stored in the 'admin_password' column

        // Verify the password
        if ($admin_password == $storedPassword) {
            // Password is correct
            $_SESSION['admin_id'] = $user['admin_id'];
            header("Location: ../php/pages/admin_dashboard.php");
            exit();
        } else {
            // Password is incorrect
            $is_invalid = true;
        }
    } else {
        // User not found
        $is_invalid = true;
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
