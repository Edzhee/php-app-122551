<?php
session_start();
include 'includes/db.php'; // Включваме връзката с базата данни

if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Проверка дали продуктът съществува
    $sql = "SELECT * FROM menu_items WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Проверка за потребителския идентификатор
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['user_id'] = 1; // Временно задаваме фиктивен user_id за тестове
        }

        $user_id = $_SESSION['user_id'];
        $customer_name = $_SESSION['customer_name'] ?? 'Guest'; // Ако няма име, използваме 'Guest'
        $total_price = $product['price'] * $quantity;

        // Вмъкваме поръчката в таблицата orders
        $sql = "INSERT INTO orders (customer_name, user_id, product_id, quantity, total_price, order_date, status) 
                VALUES ('$customer_name', $user_id, $product_id, $quantity, $total_price, NOW(), 'pending')";

        if ($conn->query($sql) === TRUE) {
            ?>
            <!DOCTYPE html>
            <html lang="bg">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Успешна поръчка</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body {
                        background-color: #FFA500;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                    }
                    .success-container {
                        text-align: center;
                        background: white;
                        padding: 40px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    }
                    .success-icon {
                        font-size: 50px;
                        color: #28a745;
                    }
                    .success-message {
                        font-size: 1.5rem;
                        color: #333;
                        margin-top: 15px;
                    }
                    .back-button {
                        margin-top: 20px;
                        text-decoration: none;
                        color: white;
                        background-color: #FFA07A;
                        padding: 10px 20px;
                        border-radius: 5px;
                        font-size: 1rem;
                        display: inline-block;
                    }
                    .back-button:hover {
                        background-color: #FF7F50;
                    }
                </style>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            </head>
            <body>
                <div class="success-container">
                    <div class="success-icon">✅</div>
                    <div class="success-message">Вашата поръчка е приета успешно!</div>
                    <a href="index.php" class="back-button">← Върнете се назад</a>
                </div>
            </body>
            </html>
            <?php
            exit;
        } else {
            echo "<p>Грешка при създаването на поръчката: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Продуктът не съществува!</p>";
    }
} else {
    echo "<p>Невалидни данни за поръчката.</p>";
}

$conn->close();
?>

