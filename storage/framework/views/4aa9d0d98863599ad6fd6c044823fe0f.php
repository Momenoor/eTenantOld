<migration-schema>

    <label class="d-block"><?php echo e($field['label'] ?? 'Migration Schema'); ?></label>
    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_index => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
          $modifier_configuration_for_colummn_type = $selectable_column_types[$column['column_type']]['configs'] ?? [];
      ?>
      <div wire:key="column-definition-<?php echo e($column_index); ?>" class="migration-schemas-container">
        <div class="col-md-12 well migration-schema row m-1 p-2 pl-3">
          <div class="side-button-group">
            <button type="button"
                  <?php if(is_int($column['has_relationship'])): ?>
                  wire:click="confirmColumnDelete('removeColumnAndRelationship', <?php echo e($column_index); ?>)"
                  <?php else: ?>
                  wire:click="confirmColumnDelete('removeColumn', <?php echo e($column_index); ?>)"
                  <?php endif; ?>
                  class="close delete-element ">
              <span aria-hidden="true">×</span>
            </button>

            <?php if(!$loop->first && !in_array($column['column_type'], ['timestamps', 'timestampsTz'])): ?>
            <button type="button"
                    wire:click="moveColumnOrderUp(<?php echo e($column_index); ?>)"
                    class="close move-up-element">
                    <span aria-hidden="true">&uarr;</span>
            </button>
            <?php endif; ?>
            <?php if(!$loop->last && !in_array($columns[$column_index+1]['column_type'], ['timestamps', 'timestampsTz'])): ?>
            <button type="button"
                    wire:click="moveColumnOrderDown(<?php echo e($column_index); ?>)"
                    class="close move-down-element">
                    <span aria-hidden="true">&darr;</span>
            </button>
            <?php endif; ?>
          </div>
          <div class="form-group col-md-3 mb-1 px-1">
            <input type="hidden" value="<?php echo e($column['show_modifiers'] === false ? 0 : 1); ?>" name="columns[<?php echo e($column_index); ?>][show_modifiers]" />
            <label class="mb-1">Column Name</label>
            <input  type="text"
                    name="columns[<?php echo e($column_index); ?>][column_name]"
                    wire:model.lazy="columns.<?php echo e($column_index); ?>.column_name"
                    value="<?php echo e($column['column_name'] ?? ''); ?>"
                    <?php if(isset($selectable_column_types[$column['column_type']]['configs']) && is_array($selectable_column_types[$column['column_type']]['configs'])): ?>
                      <?php if(isset($selectable_column_types[$column['column_type']]['configs']['placeholder'])): ?>
                    disabled
                    placeholder="<?php echo e($selectable_column_types[$column['column_type']]['configs']['placeholder']); ?>"
                      <?php endif; ?>
                    <?php endif; ?>

                    class="form-control " />

          </div>

          <div class="form-group col-md-2 mb-1 px-1">
            <label class="mb-1">Column Type</label>
            <select
              name="columns[<?php echo e($column_index); ?>][column_type]"
              wire:model="columns.<?php echo e($column_index); ?>.column_type"
              wire:change="fetchColumnSpecificFields(<?php echo e($column_index); ?>)"
              class="form-control">
              <?php $__currentLoopData = $selectable_column_types_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $column_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_array($column_type)): ?>
                  <optgroup label="<?php echo e(ucfirst($label)); ?>">
                    <?php $__currentLoopData = $column_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value); ?>" <?php echo e($this->isColumnTypeEnabled($value, $column) ? '' : 'disabled'); ?>><?php echo e(ucfirst($value)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </optgroup>
                <?php else: ?>
                  <option value="<?php echo e($column_type); ?>" <?php echo e($this->isColumnTypeEnabled($column_type, $column) ? '' : 'disabled'); ?>><?php echo e(ucfirst($column_type)); ?></option>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          
          <?php if(view()->exists('backpack.devtools::livewire.migration-schema.column-types.'.strtolower($column['column_type']))): ?>
              <?php echo $__env->make('backpack.devtools::livewire.migration-schema.column-types.'.strtolower($column['column_type']), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>

          <?php if(isset($selectable_column_types[$column['column_type']]) && is_array($selectable_column_types[$column['column_type']])): ?>
            <?php $__currentLoopData = $selectable_column_types[$column['column_type']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct_type_extra => $ct_type_extra_config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($ct_type_extra !== 'configs'): ?>
                <?php echo $__env->make('backpack.devtools::livewire.migration-schema.types.'.$ct_type_extra_config['type'], [
                  'label' => $ct_type_extra,
                  'force' => $ct_type_extra_config['force'] ?? false,
                  'attributes' => $ct_type_extra_config['attributes'] ?? [],
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>

          <?php if(isset($column['modifiers']['nullable'])): ?>
            <div class="form-group col-md-1 mb-1 px-1 text-center">
              <label class="mb-1">Nullable</label>
              <input  type="checkbox"
                      name="columns[<?php echo e($column_index); ?>][modifiers][nullable]"
                      wire:model="columns.<?php echo e($column_index); ?>.modifiers.nullable"

                      wire:change="selectModifier(<?php echo e($column_index); ?>, 'nullable')"
                      class="form-control"
                      <?php if(in_array('nullable', $column['invalid_modifiers'])): ?>
                              disabled
                              value=""
                          <?php else: ?>
                        <?php if(isset($modifier_configuration_for_colummn_type['auto_modifiers']) && in_array('nullable', $modifier_configuration_for_colummn_type['auto_modifiers'])): ?>
                          checked="checked"
                              disabled
                        <?php endif; ?>
                      <?php endif; ?>
                      />
            </div>
          <?php endif; ?>

          <?php if(isset($columns[$column_index]['show_modifiers']) && $columns[$column_index]['show_modifiers'] != true): ?>
            <div class="form-group col-md-2 mb-1 px-1 ">
              <label class="mb-1"> &nbsp; </label>
              <button class="d-block mt-1 ml-1 btn btn-sm btn-link"
                      type="button"
                      href="#"
                      wire:click.prevent="showModifiers(<?php echo e($column_index); ?>)">
                      More >
              </button>
            </div>
          <?php endif; ?>


              <?php $__currentLoopData = $column['column_type_modifiers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($modifier != 'nullable' && in_array($operation, $column_modifiers[$modifier]['operations'])): ?>
                  <?php
                    $column_modifier_definition = $column_modifiers[$modifier];
                    if(!isset($column_modifier_definition['type'])) {
                      continue;
                    }
                  ?>
                    <?php echo $__env->make('backpack.devtools::livewire.migration-schema.modifiers.'.$column_modifier_definition['type'],[
                            'label' => $modifier,
                            'modifier_config' => $modifier_configuration_for_colummn_type,
                            'invalid_modifiers' => $column['invalid_modifiers'],
                            'type' => isset($column['show_modifiers']) && $column['show_modifiers'] === false ? 'hidden' : $column_modifier_definition['type']
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php if($column['show_modifiers']): ?>
              <div class="form-group col-md-2 mb-1 px-1">
                <label class="mb-1">Charset</label>
                <select name="columns[<?php echo e($column_index); ?>][modifiers][charset]"
                  wire:model="columns.<?php echo e($column_index); ?>.modifiers.charset"
                  class="form-control">
                  <option value="">-</option>
                  <?php $__currentLoopData = $charset_and_collation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charset => $collations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option
                      value="<?php echo e($charset); ?>">
                      <?php echo e($charset); ?>

                  </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            <?php else: ?>
              <input type="hidden" name="columns[<?php echo e($column_index); ?>][modifiers][charset]" wire:model="columns.<?php echo e($column_index); ?>.modifiers.charset">
            <?php endif; ?>
            <?php if($column['show_modifiers']): ?>
              <div class="form-group col-md-3 mb-1 px-1">
                <label class="mb-1">Collation</label>
                <select name="columns[<?php echo e($column_index); ?>][modifiers][collation]"
                  wire:model="columns.<?php echo e($column_index); ?>.modifiers.collation"
                  class="form-control">
                  <option value="">-</option>
                  <?php if(!empty($column['modifiers']['charset'])): ?>
                    <?php $__currentLoopData = $charset_and_collation[$column['modifiers']['charset']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option
                        value="<?php echo e($collation); ?>">
                        <?php echo e($collation); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </select>
              </div>
            <?php else: ?>
              <input type="hidden" name="columns[<?php echo e($column_index); ?>][modifiers][collation]" wire:model="columns.<?php echo e($column_index); ?>.modifiers.collation">
            <?php endif; ?>

            <div class="form-group col-md-2 mb-1 px-1 <?php if(isset($column['show_modifiers']) && $column['show_modifiers'] === false): ?> d-none <?php endif; ?>">
              <label class="mb-1"> &nbsp; </label>
              <button class="d-block mt-1 ml-1 btn btn-sm btn-link"
                      type="button"
                      href="#"
                      wire:click.prevent="hideModifiers(<?php echo e($column_index); ?>)">
                      < Hide
              </button>
            </div>

           

            </div>
            <?php if(!$loop->last && in_array($columns[$column_index+1]['column_type'], ['timestamps', 'timestampsTz'])): ?>
              <button type="button" wire:click.prevent="addColumn" class="btn btn-primary btn-sm ml-1 mt-3 mb-3 add-migration-schema-button">+ Add Column</button>
            <?php elseif($loop->last && 
                        empty(array_filter($columns, function($column) { 
                                return in_array($column['column_type'], ['timestamps', 'timestampsTz'] );
                              })) || (count($columns) === 1 && in_array($column['column_type'], ['timestamps', 'timestampsTz'] ))
            ): ?>
              <button type="button" wire:click.prevent="addColumn" class="btn btn-primary btn-sm ml-1 mt-3 mb-3 add-migration-schema-button">+ Add Column</button>
            <?php endif; ?>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php if(empty($columns)): ?>
        <button type="button" wire:click.prevent="addColumn" class="btn btn-primary btn-sm ml-1 mt-3 mb-3 add-migration-schema-button">+ Add Column</button>
    <?php endif; ?>
  
  
</migration-schema>

<?php $__env->startPush('crud_fields_styles'); ?>
  <!-- no styles -->
  <style type="text/css">
    .migration-schema {
      border: 1px solid #0028641f;
      background-color: #f0f3f94f;
      border-radius: 3px;
    }

    .migration-schemas-container .side-button-group {
      position: absolute !important;
      z-index: 2;
      width: 1.5rem;
      top: 0;
      left: 0;
      transform: translateX(-50%);
    }

    .migration-schemas-container .side-button-group button {
      width: 100%;
      border-radius: 50%;
      text-align: center;
      background-color: #e8ebf0 !important;
      margin-bottom: .3rem;
    }

    .migration-schemas-container .side-button-group button:focus {
      outline: none;
    }

    .migration-schemas-container input[type="checkbox"] {
      max-width: 1rem;
      margin: auto;
    }

    .migration-schemas-container a.add-relationship {
      float: right;
      transform: scale(0.8);
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after_scripts'); ?>
  <script>
    // when a new migration column is added
    window.addEventListener('newColumnAdded', (event) => {
      // focus on the first field for that new column
      var columnNamePrefix = 'columns[' + event.detail.columnIndex + ']';

      var columnSelector = 'input[name^="' + columnNamePrefix + '"]:visible' +
                            ', select[name^="' + columnNamePrefix + '"]:visible'+
                            ', checkbox[name^="' + columnNamePrefix + '"]:visible'+
                            ', radio[name^="' + columnNamePrefix + '"]:visible';

      $(columnSelector).first().trigger('focus');
    });

  window.addEventListener('confirmColumnDelete', (e) => {
      let message = 'Are you sure you want to delete this column?';
      if (e.detail.callback === 'removeColumnAndRelationship') {
        message = 'This column has an associated relationship. Are you sure you want to delete both the relationship and the column?';
      }
      if (!confirm(message)) { return }
      window.livewire.find('<?php echo e($_instance->id); ?>')[e.detail.callback](...e.detail.argv)
  });

  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/migration-schema.blade.php ENDPATH**/ ?>