<?php
include('config/db.php');

if (isset($_POST['save_producto'])) {
    $nombre = $_POST['Producto'];
    $precio_venta = $_POST['Precio_venta'];

    try {
      
        mysqli_begin_transaction($conn);

       
        $stmt = $conn->prepare("CALL InsertarProductoYExistencia(?, ?)");
        $stmt->bind_param("si", $nombre, $precio_venta);
        $stmt->execute();

     
        mysqli_commit($conn);
        
        $_SESSION['message'] = 'Producto guardado correctamente';
        $_SESSION['message_type'] = 'success';
    } catch (Exception $e) {
        
        mysqli_rollback($conn);

        $_SESSION['message'] = 'Error al guardar el producto: ' . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
    }

    header("Location: inventario.php");
}
?>
