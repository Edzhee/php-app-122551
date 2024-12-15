<?php
session_start();
session_unset(); // Изчистваме всички сесийни данни
session_destroy(); // Унищожаваме сесията
header('Location: index.php'); // Пренасочваме към началната страница
exit();
?>
