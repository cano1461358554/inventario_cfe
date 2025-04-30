<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFE Sistema de Inventario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 70px; /* Espacio para el navbar fijo */
        }

        /* Barra de navegación superior */
        .navbar-cfe {
            background-color: #00573F;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            color: #FFFFFF !important;
            padding: 10px 15px;
            transition: background-color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #003D2C;
            border-radius: 4px;
        }

        .dropdown-menu {
            background-color: #007A5E;
            border: none;
        }

        .dropdown-item {
            color: #FFFFFF;
        }

        .dropdown-item:hover {
            background-color: #00573F;
        }

        /* Contenido principal */
        .content {
            padding: 20px;
            background-color: #FFFFFF;
            min-height: calc(100vh - 70px);
        }

        /* Estilos para las tablas */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #00723E;
            color: #FFFFFF;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Menú hamburguesa en móviles */
        .navbar-toggler {
            border-color: rgba(255,255,255,0.5);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        /* Estilos personalizados para préstamos */
        .bg-custom-green {
            background-color: #00723E;
        }
        .bg-custom-light-green {
            background-color: #A4D65E;
        }
        .btn-custom-green {
            background-color: #4CAF50;
            color: white;
        }
        .btn-custom-light-green {
            background-color: #A4D65E;
            color: white;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .card-header {
            font-weight: bold;
        }
        .close {
            color: white;
            opacity: 1;
        }
    </style>
</head>
<body>

<!-- Barra de navegación superior -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-cfe">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">CFE Inventario</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <!-- Menú Movimientos -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="movimientosDropdown" data-toggle="dropdown">
                        <i class="fas fa-exchange-alt"></i> Movimientos
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="prestamos">Préstamos</a>
                        <a class="dropdown-item" href="resguardos">Resguardos</a>
                        <a class="dropdown-item" href="ingresos">Ingresos</a>
                    </div>
                </li>

                <!-- Menú Materiales -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="materialesDropdown" data-toggle="dropdown">
                        <i class="fas fa-boxes"></i> Materiales
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="almacens">Almacenes</a>
                        <a class="dropdown-item" href="materials">Materiales</a>
                        <a class="dropdown-item" href="stocks">Stocks</a>
                    </div>
                </li>

                <!-- Menú Tipos -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="tiposDropdown" data-toggle="dropdown">
                        <i class="fas fa-tags"></i> Tipos
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="personals">Usuarios</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="confirmLogout(event)">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido principal -->
<div class="content">
    <div class="container mt-3 mb-5">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white bg-custom-green">
                <h3 class="mb-0"><i class="fa fa-hand-holding-usd"></i> Gestión de Préstamos</h3>
            </div>

            <div class="card-body">
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success text-center">
                        <p><?php echo e($message); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Filtro de búsqueda -->
                <form method="GET" action="<?php echo e(route('prestamos.index')); ?>" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="persona" class="form-control"
                                   placeholder="Buscar por nombre o apellido"
                                   value="<?php echo e(request('persona')); ?>">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn text-white btn-custom-green">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a href="<?php echo e(route('prestamos.index')); ?>" class="btn btn-warning">
                                <i class="fa fa-sync-alt"></i> Limpiar
                            </a>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?php echo e(route('prestamos.create')); ?>" class="btn btn-custom-light-green text-white">
                                <i class="fa fa-plus-circle"></i> Crear Nuevo
                            </a>
                        </div>
                    </div>
                    <!-- opción para mostrar solo coincidencias -->
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="mostrar_coincidencias" name="mostrar_coincidencias"
                               <?php echo e(request('mostrar_coincidencias') ? 'checked' : ''); ?>

                               onchange="this.form.submit()">
                        <label class="form-check-label" for="mostrar_coincidencias">Mostrar solo coincidencias</label>
                    </div>
                </form>

                <!-- tabla de préstamos -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-white text-center" style="background-color: #00723E;">
                        <tr>
                            <th>Fecha Préstamo</th>
                            <th>Cantidad Prestada</th>
                            <th>Cantidad Devuelta</th>
                            <th>Pendiente</th>
                            <th>Estado</th>
                            <th>Material</th>
                            <th>Personal</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $prestamos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prestamo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $cantidadDevuelta = $prestamo->devolucions->sum('cantidad_devuelta');
                                $cantidadPendiente = $prestamo->cantidad_prestada - $cantidadDevuelta;
                                $completamenteDevuelto = $cantidadPendiente <= 0;
                            ?>

                            <tr class="<?php echo e($completamenteDevuelto ? 'table-success' : ''); ?>">
                                <td><?php echo e($prestamo->fecha_prestamo); ?></td>
                                <td><?php echo e($prestamo->cantidad_prestada); ?></td>
                                <td><?php echo e($cantidadDevuelta); ?></td>
                                <td><?php echo e($cantidadPendiente); ?></td>
                                <td class="text-center">
                                    <?php if($completamenteDevuelto): ?>
                                        <span class="badge bg-success">Completo</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($prestamo->material->nombre ?? 'Sin material'); ?></td>
                                <td><?php echo e($prestamo->personal->nombre ?? 'Sin personal'); ?> <?php echo e($prestamo->personal->apellido ?? ''); ?></td>
                                <td><?php echo e($prestamo->descripcion); ?></td>
                                <td class="text-center">
                                    <!-- Botón para devolución (solo mostrar si hay pendiente) -->
                                    <?php if(!$completamenteDevuelto): ?>
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#devolucionModal"
                                                data-prestamo-id="<?php echo e($prestamo->id); ?>"
                                                data-material="<?php echo e($prestamo->material->nombre ?? 'Sin material'); ?>"
                                                data-cantidad="<?php echo e($cantidadPendiente); ?>"
                                                data-personal="<?php echo e($prestamo->personal->nombre ?? 'Sin personal'); ?> <?php echo e($prestamo->personal->apellido ?? ''); ?>"
                                                data-descripcion="<?php echo e($prestamo->descripcion); ?>">
                                            <i class="fa fa-undo"></i> Devolver
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center text-danger"><strong>No hay préstamos registrados.</strong></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <?php echo $prestamos->withQueryString()->links(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para devoluciones -->
<div class="modal fade" id="devolucionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-custom-green">
                <h5 class="modal-title"><i class="fa fa-undo"></i> Registrar Devolución</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="devolucionForm" action="<?php echo e(route('devolucions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="prestamo_id" id="prestamo_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Material:</label>
                                <input type="text" class="form-control" id="modal_material" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cantidad Prestada:</label>
                                <input type="text" class="form-control" id="modal_cantidad" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Personal:</label>
                                <input type="text" class="form-control" id="modal_personal" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descripción:</label>
                                <input type="text" class="form-control" id="modal_descripcion" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad_devuelta">Cantidad a Devolver:</label>
                                <input type="number" name="cantidad_devuelta" id="cantidad_devuelta"
                                       class="form-control" required min="1">
                                <small class="form-text text-muted">No puede exceder la cantidad prestada</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_devolucion">Fecha de Devolución:</label>
                                <input type="date" name="fecha_devolucion" id="fecha_devolucion"
                                       class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion_estado">Estado del Material:</label>
                        <textarea name="descripcion_estado" id="descripcion_estado" class="form-control"
                                  rows="3" required placeholder="Describa el estado del material devuelto"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn text-white btn-custom-green">
                        <i class="fa fa-save"></i> Guardar Devolución
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<script>
    function confirmLogout(event) {
        event.preventDefault();
        if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
            document.getElementById('logout-form').submit();
        }
    }

    $(document).ready(function() {
        // Cuando se abre el modal
        $('#devolucionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var prestamoId = button.data('prestamo-id');
            var material = button.data('material');
            var cantidad = button.data('cantidad');
            var personal = button.data('personal');
            var descripcion = button.data('descripcion');

            var modal = $(this);
            modal.find('#prestamo_id').val(prestamoId);
            modal.find('#modal_material').val(material);
            modal.find('#modal_cantidad').val(cantidad);
            modal.find('#modal_personal').val(personal);
            modal.find('#modal_descripcion').val(descripcion);

            // Establecer el máximo para la cantidad a devolver
            $('#cantidad_devuelta').attr('max', cantidad);
        });

        // Validación del formulario antes de enviar
        $('#devolucionForm').submit(function(e) {
            const cantidadDevuelta = parseInt($('#cantidad_devuelta').val());
            const cantidadPrestada = parseInt($('#modal_cantidad').val());

            if (cantidadDevuelta > cantidadPrestada) {
                alert('La cantidad devuelta no puede ser mayor que la cantidad prestada');
                e.preventDefault();
                return false;
            }

            if (cantidadDevuelta <= 0) {
                alert('La cantidad devuelta debe ser mayor que cero');
                e.preventDefault();
                return false;
            }

            if ($('#descripcion_estado').val().trim() === '') {
                alert('Debe describir el estado del material devuelto');
                e.preventDefault();
                return false;
            }

            return true;
        });
    });
</script>

<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\cfe\resources\views/prestamo/index.blade.php ENDPATH**/ ?>