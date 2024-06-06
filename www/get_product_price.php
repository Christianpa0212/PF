<?php
include('config/db.php');

if (isset($_GET['idProducto'])) {
    $idProducto = $_GET['idProducto'];

    $query = "SELECT PrecioVenta FROM Productos WHERE idProducto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    echo json_encode($product);
}
?>
