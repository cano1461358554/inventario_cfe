<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha_devolucion" class="form-label"><?php echo e(__('Fecha Devolucion')); ?></label>
            <input type="text" name="fecha_devolucion" class="form-control <?php $__errorArgs = ['fecha_devolucion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('fecha_devolucion', $devolucion?->fecha_devolucion)); ?>" id="fecha_devolucion" placeholder="Fecha Devolucion">
            <?php echo $errors->first('fecha_devolucion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>
        <div class="form-group mb-2 mb20">
            <label for="cantidad_devuelta" class="form-label"><?php echo e(__('Cantidad Devuelta')); ?></label>
            <input type="text" name="cantidad_devuelta" class="form-control <?php $__errorArgs = ['cantidad_devuelta'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('cantidad_devuelta', $devolucion?->cantidad_devuelta)); ?>" id="cantidad_devuelta" placeholder="Cantidad Devuelta">
            <?php echo $errors->first('cantidad_devuelta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion_estado" class="form-label"><?php echo e(__('Descripcion Estado')); ?></label>
            <input type="text" name="descripcion_estado" class="form-control <?php $__errorArgs = ['descripcion_estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('descripcion_estado', $devolucion?->descripcion_estado)); ?>" id="descripcion_estado" placeholder="Descripcion Estado">
            <?php echo $errors->first('descripcion_estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div><?php /**PATH C:\xampp\htdocs\cfe\resources\views/devolucion/form.blade.php ENDPATH**/ ?>