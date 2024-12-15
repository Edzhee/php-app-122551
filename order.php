<?php
session_start(); // Стартираме сесията
include 'includes/db.php'; // Включваме връзката с базата данни

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Проверка за наличието на параметър product_id
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    echo "<p>Няма избран продукт!</p>";
    echo "<p>Няма параметър 'product_id' в URL адреса. Текущ URL: " . $_SERVER['REQUEST_URI'] . "</p>"; // Покажи URL-то за диагностика
    exit;
}

// Извличаме и валидираме параметъра
$product_id = intval($_GET['product_id']);

// Проверка дали продуктът съществува
$sql = "SELECT * FROM menu_items WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<p>Продуктът не съществува!</p>";
    exit;
}

// Ако продуктът съществува, извличаме информацията
$product = $result->fetch_assoc();

// Показваме информацията за продукта
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поръчка на продукт</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }
        .order-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .order-container h1 {
            text-align: center;
            font-size: 2rem;
            color: #333;
        }
        .product-info {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-top: 20px;
        }
        .product-info img {
            width: 200px;
            height: auto;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-info .details {
            max-width: 400px;
        }
        .product-info .details h3 {
            font-size: 1.5rem;
            color: #444;
            margin-bottom: 10px;
        }
        .product-info .details p {
            color: #777;
            font-size: 1rem;
            margin-bottom: 20px;
        }
        .order-button {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container order-container">
    <h1>Поръчка на продукт: <?php echo htmlspecialchars($product['name']); ?></h1>
    
    <div class="product-info">
        <!-- Изображение на продукта -->
        <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">

        <!-- Детайли за продукта -->
        <div class="details">
            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <div class="price">Цена: <?php echo htmlspecialchars($product['price']); ?> лв</div>
        </div>
    </div>

    <!-- Форма за поръчка -->
    <form action="order_process.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <div class="mb-3">
            <label for="quantity" class="form-label">Количество</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Поръчай сега</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
