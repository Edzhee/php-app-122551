<?php
session_start();
require_once '../includes/db.php'; 
error_log("POST Data: " . print_r($_POST, true)); 
error_log("Session Data: " . print_r($_SESSION, true)); 


header('Content-Type: application/json'); 


if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Трябва да сте влезли, за да добавите продукт в любими.']);
    exit;
}


if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Невалиден идентификатор на продукт.']);
    exit;
}

$product_id = (int)$_POST['product_id'];
$user_id = (int)$_SESSION['user_id'];


$sql = "INSERT INTO favorite_products_users (user_id, product_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('ii', $user_id, $product_id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Продуктът е добавен в любими.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Възникна грешка при добавянето на продукта.']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Грешка в заявката към базата данни.']);
}

$conn->close();
?>
