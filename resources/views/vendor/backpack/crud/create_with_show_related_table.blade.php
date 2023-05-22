@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
        $crud->entity_name_plural => url($crud->route),
        trans('backpack::crud.add') => false,
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
                <small class="text-muted mt-1 fw-semibold fs-6">{!! $crud->getSubheading() ?? trans('backpack::crud.add') . ' ' . $crud->entity_name !!}.</small>

                @if ($crud->hasAccess('list'))
                    <small class="text-muted mt-1 fw-semibold fs-6"><a href="{{ url($crud->route) }}"
                            class="d-print-none font-sm"><i
                                class="la la-angle-double-{{ config('backpack.base.html_direction') == 'rtl' ? 'right' : 'left' }}"></i>
                            {{ trans('backpack::crud.back_to_all') }}
                            <span>{{ $crud->entity_name_plural }}</span></a></small>
                @endif
            </h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">

        <div class="{{ $crud->getCreateContentClass() }}">
            {{-- Default box --}}

            @include('crud::inc.grouped_errors')
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bold">
                        {!! $crud->getSubheading() ?? trans('backpack::crud.add') . ' ' . $crud->entity_name !!}
                    </div>
                </div>
                <form method="post" action="{{ url($crud->route) }}"
                    @if ($crud->hasUploadFields('create')) enctype="multipart/form-data" @endif>
                    {!! csrf_field() !!}
                    {{-- load the view from the application if it exists, otherwise load the one in the package --}}
                    @if (view()->exists('vendor.backpack.crud.form_content'))
                        @include('vendor.backpack.crud.form_content', [
                            'fields' => $crud->fields(),
                            'action' => 'create',
                        ])
                    @else
                        @include('crud::form_content', ['fields' => $crud->fields(), 'action' => 'create'])
                    @endif
                    {{-- This makes sure that all field assets are loaded. --}}
                    <div class="d-none" id="parentLoadedAssets">{{ json_encode(Assets::loaded()) }}</div>
                    <div class="card-footer">
                        @include('crud::inc.form_save_buttons')
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4">
            <div id="relatedView">

            </div>
        </div>
        @include(backpack_view('inc.widgets'), [
            'widgets' => app('widgets')->where('section', 'after_inner_content')->toArray(),
        ])
    </div>
@endsection
@push('after_scripts')
    <script>
        $.ajax({
            url: '{{ route($route, $related) }}',
            mothod: 'GET',
            success: function(result) {
                $('#relatedView').html(result);
            }

        })
    </script>
@endpush
