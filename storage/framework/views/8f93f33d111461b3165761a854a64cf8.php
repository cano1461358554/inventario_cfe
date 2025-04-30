<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="cantidad_ingresada" class="form-label"><?php echo e(__('Cantidad Ingresada')); ?></label>
            <input type="text" name="cantidad_ingresada" class="form-control <?php $__errorArgs = ['cantidad_ingresada'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('cantidad_ingresada', $ingreso?->cantidad_ingresada)); ?>" id="cantidad_ingresada" placeholder="Cantidad Ingresada">
            <?php echo $errors->first('cantidad_ingresada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label"><?php echo e(__('Fecha')); ?></label>
            <input type="text" name="fecha" class="form-control <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('fecha', $ingreso?->fecha)); ?>" id="fecha" placeholder="Fecha">
            <?php echo $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div><?php /**PATH C:\xampp\htdocs\cfe\resources\views/ingreso/form.blade.php ENDPATH**/ ?>