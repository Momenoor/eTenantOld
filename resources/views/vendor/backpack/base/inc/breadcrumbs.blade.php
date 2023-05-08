
@if (config('backpack.base.breadcrumbs') && isset($breadcrumbs) && is_array($breadcrumbs) && count($breadcrumbs))
<ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3">
    <!--begin::Item-->
    <li class="breadcrumb-item text-gray-600 fw-bold lh-1">
        <a href="{{ url('/') }}" class="text-gray-600">
            <i class="ki-duotone ki-home text-gray-500 fs-2"></i>
        </a>
    </li>
    <li class="breadcrumb-item">
        <i class="ki-duotone ki-right fs-3 text-gray-500 mx-n1"  aria-current="page"></i>
    </li>
    @foreach ($breadcrumbs as $label => $link)
    @if ($link)
    <li class="breadcrumb-item text-gray-600 fw-bold lh-1">
        <a href="{{ $link }}" class="text-gray-600">
            {{ $label }}
        </a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <i class="ki-duotone ki-right fs-3 text-gray-500 mx-n1"  aria-current="page"></i>
    </li>
    @else
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-gray-600 fw-bold lh-1">{{ $label }}</li>
    @endif
    @endforeach
    <!--end::Item-->
</ul>
@endif
