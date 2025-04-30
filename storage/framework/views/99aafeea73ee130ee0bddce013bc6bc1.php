

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Actualizar Almacén')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-edit"></i> <?php echo e(__('Editar Almacén')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="<?php echo e(route('almacens.update', $almacen->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label"><strong>Nombre del Almacén:</strong></label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo e($almacen->nombre); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="ubicacion" class="form-label"><strong>Ubicación:</strong></label>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="<?php echo e($almacen->ubicacion); ?>" required>
                    </div>






                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo e(route('almacens.index')); ?>" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> Actualizar Almacén
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/almacen/edit.blade.php ENDPATH**/ ?>