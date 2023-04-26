<?php $__env->startPush('before_styles'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('after_scripts'); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>


    <script>
        window.addEventListener('focus', (e) => {
            window.livewire.emit('updateModelList')
        });
    </script>

    <?php echo $__env->make('backpack.devtools::livewire.components.modal', [
        'componentName' => 'publish-modal',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('backpack.devtools::livewire.components.modal', [
        'componentName' => 'create-page-modal',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/partials/assets.blade.php ENDPATH**/ ?>