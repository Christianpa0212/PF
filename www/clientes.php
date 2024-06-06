<?php include('config/db.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<?php include('includes/header.php'); ?>

<main class="container-fluid custom-container p-4">
    <h1 class="custom-title">Clientes</h1>
    <div class="row custom-row">
        <div class="col-md-4 custom-col">
            <h2 class="custom-subtitle">Registrar Cliente</h2>
            <div class="card card-body">
                <form action="save_cliente.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="Nombre" class="form-control custom-form-control" placeholder="Nombre" required autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="Apellidos" class="form-control custom-form-control" placeholder="Apellidos" required>
                    </div>
                    <div class="mb-3">
                        <select name="Sexo" class="form-control custom-form-control" required>
                            <option value="">Seleccione Sexo</option>
                            <option value="H">Hombre</option>
                            <option value="M">Mujer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="Fecha_de_Nacimiento" class="form-control custom-form-control" placeholder="Fecha de Nacimiento" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="CP" class="form-control custom-form-control" placeholder="CP" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="Celular" class="form-control custom-form-control" placeholder="Celular" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="Correo" class="form-control custom-form-control" placeholder="Correo" required>
                    </div>
                    <button type="submit" name="save_cliente" class="btn btn-success btn-block custom-form-button">Guardar Cliente</button>
                </form>
            </div>
            <div class="mt-4">
                <a href="ventasclientes.php" class="btn custom-btn-secondary mb-2">Ver Ventas por Clientes</a>
                <a href="salidas.php" class="btn custom-btn-secondary mb-2">Ver Ventas</a>
            </div>
        </div>
        <div class="col-md-8 custom-col">
            <div class="table-responsive">
                <table class="table table-bordered table-striped custom-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Sexo</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>CP</th>
                            <th>Pais</th>
                            <th>Estado</th>
                            <th>Municipio</th>
                            <th>Asentamiento</th>
                            <th>Tipo de Asentamiento</th>
                            <th>Acciones</th> <!-- Nueva columna -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT idCliente, Nombre, Apellidos, Sexo, Fecha_Nacimiento, Celular, Correo, CP, Pais, Estado, Municipio, Asentamiento, Tipo_Asentamiento FROM VistaClientes";
                        $result_tasks = mysqli_query($conn, $query);
                        if (!$result_tasks) {
                            die('Error al ejecutar la consulta: ' . mysqli_error($conn));
                        }
                        while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                            <tr>
                                <td><?php echo $row['Nombre']; ?></td>
                                <td><?php echo $row['Apellidos']; ?></td>
                                <td><?php echo $row['Sexo']; ?></td>
                                <td><?php echo $row['Fecha_Nacimiento']; ?></td>
                                <td><?php echo $row['Celular']; ?></td>
                                <td><?php echo $row['Correo']; ?></td>
                                <td><?php echo $row['CP']; ?></td>
                                <td><?php echo $row['Pais']; ?></td>
                                <td><?php echo $row['Estado']; ?></td>
                                <td><?php echo $row['Municipio']; ?></td>
                                <td><?php echo $row['Asentamiento']; ?></td>
                                <td><?php echo $row['Tipo_Asentamiento']; ?></td>
                                <td>
                                    <a href="generar_pdf_cliente.php?idCliente=<?php echo $row['idCliente']; ?>" class="btn btn-info btn-sm">Generar PDF</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>
