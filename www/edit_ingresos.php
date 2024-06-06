<?php
include('config/db.php');

$Cantidad = '';
$PrecioCompra = '';

if (isset($_GET['idIngreso'])) {
    $idIngreso = $_GET['idIngreso'];
    $query = "SELECT * FROM Ingresos WHERE idIngreso = $idIngreso";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $Cantidad = $row['Cantidad'];
        $PrecioCompra = $row['PrecioCompra'];
    }
}

if (isset($_POST['Actualizar'])) {
    $idIngreso = $_GET['idIngreso'];
    $Cantidad = $_POST['Cantidad'];
    $PrecioCompra = $_POST['PrecioCompra'];

    $query = "UPDATE Ingresos SET Cantidad = ?, PrecioCompra = ? WHERE idIngreso = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $Cantidad, $PrecioCompra, $idIngreso);

    // Verificar la ejecución de la consulta de actualización
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Ingreso actualizado satisfactoriamente';
        $_SESSION['message_type'] = 'warning';
        header('Location: hist_ingresos.php');
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
                <form action="edit_ingresos.php?idIngreso=<?php echo $_GET['idIngreso']; ?>" method="POST">
                    <div class="form-group mb-3">
                        <input name="Cantidad" type="number" class="form-control" value="<?php echo $Cantidad; ?>" placeholder="Actualizar Cantidad" required>
                    </div>
                    <div class="form-group mb-3">
                        <input name="PrecioCompra" type="number" class="form-control" value="<?php echo $PrecioCompra; ?>" placeholder="Actualizar Precio de Compra" required>
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
