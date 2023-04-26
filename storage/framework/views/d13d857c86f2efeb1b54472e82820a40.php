
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('dashboard')); ?>"><i class="la la-home nav-icon"></i> <?php echo e(trans('backpack::base.dashboard')); ?></a></li>

<?php echo $__env->renderWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('contract')); ?>"><i class="nav-icon la la-question"></i> Contracts</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('installment')); ?>"><i class="nav-icon la la-question"></i> Installments</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('invoice')); ?>"><i class="nav-icon la la-question"></i> Invoices</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('landlord')); ?>"><i class="nav-icon la la-question"></i> Landlords</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('receipt')); ?>"><i class="nav-icon la la-question"></i> Receipts</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('tenant')); ?>"><i class="nav-icon la la-question"></i> Tenants</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('unit')); ?>"><i class="nav-icon la la-question"></i> Units</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('user')); ?>"><i class="nav-icon la la-question"></i> Users</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('type')); ?>"><i class="nav-icon la la-question"></i> Types</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('property')); ?>"><i class="nav-icon la la-question"></i> Properties</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('reciept')); ?>"><i class="nav-icon la la-question"></i> Reciepts</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('document')); ?>"><i class="nav-icon la la-question"></i> Documents</a></li>

<li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('user')); ?>'><i class='nav-icon la la-user'></i> <span>Users</span></a></li><?php /**PATH C:\wamp64\www\eTenant\resources\views/vendor/backpack/base/inc/sidebar_content.blade.php ENDPATH**/ ?>