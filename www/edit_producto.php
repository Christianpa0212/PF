<?php
include('config/db.php');
$Nombre = '';
$PrecioVenta = '';

if (isset($_GET['idProducto'])) {
    $idProducto = $_GET['idProducto'];
    $query = "SELECT * FROM Productos WHERE idProducto = $idProducto";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $Nombre = $row['Nombre'];
        $PrecioVenta = $row['PrecioVenta'];
    }
}

if (isset($_POST['Actualizar'])) {
    $idProducto = $_GET['idProducto'];
    $Nombre = $_POST['Nombre'];
    $PrecioVenta = $_POST['PrecioVenta'];

    $query = "UPDATE Productos SET Nombre = ?, PrecioVenta = ? WHERE idProducto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdi", $Nombre, $PrecioVenta, $idProducto); 

    // Verificar la ejecución de la consulta de actualización
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Producto actualizado satisfactoriamente';
        $_SESSION['message_type'] = 'warning';
        header('Location: inventario.php');
        exit(); // Asegura que el script se detenga aquí
    } else {
        echo "Error al ejecutar la consulta de actualización: " . $stmt->error;
    }
}
?>

<?php include('includes/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit_producto.php?idProducto=<?php echo $_GET['idProducto']; ?>" method="POST">
                    <div class="form-group mb-3">
                        <input name="Nombre" type="text" class="form-control" value="<?php echo $Nombre; ?>" placeholder="Actualizar Producto" required>
                    </div>
                    <div class="form-group mb-3">
                        <input name="PrecioVenta" type="number" class="form-control" value="<?php echo $PrecioVenta; ?>" placeholder="Actualizar Precio de Venta" required>
                    </div>
                    <button class="btn btn-success" name="Actualizar">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
