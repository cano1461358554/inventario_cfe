

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Ingresos')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-sign-in-alt"></i> <?php echo e(__('Gestión de Ingresos')); ?></h3>
            </div>

            <div class="card-body">
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success text-center">
                        <p><?php echo e($message); ?></p>
                    </div>
                <?php endif; ?>

                <form method="GET" action="<?php echo e(route('ingresos.index')); ?>" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="fecha" class="form-control" placeholder="Buscar por fecha de ingreso..." value="<?php echo e(request('fecha')); ?>">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a href="<?php echo e(route('ingresos.index')); ?>" class="btn btn-warning">
                                <i class="fa fa-sync-alt"></i> Limpiar
                            </a>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?php echo e(route('ingresos.create')); ?>" class="btn text-white" style="background-color: #A4D65E;">
                                <i class="fa fa-plus-circle"></i> Crear Nuevo
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-white text-center" style="background-color: #00723E;">
                        <tr>

                            <th><?php echo e(__('Material')); ?></th>
                            <th><?php echo e(__('Personal')); ?></th>
                            <th><?php echo e(__('Cantidad')); ?></th>
                            <th><?php echo e(__('Fecha')); ?></th>
                            <th><?php echo e(__('Acciones')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $ingresos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingreso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td><?php echo e($ingreso->material->nombre ?? 'Sin material'); ?></td>
                                <td><?php echo e($ingreso->personal->nombre ?? 'Sin personal'); ?></td>
                                <td><?php echo e($ingreso->cantidad_ingresada); ?></td>
                                <td><?php echo e($ingreso->fecha); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('ingresos.edit', $ingreso->id)); ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <form action="<?php echo e(route('ingresos.destroy', $ingreso->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este ingreso?')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <?php echo $ingresos->links(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/ingreso/index.blade.php ENDPATH**/ ?>