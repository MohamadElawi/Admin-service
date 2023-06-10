@if (Session::has('success-pass'))
<button type="text" class="alert alert-primary col-5 text-center py-1 mx-auto"
    id="type-success">{{ Session::get('success-pass') }}
</button>
@endif

@if (Session::has('error-pass'))
<button type="text" class="alert alert-danger col-5 text-center py-1 mx-auto"
    id="type-error">{{ Session::get('error-pass') }}
</button>
@endif
