<?php
session_start(); // Започваме сесията
include 'includes/db.php'; // Включваме връзката с базата данни

// Проверяваме дали потребителят е логнат
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Извличаме всички продукти от менюто
$sql = "SELECT * FROM menu_items"; // Проверете дали името на таблицата е правилно
if ($result = $conn->query($sql)) { // Проверяваме дали заявката е успешна
    if ($result->num_rows > 0) { // Проверяваме дали има продукти
        // Извеждаме всички продукти
    } else {
        echo "<p>Няма продукти в менюто.</p>";
    }
} else {
    echo "Грешка при изпълнението на заявката: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню за поръчки</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <div class="container mt-5">
        <h2>Нашето меню за поръчки</h2>

        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card mb-4">';
                    echo '<img src="images/' . htmlspecialchars($row['image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($row['description']) . '</p>';
                    echo '<p class="card-text"><strong>' . htmlspecialchars($row['price']) . ' лв</strong></p>';
                    echo '<a href="order.php?product_id=' . $row['id'] . '" class="btn btn-primary">Поръчай</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Няма продукти в менюто.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
