<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "app_db";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los usuarios
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Usuarios Registrados</h2>
        <div class="row">
            <?php
            // Mostrar usuarios en tarjetas de Bootstrap
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row['username'] . "</h5>
                                    <p class='card-text'>ID: " . $row['id'] . "</p>
                                </div>
                            </div>
                          </div>";
                }
            } else {
                echo "<p>No hay usuarios registrados.</p>";
            }

            // Cerrar conexión
            $conn->close();
            ?>
        </div>

        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
</body>
</html>
