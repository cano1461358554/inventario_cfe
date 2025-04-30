

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Crear Resguardo')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-shield-alt"></i> <?php echo e(__('Crear Nuevo Resguardo')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="<?php echo e(route('resguardos.store')); ?>" role="form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="fecha_resguardo">Fecha de Resguardo</label>
                        <input type="date" class="form-control" id="fecha_resguardo" name="fecha_resguardo"
                               value="<?php echo e(now()->toDateString()); ?>" readonly>
                        <small class="form-text text-muted">Generada automáticamente</small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="estado"><?php echo e(__('Estado')); ?></label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="personal_id"><?php echo e(__('Personal')); ?></label>
                        <select name="personal_id" id="personal_id" class="form-control" required
                                onchange="cargarPrestamos(this.value)">
                            <option value="">Seleccione un personal</option>
                            <?php $__currentLoopData = $personals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($personal->id); ?>">
                                    <?php echo e($personal->nombre); ?> <?php echo e($personal->apellido); ?> (RP: <?php echo e($personal->RP); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="prestamo_id"><?php echo e(__('Préstamo Relacionado')); ?></label>
                        <select name="prestamo_id" id="prestamo_id" class="form-control" required disabled>
                            <option value="">Primero seleccione un personal</option>
                            <?php $__currentLoopData = $prestamos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prestamo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prestamo->id); ?>">
                                    Préstamo #<?php echo e($prestamo->id); ?> (<?php echo e($prestamo->desc_uso); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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

    <?php $__env->startSection('scripts'); ?>
        <script>
            function cargarPrestamos(personalId) {
                if (!personalId) {
                    $('#prestamo_id').html('<option value="">Primero seleccione un personal</option>');
                    $('#prestamo_id').prop('disabled', true);
                    return;
                }

                $.get('/prestamos-por-personal/' + personalId, function(data) {
                    $('#prestamo_id').html('<option value="">Seleccione un préstamo</option>');

                    $.each(data, function(key, prestamo) {
                        $('#prestamo_id').append(
                            `<option value="${prestamo.id}">
                            Préstamo #${prestamo.id} (${prestamo.desc_uso})
                        </option>`
                        );
                    });

                    $('#prestamo_id').prop('disabled', false);
                });
            }
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/resguardo/create.blade.php ENDPATH**/ ?>