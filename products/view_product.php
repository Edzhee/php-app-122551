<?php
session_start();
include '../includes/db.php';

// Проверяваме дали е изпратена заявка за търсене или за конкретен продукт
if (isset($_GET['query'])) {
    // Търсене на продукти
    $query = $conn->real_escape_string($_GET['query']);
    $sql = "SELECT * FROM menu_items WHERE name LIKE '%$query%' OR description LIKE '%$query%'";
    $result = $conn->query($sql);
} elseif (isset($_GET['product_id'])) {
    // Показване на детайли за конкретен продукт
    $product_id = intval($_GET['product_id']);
    $sql = "SELECT * FROM menu_items WHERE id = $product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $error_message = "Продуктът не съществува!";
    }
} else {
    // Показване на всички продукти по подразбиране
    $sql = "SELECT * FROM menu_items";
    $result = $conn->query($sql);
}

$conn->close(); // Затваряме връзката
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продукти</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Продукти</h2>

    <!-- Форма за търсене -->
    <form action="view_products.php" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Търсене на продукти..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>" required>
            <button class="btn btn-primary" type="submit">Търси</button>
        </div>
    </form>

    <!-- Съдържание -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if (isset($product)): ?>
        <!-- Детайли за продукт -->
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <img src="../images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid">
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p><strong>Цена:</strong> <?php echo htmlspecialchars($product['price']); ?> лв</p>
    <?php elseif ($result && $result->num_rows > 0): ?>
        <!-- Списък с продукти -->
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="card-text"><strong><?php echo htmlspecialchars($row['price']); ?> лв</strong></p>
                            <a href="details_product.php?product_id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-primary">Детайли</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Няма намерени продукти.</p>
    <?php endif; ?>
</div>
 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
