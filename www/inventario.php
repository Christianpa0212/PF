<?php include('config/db.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<?php include('includes/header.php'); ?>

<main class="container-fluid custom-container p-4">
    <h1 class="custom-title">Inventario | Existencias</h1>
    <div class="row custom-row">
        <div class="col-md-4 custom-col">
            <h2 class="custom-subtitle">Registrar Producto</h2>
            <div class="card card-body">
                <form action="save_producto.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="Producto" class="form-control custom-form-control" placeholder="Producto" required autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="Precio_venta" class="form-control custom-form-control" placeholder="Precio de Venta" required>
                    </div>
                    <button type="submit" name="save_producto" class="btn btn-success btn-block custom-form-button">Guardar Producto</button>
                </form>
            </div>
            <div class="mt-4">
                <a href="ingresos.php" class="btn custom-btn-secondary mb-2">Reabastecer Stock</a>
                <a href="salidas.php" class="btn custom-btn-secondary mb-2">Salidas</a>
            </div>
        </div>
        <div class="col-md-8 custom-col">
            <table class="table table-bordered table-striped custom-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM VistaInventario";
                    $result_tasks = mysqli_query($conn, $query);
                    if (!$result_tasks) {
                        die('Error al ejecutar la consulta: ' . mysqli_error($conn));
                    }
                    while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                        <tr>
                            <td><?php echo $row['Producto']; ?></td>
                            <td><?php echo $row['Cantidad']; ?></td>
                            <td><?php echo $row['PrecioVenta']; ?></td>
                            <td>  
                            <a href="edit_producto.php?idProducto=<?php echo $row['idProducto']?>" class="btn btn-secondary custom-btn">
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
