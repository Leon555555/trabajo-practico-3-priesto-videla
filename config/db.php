// db.php
<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "app_db";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
