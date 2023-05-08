@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
        $crud->entity_name_plural => url($crud->route),
        trans('backpack::crud.list') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <div class="d-flex flex-stack flex-row-fluid">
        {{-- begin::Toolbar container --}}
        <div class="d-flex flex-column flex-row-fluid">
            <h2>
                <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
                <small id="datatable_info_stack" class="text-muted mt-1 fw-semibold fs-6">{!! $crud->getSubheading() ?? '' !!}</small>
            </h2>
        </div>
    </div>
@endsection

@section('content')
    {{-- Default box --}}
    <div class="row">

        {{-- THE ACTUAL CONTENT --}}
        <div class="{{ $crud->getListContentClass() }}">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-toolbar">
                        @if ($crud->buttons()->where('stack', 'top')->count() || $crud->exportButtons())
                            <div class="d-print-none {{ $crud->hasAccess('create') ? 'with-border' : '' }}">

                                @include('crud::inc.button_stack', ['stack' => 'top'])

                            </div>
                        @endif
                        @if ($crud->filtersEnabled())
                            @include('crud::inc.filters_navbar')
                        @endif
                    </div>

                    <div class="card-title">

                        <div id="datatable_search_stack" class="mt-sm-0 mt-2 d-print-none">
                            <!--begin::Search-->

                            <!--end::Search-->
                        </div>
                    </div>
                    {{-- Backpack List Filters --}}
                </div>
                <div class="card-body py-4">
                    <table id="crudTable" class="table align-middle table-row-dashed table-row-gray-300 fs-6 gy-5"
                        data-responsive-table="{{ (int) $crud->getOperationSetting('responsiveTable') }}"
                        data-has-details-row="{{ (int) $crud->getOperationSetting('detailsRow') }}"
                        data-has-bulk-actions="{{ (int) $crud->getOperationSetting('bulkActions') }}"
                        data-has-line-buttons-as-dropdown="{{ (int) $crud->getOperationSetting('lineButtonsAsDropdown') }}"
                        cellspacing="0">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                {{-- Table columns --}}
                                @foreach ($crud->columns() as $column)
                                    <th class="pe-2" data-orderable="{{ var_export($column['orderable'], true) }}"
                                        data-priority="{{ $column['priority'] }}" data-column-name="{{ $column['name'] }}"
                                        {{--
                    data-visible-in-table => if developer forced field in table with 'visibleInTable => true'
                    data-visible => regular visibility of the field
                    data-can-be-visible-in-table => prevents the column to be loaded into the table (export-only)
                    data-visible-in-modal => if column apears on responsive modal
                    data-visible-in-export => if this field is exportable
                    data-force-export => force export even if field are hidden
                    --}} {{-- If it is an export field only, we are done. --}}
                                        @if (isset($column['exportOnlyField']) && $column['exportOnlyField'] === true) data-visible="false"
                      data-visible-in-table="false"
                      data-can-be-visible-in-table="false"
                      data-visible-in-modal="false"
                      data-visible-in-export="true"
                      data-force-export="true"
                    @else
                      data-visible-in-table="{{ var_export($column['visibleInTable'] ?? false) }}"
                      data-visible="{{ var_export($column['visibleInTable'] ?? true) }}"
                      data-can-be-visible-in-table="true"
                      data-visible-in-modal="{{ var_export($column['visibleInModal'] ?? true) }}"
                      @if (isset($column['visibleInExport']))
                         @if ($column['visibleInExport'] === false)
                           data-visible-in-export="false"
                           data-force-export="false"
                         @else
                           data-visible-in-export="true"
                           data-force-export="true" @endif
                                    @else data-visible-in-export="true" data-force-export="false" @endif
                                @endif
                                >
                                {{-- Bulk checkbox --}}
                                @if ($loop->first && $crud->getOperationSetting('bulkActions'))
                                    {!! View::make('crud::columns.inc.bulk_actions_checkbox')->render() !!}
                                @endif
                                {!! $column['label'] !!}
                                </th>
                                @endforeach

                                @if ($crud->buttons()->where('stack', 'line')->count())
                                    <th class="text-start min-w-100px" data-orderable="false"
                                        data-priority="{{ $crud->getActionsColumnPriority() }}"
                                        data-visible-in-export="false" data-action-column="true">
                                        {{ trans('backpack::crud.actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                {{-- Table columns --}}
                                @foreach ($crud->columns() as $column)
                                    <th class="pe-2">
                                        {{-- Bulk checkbox --}}
                                        @if ($loop->first && $crud->getOperationSetting('bulkActions'))
                                            {!! View::make('crud::columns.inc.bulk_actions_checkbox')->render() !!}
                                        @endif
                                        {!! $column['label'] !!}
                                    </th>
                                @endforeach

                                @if ($crud->buttons()->where('stack', 'line')->count())
                                    <th class="text-start min-w-100px">{{ trans('backpack::crud.actions') }}</th>
                                @endif
                            </tr>
                        </tfoot>
                    </table>

                    @if ($crud->buttons()->where('stack', 'bottom')->count())
                        <div id="bottom_buttons" class="d-print-none text-center text-sm-left">
                            @include('crud::inc.button_stack', ['stack' => 'bottom'])

                            <div id="datatable_button_stack" class="float-right text-right hidden-xs"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection

@section('after_styles')
    {{-- DATA TABLES --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    {{-- CRUD LIST CONTENT - crud_list_styles stack --}}
    @stack('crud_list_styles')
@endsection

@section('after_scripts')
    @include('crud::inc.datatables_logic')

    {{-- CRUD LIST CONTENT - crud_list_scripts stack --}}
    @stack('crud_list_scripts')
@endsection
