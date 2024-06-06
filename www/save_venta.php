<?php
include('config/db.php');

if (isset($_POST['save_venta'])) {
    $idCliente = $_POST['idCliente'];
    $productos = $_POST['productos'];
    
   
    $productosJson = json_encode($productos);

    try {

        mysqli_begin_transaction($conn);

        
        $stmt = $conn->prepare("CALL InsertarVenta(?, ?)");
        $stmt->bind_param("is", $idCliente, $productosJson);
        $stmt->execute();

        
        mysqli_commit($conn);

       
        $_SESSION['message'] = 'Venta registrada correctamente';
        $_SESSION['message_type'] = 'success';
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['message'] = 'Error al registrar la venta: ' . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
    }


    header("Location: salidas.php");
}
?>
