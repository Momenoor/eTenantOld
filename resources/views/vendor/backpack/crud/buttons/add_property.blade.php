{{-- <form action="{{ route('property.create') }}" method="post">

    <button type="submit">

    </button>
</form> --}}

<a href="{{ route('landlord.property.create', $entry->getKey()) }}" class="btn btn-icon btn-primary  btn-sm  me-3"
    data-button-type="add"><i class="fa fa-building fs-2">
        <span class="path1"></span>
        <span class="path2"></span>
    </i></a>
{{--
@loadOnce('delete_button_script')
    @push('after_scripts') @if (request()->ajax())
    @endpush
@endif
<script>
    function add(button) {
        var route = $(button).attr('data-route');
        $.ajax({
            url: route,
            type: 'POST',
            success: function(response) {
                document.write(response);
            },
        });
    }
</script>
@if (!request()->ajax())
@endpush
@endif
@endLoadOnce
 --}}
