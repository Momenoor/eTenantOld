
<?php
    $file = $column['file']($entry);

    $column['icon'] = $file ? 'check-circle' : 'circle';
    $column['wrapper'] = [
        'title' => $file->file_path_from_base ?? '',
        'class' => "text-decoration-none text-" . ($file ? 'success' : 'danger'),
        'element' => $file ? 'a' : 'div',
        'href' => backpack_url("/devtools/model/{$entry->id}/related-files/{$column['href']}"),
    ];
?>

<span>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <i class="la la-<?php echo e($column['icon']); ?>"></i>
    <?php if($file && !$file->isValid()): ?>
    <i class="la la-warning text-danger" title="File has syntax errors."></i>
    <?php endif; ?>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</span><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/columns/file-check.blade.php ENDPATH**/ ?>