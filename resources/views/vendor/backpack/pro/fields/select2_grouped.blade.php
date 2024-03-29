{{-- select2 --}}
@php
    $current_value = old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '';
    $field['allows_null'] = $field['allows_null'] ?? $field['model']::isColumnNullable($field['name']);
    $field['placeholder'] = $field['placeholder'] ?? trans('backpack::crud.select_entry');
@endphp

@include('crud::fields.inc.wrapper_start')
@include('crud::fields.inc.label')
    @include('crud::fields.inc.translatable_icon')
    @php
        $related_model = $field['model'];
        $group_by_model = (new $related_model)->{$field['group_by']}()->getRelated();
        $categories = $group_by_model::with($field['group_by_relationship_back'])->get();

        if (isset($field['model'])) {
            $categorylessEntries = $related_model::doesnthave($field['group_by'])->get();
        }
    @endphp
    <select
        name="{{ $field['name'] }}"
        style="width: 100%"
        data-init-function="bpFieldInitSelect2GroupedElement"
        data-field-is-inline="{{var_export($inlineCreate ?? false)}}"
        data-language="{{ str_replace('_', '-', app()->getLocale()) }}"
        data-field-placeholder="{{ $field['placeholder'] }}"
        data-field-allow-clear="{{ var_export($field['allows_null']) }}"
        @include('crud::fields.inc.attributes', ['default_class' =>  'form-select form-select-solid form-select-lg fw-semibold'])
        >

            @if ($field['allows_null'])
                <option value="">-</option>
            @endif

            @if (isset($field['model']) && isset($field['group_by']))
                @foreach ($categories as $category)
                    <optgroup label="{{ $category->{$field['group_by_attribute']} }}">
                        @foreach ($category->{$field['group_by_relationship_back']} as $subEntry)
                            <option value="{{ $subEntry->getKey() }}"
                                @if ( ( old($field['name']) && old($field['name']) == $subEntry->getKey() ) || (isset($field['value']) && $subEntry->getKey()==$field['value']))
                                     selected
                                @endif
                            >{{ $subEntry->{$field['attribute']} }}</option>
                        @endforeach
                    </optgroup>
                @endforeach

                @if ($categorylessEntries->count())
                    <optgroup label="-">
                        @foreach ($categorylessEntries as $subEntry)

                            @if($current_value == $subEntry->getKey())
                                <option value="{{ $subEntry->getKey() }}" selected>{{ $subEntry->{$field['attribute']} }}</option>
                            @else
                                <option value="{{ $subEntry->getKey() }}">{{ $subEntry->{$field['attribute']} }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                @endif
            @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        {{-- select2_grouped field type js --}}
        @if (app()->getLocale() !== 'en')
        <script src="{{ asset('packages/select2/dist/js/i18n/' . str_replace('_', '-', app()->getLocale()) . '.js') }}"></script>
        @endif
        @loadOnce('bpFieldInitSelect2GroupedElement')
        <script>
            function bpFieldInitSelect2GroupedElement(element) {
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

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
