<div class="form-group col-md-3 mb-1 px-1">
	<label class="mb-1"><?php echo e(ucfirst(str_replace('_', ' ', $label))); ?></label>
	<input
		type="text"
		wire:model="columns.<?php echo e($column_index); ?>.args.<?php echo e($label); ?>"
		name="columns[<?php echo e($column_index); ?>][args][<?php echo e($label); ?>]"
		<?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo e($attribute); ?>="<?php echo e($value); ?>"
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		class="form-control" />
	<span class="font-sm text-muted">Separator: , (comma)</span>
</div>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/migration-schema/types/enumerable.blade.php ENDPATH**/ ?>