<div class="modal fade" 
	id="livewire-<?php echo e($componentName); ?>" 
	tabindex="-1" 
	aria-labelledby="livewire-<?php echo e($componentName); ?>" 
	aria-hidden="true">
	<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($componentName, $componentParameters ?? [])->html();
} elseif ($_instance->childHasBeenRendered('iN0pddk')) {
    $componentId = $_instance->getRenderedChildComponentId('iN0pddk');
    $componentTag = $_instance->getRenderedChildComponentTagName('iN0pddk');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('iN0pddk');
} else {
    $response = \Livewire\Livewire::mount($componentName, $componentParameters ?? []);
    $html = $response->html();
    $_instance->logRenderedChild('iN0pddk', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/components/modal.blade.php ENDPATH**/ ?>