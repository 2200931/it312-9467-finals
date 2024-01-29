<?php

// logout.php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or another location
header('Location: custodian_login.php');
exit();
