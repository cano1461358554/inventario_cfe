

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Crear Stock')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-cubes"></i> <?php echo e(__('Crear Stock')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="<?php echo e(route('stocks.store')); ?>" role="form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <!-- Campo: Cantidad -->
                    <div class="form-group mb-4">
                        <label for="cantidad"><?php echo e(__('Cantidad')); ?></label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                    </div>

                    <!-- Campo: Material (Combobox) -->
                    <div class="form-group mb-4">
                        <label for="material_id"><?php echo e(__('Material')); ?></label>
                        <select name="material_id" id="material_id" class="form-control" required>
                            <option value="">Seleccione un material</option>
                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($material->id); ?>"><?php echo e($material->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Campo: Almacén (Combobox) -->
                    <div class="form-group mb-4">
                        <label for="almacen_id"><?php echo e(__('Almacén')); ?></label>
                        <select name="almacen_id" id="almacen_id" class="form-control" required>
                            <option value="">Seleccione un almacén</option>
                            <?php $__currentLoopData = $almacens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $almacen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($almacen->id); ?>"><?php echo e($almacen->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Botón de Guardar y Cancelar -->
                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> <?php echo e(__('Guardar')); ?>

                        </button>
                        <a href="<?php echo e(route('stocks.index')); ?>" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> <?php echo e(__('Cancelar')); ?>

                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/stock/create.blade.php ENDPATH**/ ?>