{{-- select2 --}}
@php
    $current_value = old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '';

    //if it's part of a relationship here we have the full related model, we want the key.
    if (is_object($current_value) && is_subclass_of(get_class($current_value), 'Illuminate\Database\Eloquent\Model') ) {
        $current_value = $current_value->getKey();
    }
    if (!isset($field['options'])) {
        $options = $field['model']::all();
    } else {
        $options = call_user_func($field['options'], $field['model']::query());
    }
    $field['allows_null'] = $field['allows_null'] ?? $crud->model::isColumnNullable($field['name']);
    $field['placeholder'] = $field['placeholder'] ?? trans('backpack::crud.select_entry');
@endphp

@include('crud::fields.inc.wrapper_start')

@include('crud::fields.inc.label')
    @include('crud::fields.inc.translatable_icon')

    <select
        name="{{ $field['name'] }}"
        style="width: 100%"
        data-field-is-inline="{{var_export($inlineCreate ?? false)}}"
        data-init-function="bpFieldInitSelect2Element"
        data-language="{{ str_replace('_', '-', app()->getLocale()) }}"
        data-field-placeholder="{{$field['placeholder']}}"
        data-field-allow-clear="{{var_export($field['allows_null'])}}"
        @include('crud::fields.inc.attributes', ['default_class' =>  'form-select form-select-solid form-select-lg fw-semibold'])
        >

        @if ($field['allows_null'])
            <option value="">-</option>
        @endif

        @if (count($options))
            @foreach ($options as $option)
                @if($current_value == $option->getKey())
                    <option value="{{ $option->getKey() }}" selected>{{ $option->{$field['attribute']} }}</option>
                @else
                    <option value="{{ $option->getKey() }}">{{ $option->{$field['attribute']} }}</option>
                @endif
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        {{-- include select2 js --}}
        @if (app()->getLocale() !== 'en')
            @loadOnce('packages/select2/dist/js/i18n/' . str_replace('_', '-', app()->getLocale()) . '.js')
        @endif
        @loadOnce('bpFieldInitSelect2Element')
        <script>
            function bpFieldInitSelect2Element(element) {
                // element will be a jQuery wrapped DOM node
                if (!element.hasClass("select2-hidden-accessible"))
                {
                    let isFieldInline = element.data('field-is-inline');
                    let placeholder = element.data('field-placeholder');
                    let allowClear = element.data('field-allow-clear');

                    element.select2({

                        placeholder: placeholder,
                        allowClear: allowClear,
                        dropdownParent: isFieldInline ? $('#inline-create-dialog .modal-content') : $(document.body)
                    });
                }
            }
        </script>
        @endLoadOnce
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
