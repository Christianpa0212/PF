<?php
include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT idUsuario, Correo, Contraseña FROM Usuarios WHERE Correo = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['Contraseña'])) {
        $_SESSION['user_id'] = $row['idUsuario'];
        header("Location: home.php");
        exit();
    } else {
        header("Location: index.php?error=1");
        exit();
    }
}
?>
