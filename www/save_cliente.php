<?php
include('config/db.php');

if (isset($_POST['save_cliente'])) {
    $nombre = $_POST['Nombre'];
    $apellidos = $_POST['Apellidos'];
    $sexo = $_POST['Sexo'];
    $fecha_nacimiento = $_POST['Fecha_de_Nacimiento'];
    $cp = $_POST['CP'];
    $celular = $_POST['Celular'];
    $correo = $_POST['Correo'];

    try {
        mysqli_begin_transaction($conn);

        $stmt = $conn->prepare("CALL InsertarClienteConDireccion(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nombre, $apellidos, $sexo, $fecha_nacimiento, $cp, $celular, $correo);
        $stmt->execute();

        mysqli_commit($conn);

        $_SESSION['message'] = 'Cliente guardado correctamente';
        $_SESSION['message_type'] = 'success';
    } catch (Exception $e) {
        mysqli_rollback($conn);

        $_SESSION['message'] = 'Error al guardar el cliente: ' . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
    }

    header("Location: clientes.php");
}
?>
