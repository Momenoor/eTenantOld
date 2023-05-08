{{-- Select2 Backpack CRUD filter --}}
<li filter-name="{{ $filter->name }}" filter-type="{{ $filter->type }}" filter-key="{{ $filter->key }}"
    class="nav-item dropdown {{ Request::get($filter->name) ? 'active' : '' }}">
    <a href="#" class="btn btn-flex btn-center btn-sm" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end">{{ $filter->label }} <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-250px p-4"
        data-kt-menu="true">
        <div class="form-group backpack-filter mb-0">
            <select id="filter_{{ $filter->key }}" name="filter_{{ $filter->key }}"
                class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option"
                data-allow-clear="true" data-hide-search="true" data-filter-key="{{ $filter->key }}"
                data-filter-type="select2" data-filter-name="{{ $filter->name }}"
                data-language="{{ str_replace('_', '-', app()->getLocale()) }}">
                <option value="">-</option>
                @if (is_array($filter->values) && count($filter->values))
                    @foreach ($filter->values as $key => $value)
                        <option value="{{ $key }}" @if ($filter->isActive() && $filter->currentValue == $key) selected @endif>
                            {{ $value }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</li>

{{-- ########################################### --}}
{{-- Extra CSS and JS for this particular filter --}}

{{-- FILTERS EXTRA CSS --}}
{{-- push things in the after_styles section --}}

@push('crud_list_styles')
    {{-- include select2 css --}}
    {{-- <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        .form-inline .select2-container {
            display: inline-block;
        }

        .select2-drop-active {
            border: none;
        }

        .select2-container .select2-choices .select2-search-field input,
        .select2-container .select2-choice,
        .select2-container .select2-choices {
            border: none;
        }

        .select2-container-active .select2-choice {
            border: none;
            box-shadow: none;
        }

        .select2-container--bootstrap .select2-dropdown {
            margin-top: -2px;
            margin-left: -1px;
        }

        .select2-container--bootstrap {
            position: relative !important;
            top: 0px !important;
        }
    </style> --}}
@endpush


{{-- FILTERS EXTRA JS --}}
{{-- push things in the after_scripts section --}}

@push('crud_list_scripts')
    {{-- include select2 js --}}
    {{-- <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script> --}}
    @if (app()->getLocale() !== 'en')
        <script src="{{ asset('packages/select2/dist/js/i18n/' . str_replace('_', '-', app()->getLocale()) . '.js') }}">
        </script>
    @endif

    <script>
        jQuery(document).ready(function($) {
            // trigger select2 for each untriggered select2 box
            $('select[data-filter-type=select2]').not('[data-filter-enabled]').each(function() {
                var filterName = $(this).attr('data-filter-name');
                var filterKey = $(this).attr('data-filter-key');
                var element = $(this);

                $(this).attr('data-filter-enabled', 'true');

                var obj = $(this).select2({
                    dropdownParent: $(this).parent('.form-group'),
                }).on('change', function(c) {
                    var value = $(this).val();
                    var parameter = $(this).attr('data-filter-name');

                    if (!value) {
                        return;
                    }

                    var new_url = updateDatatablesOnFilterChange(filterName, value, true);

                    // mark this filter as active in the navbar-filters
                    if (URI(new_url).hasQuery(filterName, true)) {
                        $("li[filter-key=" + filterKey + "]").addClass('active');
                    }
                }).on('select2:unselecting', function(e) {

                    updateDatatablesOnFilterChange(filterName, null, true);

                    $('#filter_' + filterKey).val(null)
                    $("li[filter-key=" + filterKey + "]").removeClass("active");
                    $("li[filter-key=" + filterKey + "]").find('.menu-sub-dropdown').removeClass(
                        "show");

                    e.stopPropagation();
                    return false;
                });


                // when the dropdown is opened, autofocus on the select2
                /* $("li[filter-key=" + filterKey + "]").on('shown.bs.dropdown', function() {
                    setTimeout(() => {
                        $('select[data-filter-key=' + filterKey + ']').select2('open');
                        element.data('select2').dropdown.$search.get(0).focus();
                    }, 50);
                }); */

                // clear filter event (used here and by the Remove all filters button)
                $("li[filter-key=" + filterKey + "]").on('filter:clear', function(e) {
                    $("li[filter-key=" + filterKey + "]").removeClass('active');
                    $('#filter_' + filterKey).val(null).trigger('change');
                });
            });
        });
    </script>
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
