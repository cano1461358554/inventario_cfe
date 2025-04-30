

<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Materials')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-box"></i> <?php echo e(__('Gestión de Materiales')); ?></h3>
            </div>

            <div class="card-body">
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success text-center">
                        <p><?php echo e($message); ?></p>
                    </div>
                <?php endif; ?>

                <form method="GET" action="<?php echo e(route('materials.index')); ?>" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre del material..." value="<?php echo e(request('nombre')); ?>">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a href="<?php echo e(route('materials.index')); ?>" class="btn btn-warning">
                                <i class="fa fa-sync-alt"></i> Limpiar
                            </a>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?php echo e(route('materials.create')); ?>" class="btn text-white" style="background-color: #A4D65E;">
                                <i class="fa fa-plus-circle"></i> Crear Nuevo
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-white text-center" style="background-color: #00723E;">
                        <tr>
                            <th><?php echo e(__('Clave')); ?></th>
                            <th><?php echo e(__('Nombre')); ?></th>
                            <th><?php echo e(__('Marca')); ?></th>
                            <th><?php echo e(__('Almacén')); ?></th>
                            <th><?php echo e(__('Estante')); ?></th>
                            <th class="redirectable" data-url="<?php echo e(route('categorias.index')); ?>"><?php echo e(__('Categoría')); ?></th>
                            <th class="redirectable" data-url="<?php echo e(route('tipo-material.index')); ?>"><?php echo e(__('Tipo de Material')); ?></th>
                            <th class="redirectable" data-url="<?php echo e(route('unidad-medida.index')); ?>"><?php echo e(__('Unidad de Medida')); ?></th>
                            <th><?php echo e(__('Acciones')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = ($materials->currentPage() - 1) * $materials->perPage();
                            $nombreBuscado = request('nombre');
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $coincide = $nombreBuscado && stripos($material->nombre, $nombreBuscado) !== false;
                            ?>
                            <tr class="<?php echo e($coincide ? 'table-success' : ''); ?>">
                                <td><?php echo e($material->clave); ?></td>
                                <td><?php echo e($material->nombre); ?></td>
                                <td><?php echo e($material->marca); ?></td>
                                <td><?php echo e($material->almacen?->nombre ?? 'Sin almacén'); ?></td>
                                <td><?php echo e($material->estante ?? 'Sin estante'); ?></td>
                                <td class="redirectable" data-url="<?php echo e(route('categorias.index')); ?>"><?php echo e($material->categoria?->nombre ?? 'Sin categoría'); ?></td>
                                <td class="redirectable" data-url="<?php echo e(route('tipo-material.index')); ?>"><?php echo e($material->tipomaterial?->descripcion ?? 'Sin tipo'); ?></td>
                                <td class="redirectable" data-url="<?php echo e(route('unidad-medida.index')); ?>"><?php echo e($material->unidadmedida?->descripcion_unidad ?? 'Sin unidad'); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('materials.edit', $material->id)); ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <form action="<?php echo e(route('materials.destroy', $material->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar material?')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center text-danger"><strong>No hay materiales registrados.</strong></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <?php echo $materials->withQueryString()->links(); ?>

                </div>
            </div>
        </div>
    </div>
    <div id="hidden-message" style="display: none;">
        Nuevas funciones incorporadas: Redirección con clic derecho en Categoría, Tipo de Material y Unidad de Medida.
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const redirectableCells = document.querySelectorAll('.redirectable');

            redirectableCells.forEach(cell => {
                cell.addEventListener('contextmenu', function(event) {
                    event.preventDefault();
                    const url = this.getAttribute('data-url');
                    window.location.href = url;
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cfe\resources\views/material/index.blade.php ENDPATH**/ ?>