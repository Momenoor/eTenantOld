<div id="kt_app_header" class="{{ config('backpack.base.header_class') }}">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <!--begin::Header mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-color-white btn-active-color-primary w-35px h-35px"
                id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Header mobile toggle-->
        <!--begin::Logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-5 me-lg-0">
            <a href="{{ url(config('backpack.base.home_link')) }}">
                <img alt="Logo" src="{{ asset('assets/media/logos/demo46.svg') }}" class="d-none d-sm-block" />
                <img alt="Logo" src="{{ asset('assets/media/logos/demo46-small.svg') }}"
                    class="d-block d-sm-none" />
            </a>
        </div>
        <!--end::Logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            @include(backpack_view('inc.menu'))
            <!--end::Menu wrapper-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
