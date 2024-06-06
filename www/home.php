<?php include("config/db.php"); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<?php include('includes/header.php'); ?>
<div class="container-fluid vh-100 d-flex flex-column align-items-center justify-content-center">
    <h1 class="title">Elite Athletic - E | A</h1>
    <div class="row flex-grow-1 w-100">
        <div class="col-md-6 d-flex align-items-end justify-content-center p-0 position-relative bg-image1">
            <button class="btn btn-light btn-custom" onclick="location.href='inventario.php'">Inventario</button>
        </div>
        <div class="col-md-6 d-flex align-items-end justify-content-center p-0 position-relative bg-image2">
            <button class="btn btn-light btn-custom" onclick="location.href='clientes.php'"> Clientes </button>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>