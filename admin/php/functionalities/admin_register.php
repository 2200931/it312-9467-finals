<!-- admin_register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
</head>
<body>
    <h2>User/Custodian Registration</h2>
    <form action="admin_register_process.php" method="post">
        <label for="username">School ID:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="role">Select Role:</label>
        <select name="role" required>
            <option value="user">User</option>
            <option value="custodian">Custodian</option>
        </select>

        <button type="submit">Register</button>
    </form>
</body>
</html>


