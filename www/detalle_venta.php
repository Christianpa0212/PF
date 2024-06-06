<?php
require('fpdf/fpdf.php');
include('config/db.php');

if (isset($_GET['idVenta'])) {
    $idVenta = $_GET['idVenta'];


    $queryVenta = "SELECT v.idVenta, CONCAT(p.Nombre, ' ', p.Apellidos) AS Cliente, v.Total, v.Fecha 
                   FROM Ventas v 
                   JOIN Clientes c ON v.idCliente = c.idCliente 
                   JOIN Personas p ON c.idPersona = p.idPersona 
                   WHERE v.idVenta = ?";
    $stmtVenta = $conn->prepare($queryVenta);
    $stmtVenta->bind_param("i", $idVenta);
    $stmtVenta->execute();
    $resultVenta = $stmtVenta->get_result();
    $venta = $resultVenta->fetch_assoc();


    $queryDetalles = "SELECT dv.Cantidad, p.Nombre, dv.PrecioVenta, dv.Total 
                      FROM DetallesVenta dv 
                      JOIN Productos p ON dv.idProducto = p.idProducto 
                      WHERE dv.idVenta = ?";
    $stmtDetalles = $conn->prepare($queryDetalles);
    $stmtDetalles->bind_param("i", $idVenta);
    $stmtDetalles->execute();
    $resultDetalles = $stmtDetalles->get_result();


    $pdf = new FPDF();
    $pdf->AddPage();


    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Detalle de Venta', 0, 1, 'C');


    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'ID Venta: ' . $venta['idVenta'], 0, 1);
    $pdf->Cell(0, 10, 'Cliente: ' . $venta['Cliente'], 0, 1);
    $pdf->Cell(0, 10, 'Fecha: ' . $venta['Fecha'], 0, 1);
    $pdf->Cell(0, 10, 'Total: $' . number_format($venta['Total'], 2), 0, 1);

    $pdf->Cell(0, 10, '', 0, 1);


    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Cantidad', 1);
    $pdf->Cell(80, 10, 'Producto', 1);
    $pdf->Cell(35, 10, 'Precio', 1);
    $pdf->Cell(35, 10, 'Total', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    while ($detalle = $resultDetalles->fetch_assoc()) {
        $pdf->Cell(40, 10, $detalle['Cantidad'], 1);
        $pdf->Cell(80, 10, $detalle['Nombre'], 1);
        $pdf->Cell(35, 10, '$' . number_format($detalle['PrecioVenta'], 2), 1);
        $pdf->Cell(35, 10, '$' . number_format($detalle['Total'], 2), 1);
        $pdf->Ln();
    }

    $pdf->Output();
} else {
    echo "ID de Venta no proporcionado.";
}
?>
