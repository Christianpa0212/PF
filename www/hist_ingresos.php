<?php include('config/db.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<?php include('includes/header.php'); ?>

<main class="container-fluid custom-container p-4">
    <h1 class="custom-title">Historial de Ingresos</h1>
    <div class="row custom-row">
        <div class="col-md-12 custom-col">
            <div class="mt-4">
                <a href="ingresos.php" class="btn custom-btn-secondary mb-2">Reabastecer Stock</a>
                <a href="salidas.php" class="btn custom-btn-secondary mb-2">Salidas</a>
            </div>
            <table class="table table-bordered table-striped custom-table">
                <thead>
                    <tr>
                        <th>idIngreso</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio compra</th>
                        <th>Total</th>
                        <th>Precio Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM VistaHistIngresos";
                    $result_tasks = mysqli_query($conn, $query);
                    if (!$result_tasks) {
                        die('Error al ejecutar la consulta: ' . mysqli_error($conn));
                    }
                    while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                        <tr>
                            <td><?php echo $row['idIngreso']; ?></td>
                            <td><?php echo $row['Producto']; ?></td>
                            <td><?php echo $row['Cantidad']; ?></td>
                            <td><?php echo $row['PrecioCompra']; ?></td>
                            <td><?php echo $row['Total']; ?></td>
                            <td><?php echo $row['PrecioVenta']; ?></td>
                            <td>  
                                <a href="edit_ingresos.php?idIngreso=<?php echo $row['idIngreso']?>" class="btn btn-secondary custom-btn">
                                    <i class="fas fa-marker"></i>
                                </a> 
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>
