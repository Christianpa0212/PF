<?php include('config/db.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<?php include('includes/header.php'); ?>

<main class="container-fluid custom-container p-4">
    <h1 class="custom-title">Registrar Venta</h1>
    <div class="row custom-row">
        <div class="col-md-4 custom-col">
            <h2 class="custom-subtitle">Añadir Venta</h2>
            <div class="card card-body">
                <form id="ventaForm" action="save_venta.php" method="POST">
                    <div class="mb-3">
                        <label for="idCliente" class="form-label">Cliente</label>
                        <select name="idCliente" class="form-control custom-form-control" required>
                            <?php
                            $query = "SELECT c.idCliente, p.Nombre, p.Apellidos FROM Clientes c JOIN Personas p ON c.idPersona = p.idPersona";
                            $result = mysqli_query($conn, $query);
                            if (!$result) {
                                die('Error en la consulta: ' . mysqli_error($conn));
                            }
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['idCliente']}'>{$row['Nombre']} {$row['Apellidos']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div id="productosContainer">
                        <div class="producto-item mb-3">
                            <label for="idProducto" class="form-label">Producto</label>
                            <select name="productos[0][idProducto]" class="form-control custom-form-control" required onchange="updatePrice(0)">
                                <?php
                                $query = "SELECT idProducto, Nombre FROM Productos";
                                $result = mysqli_query($conn, $query);
                                if (!$result) {
                                    die('Error en la consulta: ' . mysqli_error($conn));
                                }
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['idProducto']}'>{$row['Nombre']}</option>";
                                }
                                ?>
                            </select>
                            <label for="Cantidad" class="form-label">Cantidad</label>
                            <input type="number" name="productos[0][Cantidad]" class="form-control custom-form-control" placeholder="Cantidad" required>
                            <label for="PrecioVenta" class="form-label">Precio de Venta</label>
                            <input type="number" name="productos[0][PrecioVenta]" class="form-control custom-form-control" placeholder="Precio de Venta" readonly>
                        </div>
                    </div>
                    <button type="button" id="addProduct" class="btn btn-secondary mb-3">Agregar Producto</button>
                    <button type="submit" name="save_venta" class="btn btn-success btn-block custom-form-button">Guardar Venta</button>
                </form>
            </div>
        </div>
        <div class="col-md-8 custom-col">
            <h2 class="custom-subtitle">Ventas Realizadas</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped custom-table">
                    <thead>
                        <tr>
                            <th>ID Venta</th>
                            <th>Cliente</th>
                            <th>Total Venta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM VistaVentas";
                        $result_tasks = mysqli_query($conn, $query);
                        if (!$result_tasks) {
                            die('Error en la consulta: ' . mysqli_error($conn));
                        }
                        while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                            <tr>
                                <td><?php echo $row['idVenta']; ?></td>
                                <td><?php echo $row['Cliente']; ?></td>
                                <td><?php echo $row['Total']; ?></td>
                                <td>
                                    <a href="detalle_venta.php?idVenta=<?php echo $row['idVenta']; ?>" class="btn btn-info btn-sm">Ver Detalles</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    let productCount = 1;

    function updatePrice(index) {
        const selectElement = document.querySelector(`select[name='productos[${index}][idProducto]']`);
        const priceElement = document.querySelector(`input[name='productos[${index}][PrecioVenta]']`);

        fetch(`get_product_price.php?idProducto=${selectElement.value}`)
            .then(response => response.json())
            .then(data => {
                priceElement.value = data.PrecioVenta;
            });
    }

    document.getElementById('addProduct').addEventListener('click', function () {
        let container = document.getElementById('productosContainer');
        let newProduct = document.createElement('div');
        newProduct.classList.add('producto-item', 'mb-3');
        newProduct.innerHTML = `
            <label for="idProducto" class="form-label">Producto</label>
            <select name="productos[${productCount}][idProducto]" class="form-control custom-form-control" required onchange="updatePrice(${productCount})">
                <?php
                $query = "SELECT idProducto, Nombre FROM Productos";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die('Error en la consulta: ' . mysqli_error($conn));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['idProducto']}'>{$row['Nombre']}</option>";
                }
                ?>
            </select>
            <label for="Cantidad" class="form-label">Cantidad</label>
            <input type="number" name="productos[${productCount}][Cantidad]" class="form-control custom-form-control" placeholder="Cantidad" required>
            <label for="PrecioVenta" class="form-label">Precio de Venta</label>
            <input type="number" name="productos[${productCount}][PrecioVenta]" class="form-control custom-form-control" placeholder="Precio de Venta" readonly>
        `;
        container.appendChild(newProduct);
        productCount++;
    });
</script>
<?php include('includes/footer.php'); ?>
