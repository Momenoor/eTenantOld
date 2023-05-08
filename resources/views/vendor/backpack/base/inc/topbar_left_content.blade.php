{{-- This file is used to store topbar (left) items --}}
<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
    data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
    data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
    data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
    <!--begin::Menu-->
    <div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
        id="kt_app_header_menu" data-kt-menu="true">

        <!--begin:Menu item-->
        @foreach (\App\Models\Menu::getTree() as $item)
            @if ($item->hasChildren())
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                    class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                @else
                    <div class="menu-item">
            @endif
            <a class="menu-link" href="{{ $item->hasChildren() ? '#' : $item->url() }}">
                <span class="menu-title">{{ $item->name }}</span>
                @if ($item->hasChildren())
                    <span class="menu-arrow"></span>
                @endif
            </a>
            @if ($item->hasChildren())
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                    <!--begin:Dashboards menu-->
                    <h4 class="fs-6 fs-4 text-gray-800 fw-bold mt-3 mb-3 ms-4">{{ $item->name }}
                    </h4>
                    @foreach ($item->children as $children)
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ $children->url() }}" {{-- title="Check out over 200 in-house components, plugins and ready for use solutions"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right" --}}>
                                {{-- <span class="menu-icon">
                                <i class="ki-duotone ki-rocket fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span> --}}
                                <span class="menu-title">{{ $children->name }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endforeach
                    <!--end:Dashboards menu-->
                </div>
            @endif
    </div>
    @endforeach
    <!--end:Menu link-->
    <!--begin:Menu sub-->

    <!--end:Menu sub-->

    <!--end:Menu item-->
</div>
<!--end::Menu-->
</div>
{{-- <li class="nav-item px-3"><a class="nav-link" href="#">Dashboard</a></li>
<li class="nav-item px-3"><a class="nav-link" href="#">Users</a></li>
<li class="nav-item px-3"><a class="nav-link" href="#">Settings</a></li> --}}
