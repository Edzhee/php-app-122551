<?php
include('includes/db.php');

// Проверка дали е подаден параметър за product_id
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Извлечете подробности за меню артикула от базата данни
    $query = "SELECT * FROM menu_items WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Проверете дали артикулът съществува
    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
    } else {
        echo "<p>Меню артикулът не е намерен! <a href='search.php'>Върнете се към резултатите.</a></p>";
        exit;
    }
} else {
    echo "<p>Няма избран артикул! <a href='search.php'>Върнете се към резултатите.</a></p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        // Анимация при зареждане на страницата
        $(document).ready(function() {
            // Плавно показване на целия блок с подробности за продукта
            $('.menu-item-details').hide().fadeIn(1000);  // Плавно показване на целия блок за 1 секунда
            $('.menu-item-image img').hide().slideDown(1000); // Плавно показване на изображението
        });
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подробности за артикул</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Основен стил */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #2c3e50;
            margin-top: 20px;
        }

        .menu-item-details {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .menu-item-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
        }

        .menu-item-info {
            margin-top: 20px;
            font-size: 1.2em;
        }

        .menu-item-info p {
            line-height: 1.6;
            margin: 10px 0;
        }

        .menu-item-info strong {
            color: #e67e22;
        }

        .back-button {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 1.2em;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2980b9;
        }

        /* За по-малки екрани */
        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            .menu-item-details {
                padding: 15px;
                margin: 15px;
            }

            .menu-item-image img {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="menu-item-details">
        <h1><?php echo htmlspecialchars($item['name']); ?></h1>

        <!-- Изображение на меню артикул -->
        <div class="menu-item-image">
            <img src="images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
        </div>

        <!-- Информация за меню артикула -->
        <div class="menu-item-info">
            <p><strong>Описание:</strong> <?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
            <p><strong>Цена:</strong> <?php echo number_format($item['price'], 2); ?> лв</p>
        </div>

        <!-- Бутон за връщане назад -->
        <a href="search.php" class="back-button">Назад към резултатите</a>
    </div>

</body>
<script>
$(document).ready(function() {
    // Показва елементи с плавен ефект на зареждане
    $('.menu-item-details').hide().fadeIn(1000);  // Фейд ин на целия блок
    $('.menu-item-image img').hide().slideDown(1000); // Фейд ин за изображението
});
</script>

</html>



<?php
// Затворете връзката с базата данни
$conn->close();
?>
