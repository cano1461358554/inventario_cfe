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
            padding-top: <?php echo e(request()->is('/') || request()->is('login*') || request()->is('register*') ? '0' : '70px'); ?>;
        }

        /* Barra de navegación superior */
        .navbar-cfe {
            background-color: #00573F;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: <?php echo e(request()->is('/') || request()->is('login*') || request()->is('register*') ? 'none' : 'block'); ?> !important;
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
            min-height: calc(100vh - <?php echo e(request()->is('/') || request()->is('login*') || request()->is('register*') ? '0' : '70px'); ?>);
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
            background-color: #00573F;
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

        /* Estilos para el contenido activo */
        .active-menu-item {
            background-color: #003D2C;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<!-- Barra de navegación superior -->
<?php if (! (request()->is('/') || request()->is('login*') || request()->is('register*'))): ?>
    <?php
        $userRole = auth()->user()->rol; // Asegúrate que esto coincida con tu campo de rol
        $isEmpleado = $userRole === 'empleado';
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-cfe">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">CFE Inventario</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mr-auto">
                    <!-- Menú Movimientos -->
                    <?php if(!$isEmpleado || request()->is('prestamos*')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo e(request()->is('prestamos*') || request()->is('ingresos*') ? 'active-menu-item' : ''); ?>"
                               href="#" id="movimientosDropdown" data-toggle="dropdown">
                                <i class="fas fa-exchange-alt"></i> Movimientos
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item <?php echo e(request()->is('prestamos*') ? 'active' : ''); ?>"
                                   href="<?php echo e(route('prestamos.index')); ?>">Préstamos</a>

                                <?php if(!$isEmpleado): ?>


                                    <a class="dropdown-item <?php echo e(request()->is('ingresos*') ? 'active' : ''); ?>"
                                       href="<?php echo e(route('ingresos.index')); ?>">Ingresos</a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('prestamos*') ? 'active-menu-item' : ''); ?>"
                               href="<?php echo e(route('prestamos.index')); ?>">
                                <i class="fas fa-exchange-alt"></i> Préstamos
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Menú Materiales -->
                    <?php if(!$isEmpleado || request()->is('materials*')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo e(request()->is('almacens*') || request()->is('materials*') || request()->is('stocks*') ? 'active-menu-item' : ''); ?>"
                               href="#" id="materialesDropdown" data-toggle="dropdown">
                                <i class="fas fa-boxes"></i> Materiales
                            </a>
                            <div class="dropdown-menu">
                                <?php if(!$isEmpleado): ?>
                                    <a class="dropdown-item <?php echo e(request()->is('almacens*') ? 'active' : ''); ?>"
                                       href="<?php echo e(route('almacens.index')); ?>">Almacenes</a>
                                    <a class="dropdown-item <?php echo e(request()->is('stocks*') ? 'active' : ''); ?>"
                                       href="<?php echo e(route('stocks.index')); ?>">Stocks</a>
                                <?php endif; ?>
                                <a class="dropdown-item <?php echo e(request()->is('materials*') ? 'active' : ''); ?>"
                                   href="<?php echo e(route('materials.index')); ?>">Materiales</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('materials*') ? 'active-menu-item' : ''); ?>"
                               href="<?php echo e(route('materials.index')); ?>">
                                <i class="fas fa-boxes"></i> Materiales
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Menú Administración - Solo para no empleados -->
                    <?php if(!$isEmpleado): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo e(request()->is('personals*') ? 'active-menu-item' : ''); ?>"
                               href="#" id="adminDropdown" data-toggle="dropdown">
                                <i class="fas fa-users-cog"></i> Administración
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item <?php echo e(request()->is('personals*') ? 'active' : ''); ?>"
                                   href="<?php echo e(route('personals.index')); ?>">Usuarios</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link text-white">
                            <i class="fas fa-user-tag"></i> <?php echo e(ucfirst($userRole)); ?>

                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php endif; ?>

<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>

<!-- Contenido principal -->
<div class="content">
    <?php echo $__env->yieldContent('content'); ?>
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

    // Resaltar elemento activo en el menú
    $(document).ready(function() {
        // Para elementos del dropdown
        $('.dropdown-item').filter(function() {
            return this.href == location.href.replace(/#.*/, "");
        }).addClass('active').closest('.dropdown-menu').prev().addClass('active-menu-item');

        // Mostrar menú si no estamos en home, login o register
        if(!(window.location.pathname === '/' ||
            window.location.pathname === '/home' ||
            window.location.pathname.startsWith('/login') ||
            window.location.pathname.startsWith('/register'))) {
            $('.navbar-cfe').show();
            $('body').css('padding-top', '70px');
            $('.content').css('min-height', 'calc(100vh - 70px)');
        }
    });
</script>

<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\cfe\resources\views/layouts/app.blade.php ENDPATH**/ ?>