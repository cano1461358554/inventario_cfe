

<?php $__env->startSection('template_title'); ?>
    <?php echo e($material->nombre ?? __('Detalles del Material')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-box"></i> <?php echo e(__('Detalles del Material')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <!-- Campo: Nombre del Material -->
                <div class="form-group mb-4">
                    <label for="nombre" class="form-label"><strong><?php echo e(__('Nombre del Material')); ?></strong></label>
                    <p><?php echo e($material->nombre); ?></p>
                </div>

                <!-- Campo: Categoría -->
                <div class="form-group mb-4">
                    <label for="categoria_id" class="form-label"><strong><?php echo e(__('Categoría')); ?></strong></label>
                    <p><?php echo e($material->categoria->nombre ?? 'Sin categoría'); ?></p>
                </div>

                <!-- Campo: Tipo de Material -->
                <div class="form-group mb-4">
                    <label for="tipomaterial_id" class="form-label"><strong><?php echo e(__('Tipo de Material')); ?></strong></label>
                    <p><?php echo e($material->tipomaterial->descripcion ?? 'Sin tipo de material'); ?></p>
                </div>

                <!-- Campo: Unidad de Medida -->
                <div class="form-group mb-4">
                    <label for="unidadmedida_id" class="form-label"><strong><?php echo e(__('Unidad de Medida')); ?></strong></label>
                    <p><?php echo e($material->unidadmedida->descripcion_unidad ?? 'Sin unidad de medida'); ?></p>
                </div>

                <!-- Botón de Regresar -->
                <div class="text-center">
                    <a href="<?php echo e(route('materials.index')); ?>" class="btn text-white" style="background-color: #4CAF50;">
                        <i class="fa fa-arrow-left"></i> <?php echo e(__('Regresar')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/material/show.blade.php ENDPATH**/ ?>