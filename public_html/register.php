<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    // Comprobamos si el usuario ya existe
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->rowCount() > 0) {
        echo "Este usuario ya está registrado.";
    } else {
        // Insertamos el nuevo usuario
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);
        echo "Usuario registrado con éxito.";
    }
}
?>

<form method="POST">
    <input type="text" name="username" required placeholder="Nombre de usuario">
    <input type="password" name="password" required placeholder="Contraseña">
    <button type="submit">Registrarse</button>
</form>
