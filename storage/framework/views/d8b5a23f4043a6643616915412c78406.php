<?php
    $files = $widget['content'];
    $url = Str::of(URL::current())
            ->replaceLast('related-files/migration', 'related-files')
            ->replaceLast('related-files/model', 'related-files')
            ->replaceLast('related-files/seeder', 'related-files')
            ->replaceLast('related-files/factory', 'related-files')
            ->replaceLast('related-files/crud_controller', 'related-files')
            ->replaceLast('related-files/crud_request', 'related-files')
            ->replaceLast('related-files/crud_route', 'related-files')
            ->replaceLast('related-files/operation', 'related-files')
            ->replaceLast('related-files/sidebar_item', 'related-files');
?>

<div class="row">
  <div class="col-2">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="nav-link <?php echo e($file?'':'disabled'); ?> <?php echo e($key==$selected?'active':''); ?>" id="v-pills-<?php echo e($key); ?>-tab" data-toggle="pill" data-file="<?php echo e($key); ?>" href="#v-pills-<?php echo e($key); ?>" role="tab" aria-controls="v-pills-<?php echo e($key); ?>" aria-selected="<?php echo e($key==$selected?'true':'false'); ?>"><?php echo e(Str::of($key)->replace('_', ' ')->title()); ?>

                <?php if(is_array($file)): ?>
                <span class="badge badge-<?php echo e($key==$selected?'light':'primary'); ?> badge-pill float-right d-block" style="margin-top: 2px;"><?php echo e(count($file)); ?></span>
                <?php $__currentLoopData = $file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($f) && $f->isClass() && !$f->isValid()): ?>
                        <span class="badge badge-warning badge-pill float-right d-block" style="margin-top: 3px;" title="Syntax errors">!</span>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <?php if(!empty($file) && $file->isClass() && !$file->isValid()): ?>
                <span class="badge badge-warning badge-pill float-right d-block" style="margin-top: 3px;" title="Syntax errors">!</span>
                <?php endif; ?>
                <?php endif; ?>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <div class="col-10">
    <div class="tab-content border-0" id="v-pills-tabContent">
        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade p-0 <?php echo e($key==$selected?'show active':''); ?>"
                id="v-pills-<?php echo e($key); ?>"
                role="tabpanel"
                aria-labelledby="v-pills-<?php echo e($key); ?>-tab">
                <?php if($file): ?>
                    <?php if(is_array($file)): ?>
                        <?php $__currentLoopData = $file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('backpack.devtools::widgets.partials.unknown-file-preview', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php if(!$loop->last): ?>
                            <div class="bg-light text-center text-muted py-3"> & </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('backpack.devtools::widgets.partials.unknown-file-preview', ['item' => $file], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php else: ?>
                    File is missing.
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>

<?php
    // ------------------------------------------------
    // Get the Migration and Model (as Eloquent models)
    // ------------------------------------------------
    if (isset($files['migration']) && !empty($files['migration'])) {
        $migration = \Backpack\DevTools\Models\Migration::where('file_path', $files['migration']->file_path)->first();
    } else {
        $migration = false;
    }

    if (isset($files['model']) && !empty($files['model'])) {
        $model = \Backpack\DevTools\Models\Model::where('file_path', $files['model']->file_path)->first();
    } else {
        $model = false;
    }

    if (isset($files['operation']) && !empty($files['operation'])) {
        $operation = \Backpack\DevTools\Models\Operation::where('file_path', $files['operation']->file_path)->first();
    } else {
        $operation = false;
    }
?>

<?php $__env->startPush('after_scripts'); ?>
<script>
    // update the URL when pills are clicked;
    // that way, if the dev clicks an action button, they'll be redirected
    // back to the correct tab;
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (event) {
        var file = $(event.target).attr('data-file');
        var new_url = "<?php echo e($url); ?>" + "/" + file;

        window.history.replaceState('Object', 'Title', new_url);
    });

    <?php if($migration): ?>
    $.ajax({
      method: "GET",
      url: "<?php echo e(backpack_url('devtools/migration/'.$migration->id.'/stripped-show')); ?>"
    })
      .done(function( msg ) {
        $('#v-pills-migration').html(msg);
      });
    <?php endif; ?>

    <?php if($model): ?>
    $.ajax({
      method: "GET",
      url: "<?php echo e(backpack_url('devtools/model/'.$model->id.'/stripped-show')); ?>"
    })
      .done(function( msg ) {
        $('#v-pills-model').html(msg);
      });
    <?php endif; ?>

    <?php if($operation): ?>
    $.ajax({
        method: "GET",
        url: "<?php echo e(backpack_url('devtools/operation/'.$operation->id.'/stripped-show')); ?>"
    })
        .done(function( msg ) {
            $('#v-pills-model').html(msg);
        });
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/widgets/preview-files.blade.php ENDPATH**/ ?>