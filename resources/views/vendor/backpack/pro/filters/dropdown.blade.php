{{-- Dropdown Backpack CRUD filter --}}
<li filter-name="{{ $filter->name }}" filter-type="{{ $filter->type }}" filter-key="{{ $filter->key }}"
    class="nav-item dropdown {{ Request::get($filter->name) ? 'active' : '' }}">
    <a href="#" class="btn btn-flex btn-center btn-sm" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end">{{ $filter->label }} <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
        data-kt-menu="true">
        <!--begin::Header-->
        <div class="menu-item px-3">
            <a class="menu-link px-3" parameter="{{ $filter->name }}" dropdownkey="" href="">-</a>
        </div>
        <!--end::Header-->
        <!--begin::Menu separator-->
        <div class="separator border-gray-200"></div>
        @if (is_array($filter->values) && count($filter->values))
            @foreach ($filter->values as $key => $value)
                @if ($key === 'dropdown-separator')
                    <div class="separator border-gray-200"></div>
                @else
                    <div class="menu-item px-3">
                        <a class="menu-link px-3 {{ $filter->isActive() && $filter->currentValue == $key ? 'active' : '' }}"
                            parameter="{{ $filter->name }}" href=""
                            dropdownkey="{{ $key }}">{{ $value }}</a>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</li>


{{-- ########################################### --}}
{{-- Extra CSS and JS for this particular filter --}}

{{-- FILTERS EXTRA CSS --}}
{{-- push things in the after_styles section --}}

{{-- @push('crud_list_styles')
	no css
@endpush --}}


{{-- FILTERS EXTRA JS --}}
{{-- push things in the after_scripts section --}}

@push('crud_list_scripts')
    <script>
        jQuery(document).ready(function($) {
            $("li.dropdown[filter-key={{ $filter->key }}] .menu-sub-dropdown a").click(function(e) {
                e.preventDefault();

                var value = $(this).attr('dropdownkey');
                var parameter = $(this).attr('parameter');

                var new_url = updateDatatablesOnFilterChange(parameter, value, true);

                // mark this filter as active in the navbar-filters
                // mark dropdown items active accordingly
                if (URI(new_url).hasQuery('{{ $filter->name }}', true)) {
                    $("li[filter-key={{ $filter->key }}]").removeClass('active').addClass('active');
                    $("li[filter-key={{ $filter->key }}] .menu-sub-dropdown a").removeClass('active');
                    $(this).addClass('active');
                } else {
                    $("li[filter-key={{ $filter->key }}]").trigger("filter:clear");
                }
            });

            // clear filter event (used here and by the Remove all filters button)
            $("li[filter-key={{ $filter->key }}]").on('filter:clear', function(e) {
                $("li[filter-key={{ $filter->key }}]").removeClass('active');
                $("li[filter-key={{ $filter->key }}] .menu-sub-dropdown a").removeClass('active');
            });
        });
    </script>
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
