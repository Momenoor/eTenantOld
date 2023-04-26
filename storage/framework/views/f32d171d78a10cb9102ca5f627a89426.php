
<?php echo $__env->renderWhen(!isset($field['wrapper']) || $field['wrapper'] !== false, 'crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
	<?php echo $field['value']; ?>

<?php echo $__env->renderWhen(!isset($field['wrapper']) || $field['wrapper'] !== false, 'crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\crud\src\resources\views\crud/fields/custom_html.blade.php ENDPATH**/ ?>