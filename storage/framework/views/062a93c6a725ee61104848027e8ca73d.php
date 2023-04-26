<?php if($column['show_modifiers']): ?>
    <div class="form-group col-md-2 mb-1 px-1">
    <label class="mb-1"><?php echo e(ucfirst($label)); ?></label>
<?php endif; ?>
	<input
        type="<?php echo e($type); ?>"
		wire:model.lazy="columns.<?php echo e($column_index); ?>.modifiers.<?php echo e($label); ?>"
		name="columns[<?php echo e($column_index); ?>][modifiers][<?php echo e($label); ?>]"
		class="form-control "
		<?php if(in_array($label, $invalid_modifiers)): ?>
			readonly
		<?php endif; ?>
        />
<?php if($column['show_modifiers']): ?>
</div>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/migration-schema/modifiers/text.blade.php ENDPATH**/ ?>