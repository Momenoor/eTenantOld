<div class="form-group col-md-3 mb-1 px-1">
	<label class="mb-1">Morphable</label>
	<input
		type="text"
		wire:model="columns.<?php echo e($column_index); ?>.args.morphable"
		name="columns[<?php echo e($column_index); ?>][args][morphable]"
		class="form-control " />
        <?php if(!is_int($columns[$column_index]['has_relationship'])): ?>
            <small class="text-info">No morph relation created in model.</small>
			<?php if(!empty($columns[$column_index]['args']['morphable'])): ?>
				<a class="add-relationship" target="_blank" href="#" wire:click.prevent="createMorphToRelationFromColumn(<?php echo e($column_index); ?>)">+ Add </a></small>
			<?php endif; ?>
        <?php endif; ?>
</div>

<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/migration-schema/column-types/morphs.blade.php ENDPATH**/ ?>