<?php
session_start();
include 'includes/db.php'; // Включваме връзката с базата данни

// Проверка дали потребителят вече е логнат
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Инициализиране на съобщенията за грешки/успех
$errors = [];
$success_message = '';

// Проверка за изпратени данни от формата
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);

    // Проверка за празни полета
    if (empty($username)) {
        $errors[] = "Моля, въведете потребителско име.";
    }
    if (empty($email)) {
        $errors[] = "Моля, въведете електронна поща.";
    }
    if (empty($password)) {
        $errors[] = "Моля, въведете парола.";
    }
    if ($password !== $password_confirm) {
        $errors[] = "Паролите не съвпадат.";
    }

    // Проверка за съществуващ потребител с този имейл
    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Потребител с този имейл вече съществува.";
        } else {
            // Ако няма грешки, добавяме потребителя
            $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Хешираме паролата
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Регистрацията беше успешна. Моля, влезте с вашите данни.";
                header("Location: login.php");
                exit;
            } else {
                $errors[] = "Грешка при регистрацията. Моля, опитайте отново.";
            }
        }
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - Takeaway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 8px;
            background-color: #F0E68C;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            width: 100%;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container fade-in">
            <h2 class="text-center">Регистрация</h2>

            <!-- Показване на грешки, ако има такива -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Показване на съобщение за успех -->
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($success_message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Форма за регистрация -->
            <form action="register.php" method="POST" id="registerForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Потребителско име</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Електронна поща</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Парола</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Потвърдете паролата</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                </div>
                <button type="submit" class="btn btn-primary">Регистрация</button>
            </form>

            <p class="mt-3 text-center">Вече имате профил? <a href="login.php">Влезте тук</a>.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
