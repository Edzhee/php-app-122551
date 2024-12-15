<?php
session_start();
include 'includes/db.php'; // Включи връзката с базата данни

// Проверка дали има подадена заявка за търсене
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];

    // SQL заявка за търсене в `menu_items` по име или описание
    $sql = "SELECT * FROM menu_items WHERE name LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = '%' . $search_query . '%';
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Търсене на продукти</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Резултати от търсенето</h2>
        <a href="index.php" class="btn btn-secondary mb-4">Върни се към менюто</a>
        <?php if (isset($result) && $result->num_rows > 0): ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="images/<?php echo htmlspecialchars($row['image']); 
                            ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                                <p class="card-text"><strong><?php echo htmlspecialchars($row['price']); ?> лв</strong></p>
                                <a href="details_product.php?product_id=<?php echo htmlspecialchars($row['id']); 
                                ?>" class="btn btn-primary">Детайли</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Няма намерени продукти за търсената дума: <strong><?php echo htmlspecialchars($search_query); ?></strong></p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
