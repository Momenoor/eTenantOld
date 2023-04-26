<?php if(!$entry->executed): ?>
    <a href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/run-migration')); ?>" class="btn btn-sm btn-outline-success">
        <i class="la la-terminal"></i>
        <span>Migrate</span>
    </a>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/buttons/migration_run.blade.php ENDPATH**/ ?>