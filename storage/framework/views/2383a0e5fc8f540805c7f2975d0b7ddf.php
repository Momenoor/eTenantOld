<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($field['component'], array_merge($field['parameters'] ?? [], ['field' => $field]))->html();
} elseif ($_instance->childHasBeenRendered('4CPKwou')) {
    $componentId = $_instance->getRenderedChildComponentId('4CPKwou');
    $componentTag = $_instance->getRenderedChildComponentTagName('4CPKwou');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('4CPKwou');
} else {
    $response = \Livewire\Livewire::mount($field['component'], array_merge($field['parameters'] ?? [], ['field' => $field]));
    $html = $response->html();
    $_instance->logRenderedChild('4CPKwou', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/fields/livewire_component.blade.php ENDPATH**/ ?>