<?php if($crud->hasAccess('show')): ?>
	<a href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/show')); ?>" class="btn btn-sm btn-outline-primary"><i class="la la-eye"></i> Details</a>
<?php endif; ?><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/buttons/details.blade.php ENDPATH**/ ?>