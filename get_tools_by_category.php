<?php
require 'includes/config/database.php';
$db = connectDB();

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

if ($category_id > 0) {
    $query = "SELECT * FROM tools WHERE category_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $category_id);
} else {
    $query = "SELECT * FROM tools";
    $stmt = $db->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();
$tools = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($tools);