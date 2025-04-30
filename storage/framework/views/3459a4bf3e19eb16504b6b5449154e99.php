

<?php $__env->startSection('template_title'); ?>
    <?php echo e($prestamo->name ?? __('Ver') . " " . __('Préstamo')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-hand-holding-usd"></i> <?php echo e(__('Detalles del Préstamo')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <!-- Botón de Volver -->
                <div class="text-end mb-4">
                    <a href="<?php echo e(route('prestamos.index')); ?>" class="btn text-white" style="background-color: #4CAF50;">
                        <i class="fa fa-arrow-left"></i> <?php echo e(__('Volver')); ?>

                    </a>
                </div>

                <!-- Detalles del Préstamo -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="fw-bold"><?php echo e(__('Fecha de Préstamo')); ?></label>
                            <p class="form-control-static"><?php echo e($prestamo->fecha_prestamo); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="fw-bold"><?php echo e(__('Descripción de Uso')); ?></label>
                            <p class="form-control-static"><?php echo e($prestamo->descripcion); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('prestamos.edit', $prestamo->id)); ?>" class="btn text-white me-2" style="background-color: #FFC107;">
                        <i class="fa fa-edit"></i> <?php echo e(__('Editar')); ?>

                    </a>
                    <form action="<?php echo e(route('prestamos.destroy', $prestamo->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn text-white" style="background-color: #DC3545;" onclick="return confirm('¿Estás seguro de eliminar este préstamo?')">
                            <i class="fa fa-trash"></i> <?php echo e(__('Eliminar')); ?>

                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/prestamo/show.blade.php ENDPATH**/ ?>