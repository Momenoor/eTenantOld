@php
	$field['wrapper'] = $field['wrapper'] ?? $field['wrapperAttributes'] ?? [];

    // each wrapper attribute can be a callback or a string
    // for those that are callbacks, run the callbacks to get the final string to use
    foreach($field['wrapper'] as $attributeKey => $value) {
        $field['wrapper'][$attributeKey] = !is_string($value) && $value instanceof \Closure ? $value($crud, $field, $entry ?? null) : $value ?? '';
    }
	// if the field is required in any of the crud validators (FormRequest, controller validation or field validation)
	// we add an astherisc for it. Case it's a subfield, that check is done upstream in repeatable_row.
	// the reason for that is that here the field name is already the repeatable name: parent[row][fieldName]
    $madontaryClass = '';
    if($field['type'] != 'separator' && $field['type'] != 'clearfix'){
        $madontaryClass = ' mb-8';
    }

	$field['wrapper']['class'] = $field['wrapper']['class'] ?? "form-group col-sm-12";
	$field['wrapper']['class'] = $field['wrapper']['class'] .$madontaryClass;
	$field['wrapper']['element'] = $field['wrapper']['element'] ?? 'div';
	$field['wrapper']['bp-field-wrapper'] = 'true';
	$field['wrapper']['bp-field-name'] = square_brackets_to_dots(implode(',', (array)$field['name']));
	$field['wrapper']['bp-field-type'] = $field['type'];
@endphp

<{{ $field['wrapper']['element'] }}
	@foreach($field['wrapper'] as $attribute => $value)
	    {{ $attribute }}="{{ $value }}"
	@endforeach
>
