<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">CRUD de Empleados</h2>
        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Agregar Empleado</button>
        <button class="btn btn-success my-3" id="btnGenerarExcel">Generar Reporte Bajas</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Salario</th>
                    <th>Fecha de Ingreso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="empleadosTable">
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Nuevo Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="puesto" class="form-label">Puesto</label>
                            <input type="text" class="form-control" id="puesto" required>
                        </div>
                        <div class="mb-3">
                            <label for="salario" class="form-label">Salario</label>
                            <input type="number" class="form-control" id="salario" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_ingreso" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            loadEmpleados();

            function loadEmpleados() {
                $.ajax({
                    url: 'empleados.php',
                    method: 'GET',
                    success: function(data) {
                        $('#empleadosTable').html(data);
                    }
                });
            }

            $('#addEmployeeForm').submit(function(e) {
                e.preventDefault();

                const nombre = $('#nombre').val();
                const puesto = $('#puesto').val();
                const salario = $('#salario').val();
                const fecha_ingreso = $('#fecha_ingreso').val();

                $.ajax({
                    url: 'empleados.php',
                    method: 'POST',
                    data: { 
                        nombre: nombre, 
                        puesto: puesto, 
                        salario: salario, 
                        fecha_ingreso: fecha_ingreso 
                    },
                    success: function() {
                        $('#addEmployeeModal').modal('hide');
                        loadEmpleados();
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: 'empleados.php',
                    method: 'POST',
                    data: { id: id, action: 'delete' },
                    success: function() {
                        loadEmpleados();
                    }
                });
            });

+            $('#btnGenerarExcel').click(function() {
                $.ajax({
                    url: 'generar_excel.php',
                    method: 'GET',
                    success: function(response) {
                        window.location.href = response;
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
