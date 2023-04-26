
<?php echo $__env->renderWhen(!isset($field['wrapper']) || $field['wrapper'] !== false, 'crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
  <?php echo $__env->make($field['view'], ['crud' => $crud, 'entry' => $entry ?? null, 'field' => $field], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->renderWhen(!isset($field['wrapper']) || $field['wrapper'] !== false, 'crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\crud\src\resources\views\crud/fields/view.blade.php ENDPATH**/ ?>