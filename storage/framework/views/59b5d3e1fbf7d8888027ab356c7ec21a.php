

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Crear Préstamo')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-hand-holding-usd"></i> <?php echo e(__('Crear Nuevo Préstamo')); ?></h3>
            </div>

            <div class="card-body">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('prestamos.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="fecha_prestamo"><?php echo e(__('Fecha de Préstamo')); ?></label>
                        <input type="date" class="form-control" id="fecha_prestamo" name="fecha_prestamo"
                               value="<?php echo e(now()->format('Y-m-d')); ?>" readonly>
                        <small class="form-text text-muted">Generada automáticamente</small>
                    </div>

                    <div class="form-group">
                        <label for="cantidad_prestada"><?php echo e(__('Cantidad Prestada')); ?></label>
                        <input type="number" name="cantidad_prestada" id="cantidad_prestada"
                               class="form-control" value="<?php echo e(old('cantidad_prestada')); ?>"
                               min="0.01" step="0.01" required>
                        <?php $__errorArgs = ['cantidad_prestada'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="material_id"><?php echo e(__('Material')); ?></label>
                            <a href="<?php echo e(route('materials.create')); ?>" class="btn btn-sm btn-outline-success">
                                <i class="fa fa-plus"></i> <?php echo e(__('Nuevo Material')); ?>

                            </a>
                        </div>
                        <select name="material_id" id="material_id" class="form-control" required>
                            <option value="">Seleccione un material</option>
                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $stockTotal = $material->stocks->sum('cantidad');
                                ?>
                                <option value="<?php echo e($material->id); ?>"
                                        <?php echo e(old('material_id') == $material->id ? 'selected' : ''); ?>

                                        data-stock="<?php echo e($stockTotal); ?>">
                                    <?php echo e($material->nombre); ?> (Stock: <?php echo e($stockTotal); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <small id="stockHelp" class="form-text text-muted">
                            Solo se muestran materiales con stock disponible
                        </small>
                        <?php $__errorArgs = ['material_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="personal_id"><?php echo e(__('Personal')); ?></label>
                        <select name="personal_id" id="personal_id" class="form-control" required>
                            <option value="">Seleccione un personal</option>
                            <?php $__currentLoopData = $personals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($personal->id); ?>" <?php echo e(old('personal_id') == $personal->id ? 'selected' : ''); ?>>
                                    <?php echo e($personal->nombre); ?> <?php echo e($personal->apellido); ?> (RP: <?php echo e($personal->RP); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['personal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="descripcion"><?php echo e(__('Descripción de uso')); ?></label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required><?php echo e(old('descripcion')); ?></textarea>
                        <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> <?php echo e(__('Guardar Préstamo')); ?>

                        </button>
                        <a href="<?php echo e(route('prestamos.index')); ?>" class="btn btn-secondary ml-2">
                            <i class="fa fa-times"></i> <?php echo e(__('Cancelar')); ?>

                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const materialSelect = document.getElementById('material_id');
                const cantidadInput = document.getElementById('cantidad_prestada');

                // Validar stock al seleccionar material
                materialSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const stockDisponible = parseFloat(selectedOption.getAttribute('data-stock'));

                    // Actualizar el máximo permitido
                    cantidadInput.setAttribute('max', stockDisponible);

                    // Mostrar ayuda
                    if (selectedOption.value) {
                        document.getElementById('stockHelp').textContent =
                            `Stock disponible: ${stockDisponible}. Máximo permitido: ${stockDisponible}`;
                    } else {
                        document.getElementById('stockHelp').textContent =
                            'Solo se muestran materiales con stock disponible';
                    }
                });

                // Validar stock al enviar el formulario
                document.querySelector('form').addEventListener('submit', function(e) {
                    const selectedOption = materialSelect.options[materialSelect.selectedIndex];
                    const stockDisponible = parseFloat(selectedOption.getAttribute('data-stock'));
                    const cantidad = parseFloat(cantidadInput.value);

                    if (cantidad > stockDisponible) {
                        e.preventDefault();
                        alert(`No hay suficiente stock disponible. Stock actual: ${stockDisponible}`);
                    }
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/prestamo/create.blade.php ENDPATH**/ ?>