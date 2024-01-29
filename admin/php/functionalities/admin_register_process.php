<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if the username is a number
    if (!is_numeric($username)) {
        echo "Error: Username should contain numbers only.";
        echo '<br><br><a href="../functionalities/admin_register.php"> Go back to Admin Registration.</a>';
        exit(); // Stop further execution
    }

    $table = ($role === 'user') ? 'user_credentials' : 'custodian_credentials';
    $id_column = ($role === 'user') ? 'school_id' : 'custodian_id';
    $password_column = ($role === 'user') ? 'password' : 'custodian_password';

    $sql = "INSERT INTO $table ($id_column, $password_column) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "Admin Registration successful!";
            echo '<br><br><a href="../pages/admin_dashboard.php"> Go back to Admin Dashboard.</a>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }

    $mysqli->close();
}
?>
