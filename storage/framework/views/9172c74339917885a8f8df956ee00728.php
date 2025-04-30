

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Detalles del Resguardo')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-shield-alt"></i> <?php echo e(__('Detalles del Resguardo')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <!-- Botón de Volver -->
                <div class="text-end mb-4">
                    <a href="<?php echo e(route('resguardos.index')); ?>" class="btn text-white" style="background-color: #4CAF50;">
                        <i class="fa fa-arrow-left"></i> <?php echo e(__('Volver')); ?>

                    </a>
                </div>

                <!-- Detalles del Resguardo -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="fw-bold"><?php echo e(__('Fecha de Resguardo')); ?></label>
                            <p class="form-control-static"><?php echo e($resguardo->fecha_resguardo); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="fw-bold"><?php echo e(__('Estado')); ?></label>
                            <p class="form-control-static"><?php echo e($resguardo->estado); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('resguardos.edit', $resguardo->id)); ?>" class="btn text-white me-2" style="background-color: #FFC107;">
                        <i class="fa fa-edit"></i> <?php echo e(__('Editar')); ?>

                    </a>
                    <form action="<?php echo e(route('resguardos.destroy', $resguardo->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn text-white" style="background-color: #DC3545;" onclick="return confirm('¿Estás seguro de eliminar este resguardo?')">
                            <i class="fa fa-trash"></i> <?php echo e(__('Eliminar')); ?>

                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/resguardo/show.blade.php ENDPATH**/ ?>