<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php'; // Asegúrate de que PhpSpreadsheet esté correctamente instalado

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDO;

$dsn = 'mysql:host=localhost;dbname=empleados_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los empleados
    $stmt = $pdo->query('SELECT * FROM empleados WHERE estatus = 0'); // Suponiendo que 'baja_logica' es un campo de baja lógica
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Agregar encabezados
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Nombre');
    $sheet->setCellValue('C1', 'Puesto');
    $sheet->setCellValue('D1', 'Salario');
    $sheet->setCellValue('E1', 'Fecha de Ingreso');
    
    // Llenar datos de los empleados
    $row = 2;
    foreach ($empleados as $empleado) {
        $sheet->setCellValue('A' . $row, $empleado['id']);
        $sheet->setCellValue('B' . $row, $empleado['nombre']);
        $sheet->setCellValue('C' . $row, $empleado['puesto']);
        $sheet->setCellValue('D' . $row, $empleado['salario']);
        $sheet->setCellValue('E' . $row, $empleado['fecha_ingreso']);
        $row++;
    }

    // Crear archivo Excel
    $writer = new Xlsx($spreadsheet);
    $filePath = 'reporte_empleados_' . time() . '.xlsx';
    $writer->save($filePath);

    // Retornar el archivo para que el usuario lo descargue
    echo $filePath;

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
