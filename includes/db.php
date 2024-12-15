<?php
$servername = "localhost"; 
$username = "root";       
$password = "";            
$dbname = "takeaway_db";   

// Създаване на връзка с базата данни
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка дали връзката е успешна
if ($conn->connect_error) {
    die("Не може да се свържем с базата данни: " . $conn->connect_error);

}

// SQL заявка за извличане на всички продукти
$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);

// Проверка дали заявката е успешна
if ($result === false) {
    echo "Грешка при изпълнение на SQL заявката: " . $conn->error;
}

?>

