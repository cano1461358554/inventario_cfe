

<?php $__env->startSection('template_title'); ?>
    <?php echo e($devolucion->name ?? __('Show') . " " . __('Devolucion')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title"><?php echo e(__('Show')); ?> Devolucion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('devolucions.index')); ?>"> <?php echo e(__('Back')); ?></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Devolucion:</strong>
                                    <?php echo e($devolucion->fecha_devolucion); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cantidad Devuelta:</strong>
                                    <?php echo e($devolucion->cantidad_devuelta); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion Estado:</strong>
                                    <?php echo e($devolucion->descripcion_estado); ?>

                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/devolucion/show.blade.php ENDPATH**/ ?>