

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Editar Material')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-box"></i> <?php echo e(__('Editar Material')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="<?php echo e(route('materials.update', $material->id)); ?>" role="form" enctype="multipart/form-data">
                    <?php echo e(method_field('PATCH')); ?>

                    <?php echo csrf_field(); ?>

                    <!-- Campo: Nombre del Material -->
                    <div class="form-group mb-4">
                        <label for="nombre"><?php echo e(__('Nombre del Material')); ?></label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo e($material->nombre); ?>" required>
                    </div>

                    <!-- Campo: Categoría (Combobox) -->
                    <div class="form-group mb-4">
                        <label for="categoria_id"><?php echo e(__('Categoría')); ?></label>
                        <select name="categoria_id" id="categoria_id" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($categoria->id); ?>" <?php echo e($material->categoria_id == $categoria->id ? 'selected' : ''); ?>>
                                    <?php echo e($categoria->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Campo: Tipo de Material (Combobox) -->
                    <div class="form-group mb-4">
                        <label for="tipomaterial_id"><?php echo e(__('Tipo de Material')); ?></label>
                        <select name="tipomaterial_id" id="tipomaterial_id" class="form-control" required>
                            <option value="">Seleccione un tipo de material</option>
                            <?php $__currentLoopData = $tiposMaterial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoMaterial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tipoMaterial->id); ?>" <?php echo e($material->tipomaterial_id == $tipoMaterial->id ? 'selected' : ''); ?>>
                                    <?php echo e($tipoMaterial->descripcion); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Campo: Unidad de Medida (Combobox) -->
                    <div class="form-group mb-4">
                        <label for="unidadmedida_id"><?php echo e(__('Unidad de Medida')); ?></label>
                        <select name="unidadmedida_id" id="unidadmedida_id" class="form-control" required>
                            <option value="">Seleccione una unidad de medida</option>
                            <?php $__currentLoopData = $unidadesMedida; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidadMedida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($unidadMedida->id); ?>" <?php echo e($material->unidadmedida_id == $unidadMedida->id ? 'selected' : ''); ?>>
                                    <?php echo e($unidadMedida->descripcion_unidad); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Botón de Guardar y Cancelar -->
                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> <?php echo e(__('Guardar Cambios')); ?>

                        </button>
                        <a href="<?php echo e(route('materials.index')); ?>" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> <?php echo e(__('Cancelar')); ?>

                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/material/edit.blade.php ENDPATH**/ ?>