
<?php
    $column['value'] = $column['value'] ?? data_get($entry, $column['name']);
    $column['escaped'] = $column['escaped'] ?? true;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';

    if($column['value'] instanceof \Closure) {
        $column['value'] = $column['value']($entry);
    }

    $column['icon'] = $column['value'] != false
        ? ($column['icons']['checked'] ?? 'la-check-circle')
        : ($column['icons']['unchecked'] ?? 'la-circle');

    $column['text'] = $column['value'] != false
        ? ($column['labels']['checked'] ?? trans('backpack::crud.yes'))
        : ($column['labels']['unchecked'] ?? trans('backpack::crud.no'));

    $column['text'] = $column['prefix'].$column['text'].$column['suffix'];
?>

<span>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <i class="la <?php echo e($column['icon']); ?>"></i>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</span>

<span class="sr-only">
    <?php if($column['escaped']): ?>
        <?php echo e($column['text']); ?>

    <?php else: ?>
        <?php echo $column['text']; ?>

    <?php endif; ?>
</span>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\crud\src\resources\views\crud/columns/check.blade.php ENDPATH**/ ?>