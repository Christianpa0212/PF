<?php
require('fpdf/fpdf.php');
include('config/db.php');

if (isset($_GET['idCliente'])) {
    $idCliente = $_GET['idCliente'];


    $queryCliente = "SELECT c.idCliente, p.Nombre, p.Apellidos, p.Sexo, p.Fecha_Nacimiento, p.CP, p.Celular, c.Correo, c.Pais, c.Estado, c.Municipio, c.Asentamiento, c.Tipo_Asentamiento 
                     FROM Clientes c 
                     JOIN Personas p ON c.idPersona = p.idPersona 
                     WHERE c.idCliente = ?";
    $stmtCliente = $conn->prepare($queryCliente);
    $stmtCliente->bind_param("i", $idCliente);
    $stmtCliente->execute();
    $resultCliente = $stmtCliente->get_result();
    $cliente = $resultCliente->fetch_assoc();

    $pdf = new FPDF();
    $pdf->AddPage();

    
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Detalle del Cliente', 0, 1, 'C');

   
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'ID Cliente: ' . $cliente['idCliente'], 0, 1);
    $pdf->Cell(0, 10, 'Nombre: ' . $cliente['Nombre'], 0, 1);
    $pdf->Cell(0, 10, 'Apellidos: ' . $cliente['Apellidos'], 0, 1);
    $pdf->Cell(0, 10, 'Sexo: ' . $cliente['Sexo'], 0, 1);
    $pdf->Cell(0, 10, 'Fecha de Nacimiento: ' . $cliente['Fecha_Nacimiento'], 0, 1);
    $pdf->Cell(0, 10, 'CP: ' . $cliente['CP'], 0, 1);
    $pdf->Cell(0, 10, 'Celular: ' . $cliente['Celular'], 0, 1);
    $pdf->Cell(0, 10, 'Correo: ' . $cliente['Correo'], 0, 1);
    $pdf->Cell(0, 10, 'Pais: ' . $cliente['Pais'], 0, 1);
    $pdf->Cell(0, 10, 'Estado: ' . $cliente['Estado'], 0, 1);
    $pdf->Cell(0, 10, 'Municipio: ' . $cliente['Municipio'], 0, 1);
    $pdf->Cell(0, 10, 'Asentamiento: ' . $cliente['Asentamiento'], 0, 1);
    $pdf->Cell(0, 10, 'Tipo de Asentamiento: ' . $cliente['Tipo_Asentamiento'], 0, 1);

    
    $pdf->Output();
} else {
    echo "ID de Cliente no proporcionado.";
}
?>
