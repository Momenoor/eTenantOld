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
