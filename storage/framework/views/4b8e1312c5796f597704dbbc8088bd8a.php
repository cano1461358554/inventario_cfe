

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Crear Personal')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-user-plus"></i> <?php echo e(__('Crear Nuevo Personal')); ?></h3>
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

                <form method="POST" action="<?php echo e(route('personals.store')); ?>" role="form">
                    <?php echo csrf_field(); ?>

                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label"><?php echo e(__('Nombre')); ?></label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo e(old('nombre')); ?>" required>
                        <?php if($errors->has('nombre')): ?>
                            <span class="text-danger"><?php echo e($errors->first('nombre')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellido" class="form-label"><?php echo e(__('Apellido')); ?></label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo e(old('apellido')); ?>" required>
                        <?php if($errors->has('apellido')): ?>
                            <span class="text-danger"><?php echo e($errors->first('apellido')); ?></span>
                        <?php endif; ?>
                    </div>









                    <div class="form-group mb-3">
                        <label for="RP" class="form-label"><?php echo e(__('RP')); ?></label>
                        <input type="text" name="RP" id="RP" class="form-control" value="<?php echo e(old('RP')); ?>" required>
                        <?php if($errors->has('RP')): ?>
                            <span class="text-danger"><?php echo e($errors->first('RP')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tipo_usuario" class="form-label"><?php echo e(__('Tipo de Usuario')); ?></label>
                        <select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Administrador" <?php echo e(old('tipo_usuario') == 'Administrador' ? 'selected' : ''); ?>>Administrador</option>
                            <option value="Supervisor" <?php echo e(old('tipo_usuario') == 'Supervisor' ? 'selected' : ''); ?>>Supervisor</option>
                            <option value="Empleado" <?php echo e(old('tipo_usuario') == 'Empleado' ? 'selected' : ''); ?>>Empleado</option>
                        </select>
                        <?php if($errors->has('tipo_usuario')): ?>
                            <span class="text-danger"><?php echo e($errors->first('tipo_usuario')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> <?php echo e(__('Guardar')); ?>

                        </button>
                        <a href="<?php echo e(route('personals.index')); ?>" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> <?php echo e(__('Cancelar')); ?>

                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/personal/create.blade.php ENDPATH**/ ?>