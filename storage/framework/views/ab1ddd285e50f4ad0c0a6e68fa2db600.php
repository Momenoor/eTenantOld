
<?php
    $value = $value ?? data_get($entry, $column['name']);

    $column['limit'] = $column['limit'] ?? 120;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['text'] = $column['prefix'] . ($column['text'] ?? Str::of($value)->after(base_path())->trim('\\')->replace('\\', '/')->limit($column['limit'], '[...]')) . $column['suffix'];
    $column['path'] = $column['path'] ?? $entry->{$column['filePath'] ?? ''} ?? $value;
    $column['href'] = link_to_code_editor($column['path']);
?>

<span>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php if($column['path']): ?>
        <a
            class="file-link" 
            <?php if($column['href'] !== ''): ?>
            href="<?php echo e(htmlentities($column['href'])); ?>"
            <?php endif; ?>
            style="padding: .2em .4em; margin: 0; font-size: 95%; background-color: #1b1f230d; border-radius: 6px;"
            >
            <?php echo e($column['text']); ?>

            <?php if($column['href'] !== ''): ?>
            <i class="la la-external-link-alt"></i>
            <?php endif; ?>
        </a>
        <?php if(request()->has('new')): ?>
            <span class="badge badge-success">New</span>
        <?php endif; ?>
        <?php else: ?>
        -
        <?php endif; ?>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</span>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/columns/file-link.blade.php ENDPATH**/ ?>