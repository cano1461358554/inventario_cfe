

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Crear Devolución')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-undo"></i> <?php echo e(__('Crear Nueva Devolución')); ?></h3>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo e(route('devolucions.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="prestamo_id"><?php echo e(__('Préstamo')); ?></label>
                        <select name="prestamo_id" id="prestamo_id" class="form-control" required>
                            <option value="">Seleccione un préstamo</option>
                            <?php $__currentLoopData = $prestamos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prestamo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prestamo->id); ?>">
                                    Préstamo #<?php echo e($prestamo->id); ?> - <?php echo e($prestamo->desc_uso); ?> (<?php echo e($prestamo->fecha_prestamo); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>























                    <!-- Campo para la fecha de devolución -->




                    <div class="form-group">
                        <label for="fecha_devolucion">Fecha de Devolución</label>
                        <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion"
                               value="<?php echo e(now()->toDateString()); ?>" readonly>
                        <small class="form-text text-muted">Generada automáticamente</small>
                    </div>

                    <div class="form-group">
                        <label for="cantidad_devuelta"><?php echo e(__('Cantidad Devuelta')); ?></label>
                        <input type="number" name="cantidad_devuelta" id="cantidad_devuelta" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion_estado"><?php echo e(__('Descripción del Estado')); ?></label>
                        <input type="text" name="descripcion_estado" id="descripcion_estado" class="form-control" required>
                    </div>

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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/devolucion/create.blade.php ENDPATH**/ ?>