<relationship-schema>

    <label class="d-block"><?php echo e($field['label'] ?? 'Relationships'); ?></label>

    <?php $__currentLoopData = $relationships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relationship_index => $relationship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div wire:key="relationship-definition-<?php echo e($relationship_index); ?>" class="relationship-schemas-container">
        <div class="col-md-12 well migration-schema row m-1 p-2 pl-3">
          <div class="side-button-group">
            <button type="button"
                    <?php if($relationship['created_by_column']): ?>
                    wire:click="confirmRelationshipDelete('removeRelationshipAndColumn', <?php echo e($relationship_index); ?>)"
                    <?php else: ?>
                    wire:click="confirmRelationshipDelete('removeRelationship', <?php echo e($relationship_index); ?>)"
                    <?php endif; ?>
                    class="close delete-element ">
                    <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="form-group col-md-2 mb-1 px-1">
            <label class="mb-1">Relation Type</label>
            <select name="relationships[<?php echo e($relationship_index); ?>][relationship_type]"
                    wire:model="relationships.<?php echo e($relationship_index); ?>.relationship_type"
                    wire:change="selectRelationshipType(<?php echo e($relationship_index); ?>)"
                    class="form-control"
                    <?php if($relationship['created_by_column']): ?>
                    readonly
                    <?php endif; ?>
                    >
                <?php $__currentLoopData = $relation_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relation => $configs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($relation); ?>"><?php echo e($relation); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          

          
          <?php if(view()->exists('backpack.devtools::livewire.relationship-schema.'.strtolower($relationship['relationship_type']))): ?>
              <?php echo $__env->make('backpack.devtools::livewire.relationship-schema.'.strtolower($relationship['relationship_type']), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
          <?php if($relationship['created_by_column']): ?>
          <input type="hidden" name="relationships[<?php echo e($relationship_index); ?>][created_by_column]" wire:model="relationships.<?php echo e($relationship_index); ?>.created_by_column" />
          <div class="col-md-12 form-group mb-1 px-1">
            <span class="text-muted">* This relationship was inferred from your migration columns.</span>
          </div>
          <?php endif; ?>
        </div>

      </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


  <button type="button" wire:click.prevent="addRelationship" class="btn btn-outline-primary btn-sm ml-1 add-relationship-schema-button">+ Add Relationship</button>

</relationship-schema>


<?php $__env->startPush('crud_fields_styles'); ?>
  <!-- no styles -->
  <style type="text/css">
    .relationship-schema {
      border: 1px solid #0028641f;
      background-color: #f0f3f94f;
      border-radius: 3px;
    }

    .relationship-schemas-container .side-button-group {
      position: absolute !important;
      z-index: 2;
      width: 1.5rem;
      top: 0;
      left: 0;
      transform: translateX(-50%);
    }

    .relationship-schemas-container .side-button-group button {
      width: 100%;
      border-radius: 50%;
      text-align: center;
      background-color: #e8ebf0 !important;
      margin-bottom: .3rem;
    }

    .relationship-schemas-container .side-button-group button:focus {
      outline: none;
    }

    .relationship-schemas-container input[type="checkbox"] {
      max-width: 1rem;
      margin: auto;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after_scripts'); ?>
  <script>
    window.addEventListener('confirmRelationshipDelete', (e) => {
      let message = 'Are you sure you want to delete this relationship?';
      if (e.detail.callback == 'removeRelationshipAndColumn') {
        message = 'This relationship has an associated column. Are you sure you want to delete both the relationship and the column?';
      }
      if (!confirm(message)) { return }
      window.livewire.find('<?php echo e($_instance->id); ?>')[e.detail.callback](...e.detail.argv)
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/relationship-schema.blade.php ENDPATH**/ ?>