<?php
session_start();

$mysqli = require __DIR__ . "../../db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form submission for resetting password

    // Sanitize and validate input
    $user_id_to_reset = mysqli_real_escape_string($mysqli, $_POST["user_id_to_reset"]);
    $new_password = mysqli_real_escape_string($mysqli, $_POST["new_password"]);

    // Update the user's password in the database (without hashing)
    $update_sql = "UPDATE user_credentials SET password = '{$new_password}' WHERE school_id = '{$user_id_to_reset}'";
    $update_result = $mysqli->query($update_sql);

    if ($update_result) {
        // Password reset successful
        $_SESSION["success_message"] = "Password reset successfully!";
        header("Location: ../pages/admin_manage_user.php");
        exit();
    } else {
        // Password reset failed
        $_SESSION["error_message"] = "Password reset failed. Please try again.";
    }
}

// If not a POST request or after handling the form submission, display the password reset form

$user_id_to_reset = isset($_GET['user_id']) ? mysqli_real_escape_string($mysqli, $_GET['user_id']) : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form action="reset_password.php" method="post">
        <input type="hidden" name="user_id_to_reset" value="<?php echo htmlspecialchars($user_id_to_reset); ?>">
        <label for="new_password">New Password:</label>
        <input type="text" name="new_password" required> <!-- Use 'text' for plain text password -->
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
