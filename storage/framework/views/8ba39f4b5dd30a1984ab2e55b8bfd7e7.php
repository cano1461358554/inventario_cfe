

<?php $__env->startSection('template_title'); ?>
    <?php echo e($personal->name ?? __('Show') . " " . __('Personal')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title"><?php echo e(__('Show')); ?> Personal</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('personals.index')); ?>"> <?php echo e(__('Back')); ?></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    <?php echo e($personal->nombre); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido:</strong>
                                    <?php echo e($personal->apellido); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rp:</strong>
                                    <?php echo e($personal->RP); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipo Usuario:</strong>
                                    <?php echo e($personal->tipo_usuario); ?>

                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/personal/show.blade.php ENDPATH**/ ?>