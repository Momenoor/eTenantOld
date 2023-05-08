@if (backpack_auth()->check())
    {{-- Left side column. contains the sidebar --}}
    <div id="kt_app_sidebar" class="{{ config('backpack.base.sidebar_class') }}" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Sidebar navbar-->
        <div class="app-sidebar-navbar flex-grow-1 hover-scroll-overlay-y" id="kt_app_sidebar_primary_navbar" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_primary_footer" data-kt-scroll-wrappers="#kt_app_sidebar_primary_navbar" data-kt-scroll-offset="5px">
            <!--begin::Navbar-->
            @include(backpack_view('inc.sidebar_content'))
            <!--end::Navbar-->
        </div>
        <!--end::Sidebar navbar-->
    </div>
@endif
