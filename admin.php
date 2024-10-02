<?php 

require 'includes/config/database.php';
$db = connectDB();

$email = "begalan@user.com";
$password = "staybgalan*24";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO admin (email, password) VALUES ('{$email}', '{$passwordHash}')";

mysqli_query($db, $query);