<?php
include 'db.php';

// Agregar empleado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    $nombre = $_POST['nombre'];
    $puesto = $_POST['puesto'];
    $salario = $_POST['salario'];
    $fecha_ingreso = $_POST['fecha_ingreso'];

    $stmt = $pdo->prepare("INSERT INTO empleados (nombre, puesto, salario, fecha_ingreso) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $puesto, $salario, $fecha_ingreso]);

    echo 'Empleado agregado';
    exit;
}

// Baja de empleado
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("UPDATE empleados SET estatus = 0 WHERE id = ?");
    $stmt->execute([$id]);

    echo 'Empleado eliminado';
    exit;
}

// Mostrar empleados
$stmt = $pdo->query("SELECT * FROM empleados WHERE estatus = 1");
$empleados = $stmt->fetchAll();

foreach ($empleados as $empleado) {
    echo "<tr>
            <td>{$empleado['id']}</td>
            <td>{$empleado['nombre']}</td>
            <td>{$empleado['puesto']}</td>
            <td>{$empleado['salario']}</td>
            <td>{$empleado['fecha_ingreso']}</td>
            <td><button class='btn btn-danger delete-btn' data-id='{$empleado['id']}'>Eliminar</button></td>
          </tr>";
}
?>
