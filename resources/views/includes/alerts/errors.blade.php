@if(Session::has('error'))
    <div class="row mr-2 ml-2" >
            <button type="text" class="alert alert-danger col-5 text-center py-1 mx-auto"
                    id="type-error">{{Session::get('error')}}
            </button>
    </div>
@endif
