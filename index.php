<?php
session_start();

include 'includes/db.php';

if (isset($_SESSION['order_success'])) {
    $success_message = $_SESSION['order_success'];
} else {
    $success_message = '';
}



// SQL заявка за извличане на всички продукти от менюто
$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takeaway Меню</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Оранжев хедър */
        header {
            background-color: #FFA500; /* Оранжев цвят */
            color: white;
            text-align: center;
            padding: 20px 0;
        }
    </style>
    <style>
    .card-img-top {
        width: 100%; /* Автоматично се адаптира към ширината на контейнера */
        height: 200px; /* Фиксирана височина */
        object-fit: cover; /* Изрязва изображението, за да се побере в контейнера */
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


    <header>
        <h1>Добре дошли в Takeaway менюто!</h1>
        
        <form action="search.php" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="query" class="form-control" placeholder="Търсене на продукти..." required>
        <button class="btn btn-primary" type="submit">Търси</button>
    </div>
</form>

        <div>
             
            <?php if (isset($_SESSION['username'])): ?>
                <p>Здравей, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
                <a href="logout.php" class="btn btn-danger">Изход</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Вход</a>
                <a href="register.php" class="btn btn-success">Регистрация</a>
            <?php endif; ?>
        </div>
        
    </header>

    <div class="container mt-5">
        <h2>Нашето меню</h2>
        <div class="row">
            <?php
            // Пример: Уверете се, че $result е дефинирана и съдържа стойности
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
echo '<div class="card">';
echo '<img src="images/' . htmlspecialchars($row['image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">';
echo '<div class="card-body">';
echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
echo '<p class="card-text">' . htmlspecialchars($row['description']) . '</p>';
echo '<p class="card-text"><strong>' . htmlspecialchars($row['price']) . ' лв</strong></p>';
echo '<a href="order.php?product_id=' . urlencode($row['id']) . '" class="btn btn-primary">Поръчай</a>';
echo '</div></div></div>';

                }
            } else {
                echo "<p>Няма продукти в менюто.</p>";
            }
            ?>
        </div>
    </div>
   


    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 Takeaway. Всички права запазени.</p>
    </footer>
</body>
</html>
