{{-- switch field --}}
@php
    $field['value'] = old_empty_or_null($field['name'], '') ?? ($field['value'] ?? ($field['default'] ?? '0'));
    $field['onLabel'] = $field['onLabel'] ?? '';
    $field['offLabel'] = $field['offLabel'] ?? '';
    $field['color'] = $field['color'] ?? 'primary';
@endphp

{{-- Wrapper --}}
@include('crud::fields.inc.wrapper_start')

{{-- Translatable icon --}}
@include('crud::fields.inc.translatable_icon')

<div class="form-check form-switch form-check-custom form-check-solid">
    <input type="hidden" name="{{ $field['name'] }}" value="{{ (int) $field['value'] }}" />
    <input class="form-check-input" data-init-function="bpFieldInitSwitch" type="checkbox"
        {{ (bool) $field['value'] ? 'checked' : '' }} style="--bg-color: {{ $field['color'] }};" />
    <label class="form-check-label fw-semibold text-gray-800 ms-3"
        data-checked="{{ $field['onLabel'] ?? '' }}" data-unchecked="{{ $field['offLabel'] ?? '' }}">{!! $field['label'] !!}</label>
</div>

{{-- Hint --}}
@isset($field['hint'])
    <p class="help-block">{!! $field['hint'] !!}</p>
@endisset
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}

{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('crud_fields_scripts')
    @loadOnce('bpFieldInitSwitchScript')
        <script>
            function bpFieldInitSwitch($element) {
                let element = $element[0];
                let hiddenElement = element.previousElementSibling;
                let id = `switch_${hiddenElement.name}_${Math.random() * 1e18}`;

                // set unique IDs so that labels are correlated with inputs
                element.setAttribute('id', id);

                // set the default checked/unchecked state
                // if the field has been loaded with javascript
                hiddenElement.value !== '0' ?
                    element.setAttribute('checked', true) :
                    element.removeAttribute('checked');

                // JS Field API
                $(hiddenElement).on('CrudField:disable', () => element.setAttribute('disabled', true));
                $(hiddenElement).on('CrudField:enable', () => element.removeAttribute('disabled'));

                // when the checkbox is clicked
                // set the correct value on the hidden input
                $element.on('change', () => {
                    hiddenElement.value = element.checked ? 1 : 0;
                    hiddenElement.dispatchEvent(new Event('change'));
                });
            }
        </script>
    @endLoadOnce
@endpush

@push('crud_fields_styles')
    @loadOnce('bpFieldInitSwitchStyle')
        <style>
            .form-check-input:checked+.switch-slider {
                background-color: var(--bg-color);
            }
        </style>
    @endLoadOnce
@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
