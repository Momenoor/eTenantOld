<div class="form-group col-md-4 mb-1 px-1">
    <label class="mb-1">Relation name</label>
    <?php if($relationship['created_by_column']): ?>
    <input
        type="text"
        name="relationships[<?php echo e($relationship_index); ?>][relationship_column]"
        wire:model="relationships.<?php echo e($relationship_index); ?>.relationship_column"
        class="form-control"
        readonly />
    <?php else: ?>
        <?php if(!$relationship['relationship_column']): ?>
        <button
            class="d-inline-block ml-1 btn btn-sm btn-link"
            href="#"
            wire:click.prevent="addNewRelationshipColumn(<?php echo e($relationship_index); ?>)">
            + Create Column
        </button>
        <?php endif; ?>

        <?php if(!empty($current_available_columns_for_morphs) || $relationship['relationship_column']): ?>
        <select
            name="relationships[<?php echo e($relationship_index); ?>][relationship_column]"
            wire:model="relationships.<?php echo e($relationship_index); ?>.relationship_column"
            class="form-control">
            <?php if($relationship['relationship_column']): ?>
            <option value="<?php echo e($relationship['relationship_column']); ?>"><?php echo e($relationship['relationship_column']); ?></option>
            <?php endif; ?>
            <option value="">-</option>
            <?php if(!empty($current_available_columns_for_morphs)): ?>
            
            <?php $__currentLoopData = $current_available_columns_for_morphs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($column['args']['morphable']); ?>"><?php echo e($column['args']['morphable']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
        <?php else: ?>
            <br />
            <span> No valid columns to choose from.</span>

            <?php if($errors->any() && $errors->getBag('default')->has('relationships.'.$relationship_index.'.relationship_column')): ?>
            <br />
            <span class="text-danger"> * <?php echo e($errors->getBag('default')->first('relationships.'.$relationship_index.'.relationship_column')); ?> </span>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/relationship-schema/morphto.blade.php ENDPATH**/ ?>