<?php
include('config/db.php');

if (isset($_POST['save_ingreso'])) {
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['Cantidad'];
    $precioCompra = $_POST['Precio_compra'];

    try {
        mysqli_begin_transaction($conn);

        $stmt = $conn->prepare("CALL RegistrarIngreso(?, ?, ?)");
        $stmt->bind_param("iii", $idProducto, $cantidad, $precioCompra);
        $stmt->execute();

        mysqli_commit($conn);
        
        $_SESSION['message'] = 'Ingreso registrado correctamente';
        $_SESSION['message_type'] = 'success';
    } catch (Exception $e) {
        mysqli_rollback($conn);

        $_SESSION['message'] = 'Error al registrar el ingreso: ' . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
    }

    header("Location: ingresos.php");
}
?>
