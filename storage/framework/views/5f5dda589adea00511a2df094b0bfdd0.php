<?php
    $field['wrapper'] = ['class' => ''];
?>
<?php echo $__env->make('crud::fields.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startPush('crud_fields_scripts'); ?>
<script>
    document.querySelectorAll('[toggles]').forEach(toggles => {
        const field = toggles.getAttribute('toggles');
        const checkbox = toggles.querySelector('input[type="checkbox"]');

        const onCheckBoxChange = () => {
            document.querySelectorAll(`[toggler="${field}"]`).forEach(toggler =>
                [toggler, ...toggler.querySelectorAll('input')].forEach(input => {
                    if(input.getAttribute('type') === 'checkbox') {
                        input.checked = checkbox.checked ? input.getAttribute('checked') === 'checked' ? true : false : false;
                        $(input).closest('input[type=hidden]').val(checkbox.checked ? input.getAttribute('checked') === 'checked' ? 1 : 0 : 0)
                    }

                    input.toggleAttribute('disabled', !checkbox.checked)
                })
            );
        }

        checkbox.addEventListener('change', onCheckBoxChange)

        onCheckBoxChange();
    });
</script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('crud_fields_styles'); ?>
<style>
    .form-group[toggler][disabled] {
        opacity: .5;
        pointer-events: none;
    }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/fields/checkbox_toggler.blade.php ENDPATH**/ ?>