<table class="table table-striped mb-0">
    <tbody>
    <?php $__currentLoopData = $crud->columns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $code = ($column['type'] == 'view' && isset($column['view']) && $column['view'] == 'backpack.devtools::columns.code');
        ?>
        <tr>
            <?php if(!$code): ?>
            <td>
                <strong><?php echo $column['label']; ?>:</strong>
            </td>
            <?php endif; ?>
            <td colspan="<?php echo e($code?2:1); ?>">
                <?php if(!isset($column['type'])): ?>
                  <?php echo $__env->make('crud::columns.text', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                  <?php if(view()->exists('vendor.backpack.crud.columns.'.$column['type'])): ?>
                    <?php echo $__env->make('vendor.backpack.crud.columns.'.$column['type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php else: ?>
                    <?php if(view()->exists('crud::columns.'.$column['type'])): ?>
                      <?php echo $__env->make('crud::columns.'.$column['type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                      <?php echo $__env->make('crud::columns.text', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($crud->buttons()->where('stack', 'line')->count()): ?>
        <tr>
            <td><strong><?php echo e(trans('backpack::crud.actions')); ?></strong></td>
            <td>
                <?php echo $__env->make('crud::inc.button_stack', ['stack' => 'line'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/operations/show-stripped.blade.php ENDPATH**/ ?>