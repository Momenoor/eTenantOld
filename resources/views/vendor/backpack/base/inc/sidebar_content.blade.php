{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('contract') }}"><i class="nav-icon la la-question"></i> Contracts</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('installment') }}"><i class="nav-icon la la-question"></i> Installments</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('invoice') }}"><i class="nav-icon la la-question"></i> Invoices</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('landlord') }}"><i class="nav-icon la la-question"></i> Landlords</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('receipt') }}"><i class="nav-icon la la-question"></i> Receipts</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('tenant') }}"><i class="nav-icon la la-question"></i> Tenants</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('unit') }}"><i class="nav-icon la la-question"></i> Units</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-question"></i> Users</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('type') }}"><i class="nav-icon la la-question"></i> Types</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('property') }}"><i class="nav-icon la la-question"></i> Properties</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('reciept') }}"><i class="nav-icon la la-question"></i> Reciepts</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('document') }}"><i class="nav-icon la la-question"></i> Documents</a></li>
