

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Devoluciones')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-undo"></i> <?php echo e(__('Gestión de Devoluciones')); ?></h3>
            </div>

            <div class="card-body">
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success text-center">
                        <p><?php echo e($message); ?></p>
                    </div>
                <?php endif; ?>

                <form method="GET" action="<?php echo e(route('devolucions.index')); ?>" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="descripcion_estado" class="form-control" placeholder="Buscar por estado..." value="<?php echo e(request('descripcion_estado')); ?>">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a href="<?php echo e(route('devolucions.index')); ?>" class="btn btn-warning">
                                <i class="fa fa-sync-alt"></i> Limpiar
                            </a>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?php echo e(route('devolucions.create')); ?>" class="btn text-white" style="background-color: #A4D65E;">
                                <i class="fa fa-plus-circle"></i> Crear Nueva
                            </a>
                        </div>
                    </div>

                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="mostrar_coincidencias" name="mostrar_coincidencias"
                               <?php echo e(request('mostrar_coincidencias') ? 'checked' : ''); ?>

                               onchange="this.form.submit()">
                        <label class="form-check-label" for="mostrar_coincidencias">Mostrar solo coincidencias</label>
                    </div>
                </form>

                <?php if(isset($prestamo)): ?>
                    <div class="info-box mb-4 p-3" style="background-color: white; border-left: 4px solid #00723E; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <h4 class="mb-3">Información del Préstamo #<?php echo e($prestamo->id); ?></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Material:</strong> <?php echo e($prestamo->material->nombre ?? 'No especificado'); ?></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Personal:</strong> <?php echo e($prestamo->personal->nombre ?? 'No especificado'); ?> <?php echo e($prestamo->personal->apellido ?? ''); ?></p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Cantidad:</strong> <?php echo e($prestamo->cantidad_prestada); ?></p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Fecha:</strong> <?php echo e($prestamo->fecha_prestamo); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-white text-center" style="background-color: #00723E;">
                        <tr>

                            <th>Fecha Devolución</th>
                            <th>Cantidad Devuelta</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                            <?php if(!isset($prestamo)): ?>


                            <?php endif; ?>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $estadoBuscado = request('descripcion_estado');
                            $i = ($devolucions->currentPage() - 1) * $devolucions->perPage() + 1;
                        ?>

                        <?php $__empty_1 = true; $__currentLoopData = $devolucions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $devolucion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $coincide = $estadoBuscado && stripos($devolucion->descripcion_estado, $estadoBuscado) !== false;
                            ?>
                            <tr class="<?php echo e($coincide ? 'table-success' : ''); ?>">

                                <td><?php echo e($devolucion->fecha_devolucion); ?></td>
                                <td><?php echo e($devolucion->cantidad_devuelta); ?></td>
                                <td><?php echo e($devolucion->descripcion_estado); ?></td>
                                <td><?php echo e($devolucion->observaciones ?? 'Sin observaciones'); ?></td>
                                <?php if(!isset($prestamo)): ?>


                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if(!isset($prestamo)): ?>
                                        <a href="<?php echo e(route('devolucions.edit', $devolucion->id)); ?>" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('devolucions.destroy', $devolucion->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar devolución?')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="<?php echo e(isset($prestamo) ? 6 : 8); ?>" class="text-center text-danger"><strong>No hay devoluciones registradas.</strong></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <?php echo $devolucions->withQueryString()->links(); ?>

                </div>

                <?php if(isset($prestamo)): ?>
                    <div class="text-center mt-4">
                        <a href="<?php echo e(route('prestamos.show', $prestamo->id)); ?>" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Volver al Préstamo
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/devolucion/index.blade.php ENDPATH**/ ?>