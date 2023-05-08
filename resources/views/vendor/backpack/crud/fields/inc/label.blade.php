@php

    if (!isset($field['parentFieldName']) || !$field['parentFieldName']) {
        $fieldName = is_array($field['name']) ? current($field['name']) : $field['name'];
        $required = isset($action) && $crud->isRequired($fieldName) ? ' required' : '';
    }

    // if the developer has intentionally set the required attribute on the field
    // forget whatever is in the FormRequest, do what the developer wants
    // subfields also get here with `showAsterisk` already set.
    $field['required'] = isset($field['showAsterisk']) ? ($field['showAsterisk'] ? ' required' : '') : $required ?? '';

@endphp
<label class="d-flex align-items-center fs-6 fw-bold mb-2">
    @if ($field['required'])
        <span class="required">
            {!! $field['label'] !!}
        </span>
    @else
        {!! $field['label'] !!}
    @endif
</label>
