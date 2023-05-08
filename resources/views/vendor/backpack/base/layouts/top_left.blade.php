<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('backpack.base.html_direction') }}">
{{-- begin::Head --}}

<head>
    @include(backpack_view('inc.head'))
</head>
{{-- end::Head --}}
{{-- begin::Body --}}

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="{{ config('backpack.base.body_class') }}">
    {{-- begin::Theme mode setup on page load --}}
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    {{-- end::Theme mode setup on page load --}}
    {{-- begin::App --}}
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        {{-- begin::Page --}}
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            {{-- begin::Header --}}
            @include(backpack_view('inc.main_header'))
            {{-- end::Header --}}
            {{-- begin::Wrapper --}}
            <div class="app-wrapper d-flex" id="kt_app_wrapper">
                {{-- begin::Wrapper container --}}
                <div class="app-container container-fluid">
                    {{-- begin::Sidebar --}}
                    @include(backpack_view('inc.sidebar'))
                    {{-- end::Sidebar --}}
                    {{-- begin::Main --}}
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        {{-- begin::Content wrapper --}}
                        <div class="d-flex flex-column flex-column-fluid">
                            {{-- begin::Toolbar --}}
                            <div id="kt_app_toolbar" class="app-toolbar">
                                {{-- begin::Toolbar container --}}
                                <div class="d-flex flex-stack flex-row-fluid">
                                    {{-- begin::Toolbar container --}}
                                    <div class="d-flex flex-column flex-row-fluid">
                                        {{-- begin::Toolbar wrapper --}}
                                        {{-- begin::Breadcrumb --}}
                                        @yield('before_breadcrumbs_widgets')
                                        @includeWhen(isset($breadcrumbs), backpack_view('inc.breadcrumbs'))
                                        @yield('after_breadcrumbs_widgets')
                                        {{-- end::Breadcrumb --}}
                                    </div>
                                    {{-- end::Toolbar container --}}
                                    {{-- begin::Actions --}}
                                    @include(backpack_view('inc.actions'))
                                    {{-- end::Actions --}}
                                </div>
                                {{-- end::Toolbar container --}}

                            </div>
                            @yield('header')
                            {{-- end::Toolbar --}}
                            {{-- begin::Content --}}
                            <div id="kt_app_content" class="app-content">
                                @yield('before_content_widgets')
                                {{-- begin::About card --}}
                                @yield('content')
                                {{-- end::About card --}}
                                @yield('after_content_widgets')
                            </div>
                            {{-- end::Content --}}
                        </div>
                        {{-- end::Content wrapper --}}
                        {{-- begin::Footer --}}
                        <div id="kt_app_footer" class="{{ config('backpack.base.footer_class') }}">
                            @include(backpack_view('inc.footer'))
                        </div>
                        {{-- end::Footer --}}
                    </div>
                    {{-- end:::Main --}}
                </div>
                {{-- end::Wrapper container --}}
            </div>
            {{-- end::Wrapper --}}
        </div>
        {{-- end::Page --}}
    </div>
    {{-- end::App
    {{-- begin::Javascript --}}
    <script>
        var hostUrl = "assets/";
    </script>
    {{-- begin::Global Javascript Bundle(mandatory for all pages) --}}
    @yield('before_scripts')
    @stack('before_scripts')

    @include(backpack_view('inc.scripts'))

    @yield('after_scripts')
    @stack('after_scripts')
    {{-- end::Custom Javascript --}}
    {{-- end::Javascript --}}
</body>
{{-- end::Body --}}

</html>
