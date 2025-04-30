

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Editar Préstamo')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-hand-holding-usd"></i> <?php echo e(__('Editar Préstamo')); ?></h3>
            </div>

            <div class="card-body">
                <!-- Mostrar mensajes de error -->
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('prestamos.update', $prestamo->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- Campo: Fecha de Préstamo -->
                    <div class="form-group">
                        <label for="fecha_prestamo"><?php echo e(__('Fecha de Préstamo')); ?></label>
                        <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" value="<?php echo e($prestamo->fecha_prestamo); ?>" required>
                    </div>

                    <!-- Campo: Cantidad Prestada -->
                    <div class="form-group">
                        <label for="cantidad_prestada"><?php echo e(__('Cantidad Prestada')); ?></label>
                        <input type="number" name="cantidad_prestada" id="cantidad_prestada" class="form-control" value="<?php echo e($prestamo->cantidad_prestada); ?>" required>
                    </div>

                    <!-- Campo: Material (Combobox) -->
                    <div class="form-group">
                        <label for="material_id"><?php echo e(__('Material')); ?></label>
                        <select name="material_id" class="form-control">
                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($material->id); ?>" <?php echo e($prestamo->material_id == $material->id ? 'selected' : ''); ?>><?php echo e($material->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Campo: Almacén (Combobox) -->
                    <div class="form-group">
                        <label for="almacen_id"><?php echo e(__('Almacén')); ?></label>
                        <select name="almacen_id" id="almacen_id" class="form-control" required>
                            <?php $__currentLoopData = $almacens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $almacen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($almacen->id); ?>" <?php echo e($prestamo->almacen_id == $almacen->id ? 'selected' : ''); ?>><?php echo e($almacen->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Campo: Personal (Combobox) -->
                    <div class="form-group">
                        <label for="personal_id"><?php echo e(__('Personal')); ?></label>
                        <select name="personal_id" id="personal_id" class="form-control" required>
                            <?php $__currentLoopData = $personals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($personal->id); ?>" <?php echo e($prestamo->personal_id == $personal->id ? 'selected' : ''); ?>>
                                    <?php echo e($personal->nombre); ?> <?php echo e($personal->apellido); ?> (RP: <?php echo e($personal->RP); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Campo: Descripción -->
                    <div class="form-group">
                        <label for="descripcion"><?php echo e(__('Descripción de uso')); ?></label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required><?php echo e($prestamo->descripcion); ?></textarea>
                    </div>

                    <!-- Botón de Guardar -->
                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> <?php echo e(__('Guardar')); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/prestamo/edit.blade.php ENDPATH**/ ?>