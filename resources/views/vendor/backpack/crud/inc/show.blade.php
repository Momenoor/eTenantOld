@php
    $defaultBreadcrumbs = [
        trans('backpack::crud.admin') => backpack_url('dashboard'),
        $crud->entity_name_plural => url($crud->route),
        trans('backpack::crud.preview') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <div class="d-flex flex-stack col-8 align-items-stretch flex-row-fluid d-print-none">
        {{-- begin::Toolbar container --}}
        <div class="m-0 d-flex">
            <h2>
                <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
                <small class="text-muted mt-1 fw-semibold fs-6">{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')) . ' ' . $crud->entity_name !!}.</small>
                @if ($crud->hasAccess('list'))
                    <small class="text-muted mt-1 fw-semibold fs-6"><a href="{{ url($crud->route) }}" class="font-sm"><i
                                class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                            <span>{{ $crud->entity_name_plural }}</span></a></small>
                @endif
            </h2>
        </div>
        <div class="m-0">
            <a href="javascript: window.print();" class="btn btn-flex"><i class="la la-print"></i></a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="{{ $crud->getShowContentClass() }}">
            <div class="">
                @if ($crud->model->translationEnabled())
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            {{-- Change translation button group --}}
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ trans('backpack::crud.language') }}:
                                    {{ $crud->model->getAvailableLocales()[request()->input('_locale') ? request()->input('_locale') : App::getLocale()] }}
                                    &nbsp; <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                                        <a class="dropdown-item"
                                            href="{{ url($crud->route . '/' . $entry->getKey() . '/show') }}?_locale={{ $key }}">{{ $locale }}</a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Default box --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title fs-3 fw-bold">
                            {!! $crud->getSubheading() ?? trans('backpack::crud.preview') . ' ' . $crud->entity_name !!}
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped gs-7 mb-0">
                            <tbody>
                                @foreach ($crud->columns() as $column)
                                    <tr>
                                        <td class="fw-semibold fs-6 text-muted">
                                            <strong>{!! $column['label'] !!}:</strong>
                                        </td>
                                        <td class="fw-semibold fs-6 ">
                                            @php
                                                // create a list of paths to column blade views
                                                // including the configured view_namespaces
                                                $columnPaths = array_map(function ($item) use ($column) {
                                                    return $item . '.' . $column['type'];
                                                }, \Backpack\CRUD\ViewNamespaces::getFor('columns'));

                                                // but always fall back to the stock 'text' column
                                                // if a view doesn't exist
if (!in_array('crud::columns.text', $columnPaths)) {
    $columnPaths[] = 'crud::columns.text';
                                                }
                                            @endphp
                                            @includeFirst($columnPaths)
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer  d-print-none">
                        @if ($crud->buttons()->where('stack', 'line')->count())
                            <tr>
                                <td><strong>{{ trans('backpack::crud.actions') }}</strong></td>
                                <td>
                                    @include('crud::inc.button_stack', ['stack' => 'line'])
                                </td>
                            </tr>
                        @endif
                    </div>
                    {{-- load the view from the application if it exists, otherwise load the one in the package --}}
                </div>
            </div>
        </div>
    </div>
