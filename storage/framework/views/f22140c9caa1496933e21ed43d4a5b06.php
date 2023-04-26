
<?php
$entryUrl = url("{$crud->route}/{$entry->getKey()}");
?>

<div class="btn-group dropdown">
    <button class="btn btn-sm btn-warning dropdown-toggle <?php echo e($entry->can_generate_factory || $entry->can_generate_seeder || $entry->can_generate_crud ? '' : 'disabled'); ?>" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Generate
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item <?php echo e($entry->can_generate_crud ? '' : 'disabled'); ?>" href="<?php echo e($entryUrl); ?>/build-crud">CRUD</a>
        <a class="dropdown-item <?php echo e($entry->can_generate_factory ? '' : 'disabled'); ?>" href="<?php echo e($entryUrl); ?>/build-factory">Factory</a>
        <a class="dropdown-item <?php echo e($entry->can_generate_seeder ? '' : 'disabled'); ?>" href="<?php echo e($entryUrl); ?>/build-seeder">Seeder</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo e($entryUrl); ?>/build-all">All</a>
    </div>
</div><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/buttons/model_generate.blade.php ENDPATH**/ ?>