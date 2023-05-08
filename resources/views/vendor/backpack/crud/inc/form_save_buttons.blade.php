@if (isset($saveAction['active']) && !is_null($saveAction['active']['value']))
    <div id="saveActions" class="form-group">

        <input type="hidden" name="_save_action" value="{{ $saveAction['active']['value'] }}">
        @if (!empty($saveAction['options']))
            <div class="btn-group" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
        @endif

        <button type="submit" class="btn btn-primary" data-kt-button="true">
            <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
            <span data-value="{{ $saveAction['active']['value'] }}">{{ $saveAction['active']['label'] }}</span>

        </button>
        @if (!empty($saveAction['options']))
            <div class="btn btn-primary rotate p-0 w-40px" data-kt-button="true" >
                <a id="bpSaveButtonsGroup" class="" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end"><i class="ki-duotone ki-down fs-3 rotate-180 ms-3 me-0"></i></a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px mb-4 "
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator mb-3 opacity-75"></div>
                    <!--end::Menu separator-->

                    <!--begin::Menu item-->
                    @foreach ($saveAction['options'] as $value => $label)
                        <div class="menu-item px-3 @if ($loop->last) mb-3 @endif">
                            <button type="button" data-value="{{ $value }}" class="btn menu-link px-3">
                                {{ $label }}
                            </button>
                        </div>
                    @endforeach
                    <!--end::Menu item-->

                    <!--begin::Menu item-->

                </div>
            </div>
    </div>

@endif

@if (!$crud->hasOperationSetting('showCancelButton') || $crud->getOperationSetting('showCancelButton') == true)
    <a href="{{ $crud->hasAccess('list') ? url($crud->route) : url()->previous() }}" class="btn btn-light"><span
            class="la la-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a>
@endif

@if ($crud->get('update.showDeleteButton') && $crud->get('delete.configuration') && $crud->hasAccess('delete'))
    <button onclick="confirmAndDeleteEntry()" type="button" class="btn btn-danger float-right"><i
            class="la la-trash-alt"></i> {{ trans('backpack::crud.delete') }}</button>
@endif
</div>
@endif

@push('after_scripts')
    <script>
        // this function checks if form is valid.
        function checkFormValidity(form) {
            // the condition checks if `checkValidity` is defined in the form (browser compatibility)
            if (form[0].checkValidity) {
                return form[0].checkValidity();
            }
            return false;
        }

        // this function checks if any of the inputs has errors and report them on page.
        // we use it to report the errors after form validation fails and making the error fields visible
        function reportValidity(form) {
            // the condition checks if `reportValidity` is defined in the form (browser compatibility)
            if (form[0].reportValidity) {
                // hide the save actions drop down if open
                $('#saveActions').find('.menu-dropdown').removeClass('active').removeClass('show').removeClass(
                    'menu-dropdown');
                // validate and display form errors
                form[0].reportValidity();
            }
        }

        function changeTabIfNeededAndDisplayErrors(form) {
            // we get the first erroed field
            var $firstErrorField = form.find(":invalid").first();
            // we find the closest tab
            var $closestTab = $($firstErrorField).closest('.tab-pane');
            // if we found the tab we will change to that tab before reporting validity of form
            if ($closestTab.length) {
                var id = $closestTab.attr('id');
                // switch tabs
                $('.nav a[href="#' + id + '"]').tab('show');
            }
            reportValidity(form);
        }

        // make all submit buttons trigger HTML5 validation
        jQuery(document).ready(function($) {

            var selector = $('#bpSaveButtonsGroup').next();
            var form = $(selector).closest('form');
            var saveActionField = $('[name="_save_action"]');
            var $defaultSubmitButton = $(form).find(':submit');
            // this is the main submit button, the default save action.
            $($defaultSubmitButton).on('click', function(e) {
                e.preventDefault();
                $saveAction = $(this).children('span').eq(1);
                // if form is valid just submit it
                if (checkFormValidity(form)) {
                    saveActionField.val($saveAction.attr('data-value'));
                    form[0].requestSubmit();
                } else {
                    // navigate to the tab where the first error happens
                    changeTabIfNeededAndDisplayErrors(form);
                }
            });

            //this is for the anchors AKA other non-default save actions.
            $(selector).find('button').each(function() {
                $(this).click(function(e) {
                    //we check if form is valid
                    if (checkFormValidity(form)) {
                        //if everything is validated we proceed with the submission
                        var saveAction = $(this).data('value');
                        saveActionField.val(saveAction);
                        form[0].requestSubmit();
                    } else {
                        // navigate to the tab where the first error happens
                        changeTabIfNeededAndDisplayErrors(form);
                    }
                    e.stopPropagation();
                });
            });
        });
    </script>

    @if ($crud->get('update.showDeleteButton') && $crud->get('delete.configuration') && $crud->hasAccess('delete'))
        <script>
            function confirmAndDeleteEntry() {
                // Ask for confirmation before deleting an item
                swal({
                    title: "{!! trans('backpack::base.warning') !!}",
                    text: "{!! trans('backpack::crud.delete_confirm') !!}",
                    icon: "warning",
                    buttons: ["{!! trans('backpack::crud.cancel') !!}", "{!! trans('backpack::crud.delete') !!}"],
                    dangerMode: true,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            url: '{{ url($crud->route . '/' . $entry->getKey()) }}',
                            type: 'DELETE',
                            success: function(result) {
                                if (result !== '1') {
                                    // if the result is an array, it means
                                    // we have notification bubbles to show
                                    if (result instanceof Object) {
                                        // trigger one or more bubble notifications
                                        Object.entries(result).forEach(function(entry) {
                                            var type = entry[0];
                                            entry[1].forEach(function(message, i) {
                                                new Noty({
                                                    type: type,
                                                    text: message
                                                }).show();
                                            });
                                        });
                                    } else { // Show an error alert
                                        swal({
                                            title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                                            text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                                            icon: "error",
                                            timer: 4000,
                                            buttons: false,
                                        });
                                    }
                                }
                                // All is good, show a success message!
                                swal({
                                    title: "{!! trans('backpack::crud.delete_confirmation_title') !!}",
                                    text: "{!! trans('backpack::crud.delete_confirmation_message') !!}",
                                    icon: "success",
                                    buttons: false,
                                    closeOnClickOutside: false,
                                    closeOnEsc: false,
                                });

                                // Redirect in 1 sec so that admins get to see the success message
                                setTimeout(function() {
                                    window.location.href =
                                        '{{ is_bool($crud->get('update.showDeleteButton')) ? url($crud->route) : (string) $crud->get('update.showDeleteButton') }}';
                                }, 1000);
                            },
                            error: function() {
                                // Show an alert with the result
                                swal({
                                    title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                                    text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                                    icon: "error",
                                    timer: 4000,
                                    buttons: false,
                                });
                            }
                        });
                    }
                });
            }
        </script>
    @endif
@endpush
