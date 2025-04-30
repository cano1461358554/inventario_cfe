

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Mostrar Almacén')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-eye"></i> <?php echo e(__('Mostrar Almacén')); ?></h3>
            </div>

            <div class="card-body bg-white">
                <div class="mb-3">
                    <label for="nombre" class="form-label"><strong>Nombre del Almacén:</strong></label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo e($almacen->nombre); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="ubicacion" class="form-label"><strong>Ubicación:</strong></label>
                    <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="<?php echo e($almacen->ubicacion->ubicacion); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Materiales en el Almacén:</strong></label>
                    <?php if($almacen->materials->isEmpty()): ?>
                        <p>No hay materiales en este almacén.</p>
                    <?php else: ?>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre del Material</th>
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $almacen->materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($material->nombre); ?></td>
                                    <td><?php echo e($material->pivot->cantidad); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?php echo e(route('almacens.index')); ?>" class="btn btn-warning">
                        <i class="fa fa-arrow-left"></i> <?php echo e(__('Volver')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/almacen/show.blade.php ENDPATH**/ ?>