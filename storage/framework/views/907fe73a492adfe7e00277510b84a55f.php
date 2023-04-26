<div class="form-group col-md-4 mb-1 px-1">
    <label class="mb-1">Model</label>
    <?php if($relationship['created_by_column']): ?>
      <input type="text"
              name="relationships[<?php echo e($relationship_index); ?>][relationship_model]"
              wire:model="relationships.<?php echo e($relationship_index); ?>.relationship_model"
              class="form-control"
              readonly>
    <?php else: ?>
      <a class="add-relationship" target="_blank" href="<?php echo e(route('devtools.model.create')); ?>" wire:click="creatingModelRelationship(<?php echo e($relationship_index); ?>)">+ Add</a>
      <select name="relationships[<?php echo e($relationship_index); ?>][relationship_model]"
              wire:model="relationships.<?php echo e($relationship_index); ?>.relationship_model"
              wire:change="modelChanged(<?php echo e($relationship_index); ?>)"
              class="form-control">
              <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($model['name']); ?>"><?php echo e($model['name']); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    <?php endif; ?>
  </div><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/relationship-schema/_partial_model.blade.php ENDPATH**/ ?>