<?php
require_once('../db.php');

$response = [
    'success' => true,
    'error' => '',
    'data' => []
];

// Получаваме product_id от POST заявката
$product_id = intval($_POST['product_id'] ?? 0);

if ($product_id <= 0) {
    $response['success'] = false;
    $response['error'] = 'Невалидно ID на продукт';
} else {
    // Вземаме ID на потребителя от сесията
    session_start();
    $user_id = $_SESSION['user_id'];

    // Премахваме продукта от любими
    $sql = 'DELETE FROM favorite_products_users WHERE user_id = :user_id AND product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $params = [
        'user_id' => $user_id,
        'product_id' => $product_id
    ];
    
    if (!$stmt->execute($params)) {
        $response['success'] = false;
        $response['error'] = 'Възникна грешка при премахване на продукта от любими';
    }
}

echo json_encode($response); // Връщаме отговор
?>
