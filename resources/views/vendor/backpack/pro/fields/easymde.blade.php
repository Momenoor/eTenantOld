{{-- Simple MDE - Markdown Editor --}}
@include('crud::fields.inc.wrapper_start')
@include('crud::fields.inc.label')
    @include('crud::fields.inc.translatable_icon')
    <textarea
        name="{{ $field['name'] }}"
        data-init-function="bpFieldInitEasyMdeElement"
        bp-field-main-input
        data-easymdeAttributesRaw="{{ isset($field['easymdeAttributesRaw']) ? "{".$field['easymdeAttributesRaw']."}" : "{}" }}"
        data-easymdeAttributes="{{ isset($field['easymdeAttributes']) ? json_encode($field['easymdeAttributes']) : "{}" }}"
        @include('crud::fields.inc.attributes', ['default_class' => 'form-control'])
    	>{{ old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '' }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        @loadOnce('packages/easymde/dist/easymde.min.css')
        @loadOnce('easymdeCss')
        <style type="text/css">
            .editor-toolbar {
                border: 1px solid #ddd;
                border-bottom: none;
            }
        </style>
        @endLoadOnce
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        @loadOnce('packages/easymde/dist/easymde.min.js')
        @loadOnce('bpFieldInitEasyMdeElement')
        <script>
            function bpFieldInitEasyMdeElement(element) {
                if (element.attr('data-initialized') == 'true') {
                    return;
                }

                if (typeof element.attr('id') == 'undefined') {
                    element.attr('id', 'EasyMDE_'+Math.ceil(Math.random() * 1000000));
                }

                var elementId = element.attr('id');
                var easymdeAttributes = JSON.parse(element.attr('data-easymdeAttributes'));
                var easymdeAttributesRaw = JSON.parse(element.attr('data-easymdeAttributesRaw'));
                var configurationObject = {
                    element: document.getElementById(elementId),
                };

                configurationObject = Object.assign(configurationObject, easymdeAttributes, easymdeAttributesRaw);

                if (!document.getElementById(elementId)) {
                    return;
                }

                var easyMDE = new EasyMDE(configurationObject);

                easyMDE.options.minHeight = easyMDE.options.minHeight || "300px";
                easyMDE.codemirror.getScrollerElement().style.minHeight = easyMDE.options.minHeight;

                // update the original textarea on keypress
                easyMDE.codemirror.on("change", function(){
                    element.val(easyMDE.value()).trigger('change');
                });

                element.on('CrudField:disable', function(e) {
                    element.parent().find('div.editor-toolbar').first().hide()
                    easyMDE.togglePreview(easyMDE);
                });

                element.on('CrudField:enable', function(e) {
                    element.parent().find('div.editor-toolbar').first().show()
                    easyMDE.togglePreview(easyMDE);
                });

                // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                //     setTimeout(function() { easyMDE.codemirror.refresh(); }, 10);
                // });
            }
        </script>
        @endLoadOnce
    @endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
