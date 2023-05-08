@php
    $field['attributes'] = $field['attributes'] ?? [];
    $field['attributes']['class'] = $field['attributes']['class'] ?? $default_class ?? 'form-control form-control-lg form-control-solid mb-3 mb-lg-0';
@endphp

@foreach ($field['attributes'] as $attribute => $value)
	@if (is_string($attribute))
    {{ $attribute }}="{{ $value }}"
    @endif
@endforeach
