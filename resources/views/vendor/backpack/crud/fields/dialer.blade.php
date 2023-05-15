@php
    $field['min'] = $field['min'] ?? 0;
    $field['max'] = $field['max'] ?? 1000000;
    $field['step'] = $field['step'] ?? 1;
    $field['prefix'] = $field['prefix'] ?? '';
    $field['decimals'] = $field['decimals'] ?? 0;
    $field['attributes'] = $field['attributes'] ?? [];
    $field['attributes']['class'] = $field['attributes']['class'] = $field['attributes']['class'] ?? ($default_class ?? 'form-control form-control-lg form-control-solid mb-3 mb-lg-0 ps-12');
@endphp

@include('crud::fields.inc.wrapper_start')
@include('crud::fields.inc.label')
@include('crud::fields.inc.translatable_icon')
<div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="{{ $field['min'] }}"
    data-kt-dialer-max="{{ $field['max'] }}" data-kt-dialer-step="{{ $field['step'] }}"
    data-kt-dialer-prefix="{{ $field['prefix'] }}" data-kt-dialer-decimals="{{ $field['decimals'] }}">

    <!--begin::Decrease control-->
    <button type="button"
        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
        data-kt-dialer-control="decrease">
        <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
    </button>
    <!--end::Decrease control-->

    <!--begin::Input control-->
    <input type="text" name="{{ $field['name'] }}" readonly
        value="{{ old_empty_or_null($field['name'], '') ?? ($field['value'] ?? ($field['default'] ?? '')) }}"
        data-kt-dialer-control="input" @include('crud::fields.inc.attributes') />
    <!--end::Input control-->

    <!--begin::Increase control-->
    <button type="button"
        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
        data-kt-dialer-control="increase">
        <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span
                class="path3"></span></i>
    </button>
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
    <!--end::Increase control-->
</div>
@include('crud::fields.inc.wrapper_end')
