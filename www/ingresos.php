<?php include('config/db.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<?php include('includes/header.php'); ?>

<main class="container-fluid custom-container p-4">
    <h1 class="custom-title">Inventario | Ingresos</h1>
    <div class="row custom-row">
        <div class="col-md-4 custom-col">
            <h2 class="custom-subtitle">Añadir Ingreso</h2>
            <div class="card card-body">
                <form action="save_ingreso.php" method="POST">
                    <div class="mb-3">
                        <input type="number" name="idProducto" class="form-control custom-form-control" placeholder="idProducto" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="Cantidad" class="form-control custom-form-control" placeholder="Cantidad" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="Precio_compra" class="form-control custom-form-control" placeholder="Precio de Compra" required>
                    </div>
                    <button type="submit" name="save_ingreso" class="btn btn-success btn-block custom-form-button">Guardar</button>
                </form>
            </div>
            <div class="mt-4">
                <a href="hist_ingresos.php" class="btn custom-btn-secondary mb-2">Historial Ingresos</a>
                <a href="inventario.php" class="btn custom-btn-secondary mb-2">Agregar Producto</a>
            </div>
        </div>
        <div class="col-md-8 custom-col">
            <table class="table table-bordered table-striped custom-table">
                <thead>
                    <tr>
                        <th>idProducto</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM VistaIngresos";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['idProducto']; ?></td>
                            <td><?php echo $row['Producto']; ?></td>
                            <td><?php echo $row['Cantidad']; ?></td>
                            <td><?php echo $row['PrecioVenta']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>
