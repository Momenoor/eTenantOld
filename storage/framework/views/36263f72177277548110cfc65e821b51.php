<div class="form-group col-md-2 mb-1 px-1">
    <label class="mb-1">Model</label>
    <a class="add-relationship" target="_blank" href="<?php echo e(route('devtools.model.create')); ?>" wire:click="creatingModelColumn(<?php echo e($column_index); ?>)">+ Add</a>

    <select name="columns[<?php echo e($column_index); ?>][args][model]"
        wire:model="columns.<?php echo e($column_index); ?>.args.model"
        wire:change="fetchModelInfo(<?php echo e($column_index); ?>)"  
        class="form-control">
        <option value="">-</option>
        <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($model['name']); ?>"><?php echo e($model['name']); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if(empty($columns[$column_index]['args']['model'])): ?>
        <small class="text-danger">A model must be selected</small>
    <?php endif; ?>
    
    <?php
        $model = $models->where('name',$columns[$column_index]['args']['model'] ?? '')->first();
    ?>
    <?php if($model && !$model['has_index']): ?>
        <small class="text-danger">Model table does not have an index. Can't use BelongsTo column type.</small>
        <input type="hidden" value="true" name="columns[<?php echo e($column_index); ?>][table_no_index]">
    <?php endif; ?>
</div>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/migration-schema/column-types/belongsto.blade.php ENDPATH**/ ?>