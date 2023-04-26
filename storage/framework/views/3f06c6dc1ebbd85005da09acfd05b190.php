<?php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.preview') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;

    Widget::add()
        ->to('after_content')
        ->type('view')
        ->view('backpack.devtools::widgets.preview-files')
        ->content(CRUD::getCurrentEntry()->getRelatedFiles());
?>

<?php $__env->startSection('header'); ?>
    <section class="container-fluid d-print-none">
        <a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
        <h2>
            <span class="text-capitalize"><?php echo e($crud->entity_name_plural); ?></span>
            <small><?php echo 'Files related to the "'.$entry->file_name.'" model'; ?>.</small>
            <?php if($crud->hasAccess('list')): ?>
              <small class=""><a href="<?php echo e(url($crud->route)); ?>" class="font-sm"><i class="la la-angle-double-left"></i> <?php echo e(trans('backpack::crud.back_to_all')); ?> <span><?php echo e($crud->entity_name_plural); ?></span></a></small>
            <?php endif; ?>
        </h2>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('after_styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/backpack/crud/css/show.css').'?v='.config('backpack.base.cachebusting_string')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    <script src="<?php echo e(asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string')); ?>"></script>
    <script src="<?php echo e(asset('packages/backpack/crud/js/show.js').'?v='.config('backpack.base.cachebusting_string')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/operations/related-files.blade.php ENDPATH**/ ?>