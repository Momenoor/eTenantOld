<table class="table table-striped mb-0">
    <tbody>
        <tr>
            <td>
                <strong>File path from base:</strong>
            </td>
            <td colspan="1">
                <?php echo $__env->make('backpack.devtools::columns.file-link', [
                    'column' => [
                        'name' => $key,
                        'path' => $item->file_path,
                    ],
                    'value' => $item->file_path_from_base,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php
                if(!empty($item) && $item->isClass()) {
                    $error = $item->getErrors();
                }
                ?>
                <?php if(isset($error)): ?>
                <p class="badge-warning rounded p-1">
                    <strong><?php echo e(ucfirst($error->getMessage())); ?></strong> on line <strong><?php echo e($error->getLine()); ?></strong>
                </p>
                <?php endif; ?>

                <?php echo $__env->make('backpack.devtools::columns.code', [
                    'column' => [
                        'name' => $key,
                    ],
                    'value' => $item->file_contents,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </td>
        </tr>
    </tbody>
</table>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/widgets/partials/unknown-file-preview.blade.php ENDPATH**/ ?>