
<?php
	$value = data_get($entry, $column['name']);
    $value = is_array($value) ? json_encode($value) : $value;

    $column['limit'] = $column['limit'] ?? 120;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['text'] = $column['prefix'] . Str::limit($value, $column['limit'], '[...]') . $column['suffix'];
    $column['path'] = $entry->{$column['filePath'] ?? ''} ?? $value;
?>

<span>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <span class="code-inline">
            <?php echo e($column['text']); ?>

        </span>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</span>

<style>
    span.code-inline {
        font-family: monospace;
        padding: .2em .4em;
        margin: 0;
        font-size: 95%;
        background-color: #1b1f230d;
        border-radius: 6px;
    }
</style><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/columns/code-inline.blade.php ENDPATH**/ ?>