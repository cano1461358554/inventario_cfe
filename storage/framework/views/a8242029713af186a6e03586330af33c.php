

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Crear Tipo de Material')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-plus-circle"></i> <?php echo e(__('Nuevo Tipo de Material')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="<?php echo e(route('tipo-materials.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <!-- Campo: Descripción del Tipo de Material -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label"><strong>Descripción del Tipo de Material:</strong></label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Ej. Plástico, Metal, Vidrio, etc." value="<?php echo e(old('descripcion')); ?>" required>
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

                    <!-- Botones de Acción -->
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo e(route('tipo-materials.index')); ?>" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> Guardar Tipo de Material
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/tipo-material/create.blade.php ENDPATH**/ ?>