

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <?php if(session('status')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('status')); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
            <div class="alert alert-primary"><i class="fas fa-user-shield mr-2"></i><strong>Bienvenido administrador.</strong></div>
            <?php elseif (\Illuminate\Support\Facades\Blade::check('role', 'encargado')): ?>
            <div class="alert alert-success"><i class="fas fa-user-cog mr-2"></i><strong>Bienvenido encargado, buen trabajo.</strong></div>
            <?php elseif (\Illuminate\Support\Facades\Blade::check('role', 'empleado')): ?>
            <div class="alert alert-info"><i class="fas fa-user mr-2"></i><strong>Entraste como empleado, solo podrás ver tus cosas.</strong></div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-cfe text-white">
                            <h4 class="mb-0"><?php echo e(__('Bienvenido al Sistema de Inventario CFE')); ?></h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- Tarjeta de Movimientos -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 border-cfe">
                                        <div class="card-header bg-cfe-light text-white">
                                            <h5 class="card-title mb-0"><i class="fas fa-exchange-alt mr-2"></i>Movimientos</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><a href="prestamos" class="text-cfe"><i class="fas fa-hand-holding mr-2"></i>Préstamos</a></li>
                                                <li class="list-group-item"><a href="resguardos" class="text-cfe"><i class="fas fa-shield-alt mr-2"></i>Resguardos</a></li>
                                                <li class="list-group-item"><a href="ingresos" class="text-cfe"><i class="fas fa-sign-in-alt mr-2"></i>Ingresos</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tarjeta de Materiales -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 border-cfe">
                                        <div class="card-header bg-cfe-light text-white">
                                            <h5 class="card-title mb-0"><i class="fas fa-boxes mr-2"></i>Materiales</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><a href="almacens" class="text-cfe"><i class="fas fa-warehouse mr-2"></i>Almacenes</a></li>
                                                <li class="list-group-item"><a href="materials" class="text-cfe"><i class="fas fa-box-open mr-2"></i>Materiales</a></li>
                                                <li class="list-group-item"><a href="stocks" class="text-cfe"><i class="fas fa-clipboard-list mr-2"></i>Stocks</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tarjeta de Usuarios -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 border-cfe">
                                        <div class="card-header bg-cfe-light text-white">
                                            <h5 class="card-title mb-0"><i class="fas fa-tags mr-2"></i>Administración</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><a href="personals" class="text-cfe"><i class="fas fa-users mr-2"></i>Usuarios</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info mt-4">
                                <i class="fas fa-info-circle mr-2"></i> <?php echo e(__('Has iniciado sesión correctamente. Selecciona una opción del menú para comenzar.')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-cfe {
            background-color: #00573F !important;
        }

        .bg-cfe-light {
            background-color: #007A5E !important;
        }

        .border-cfe {
            border: 1px solid #00573F !important;
        }

        .text-cfe {
            color: #00573F !important;
            transition: all 0.3s;
        }

        .text-cfe:hover {
            color: #003D2C !important;
            text-decoration: none;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .list-group-item {
            transition: background-color 0.3s;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }

        .alert-primary {
            background-color: #cce5ff;
            border-color: #b8daff;
            color: #004085;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/home.blade.php ENDPATH**/ ?>