<?php
require 'libs/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Puesto');
$sheet->setCellValue('D1', 'Salario');
$sheet->setCellValue('E1', 'Fecha de Ingreso');

$stmt = $pdo->query("SELECT * FROM empleados WHERE estatus = 1");
$row = 2;
while ($empleado = $stmt->fetch()) {
    $sheet->setCellValue('A' . $row, $empleado['id']);
    $sheet->setCellValue('B' . $row, $empleado['nombre']);
    $sheet->setCellValue('C' . $row, $empleado['puesto']);
    $sheet->setCellValue('D' . $row, $empleado['salario']);
    $sheet->setCellValue('E' . $row, $empleado['fecha_ingreso']);
    $row++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('reporte_empleados.xlsx');
?>
