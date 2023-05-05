@if (Session::has('success'))
                <button type="text" class="alert alert-primary col-5 text-center py-1 mx-auto"
                    id="type-error">{{ Session::get('success') }}
                </button>
            @endif

            @if (Session::has('error'))
                <button type="text" class="alert alert-danger col-5 text-center py-1 mx-auto"
                    id="type-error">{{ Session::get('error') }}
                </button>
            @endif



