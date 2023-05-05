@extends('layouts.contentLayoutMaster')

@section('title', 'users')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <style>
        #users_wrapper { margin :10px;}
    </style>
    {{-- <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" media="all" /> --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-10">
        </div>
        <div class="col-2">
            <a class="btn btn-primary" href="{{ route('users.create') }}">
                Add new record
            </a>

        </div>
    @include('includes.alerts.success')
    @include('includes.alerts.errors')
    <div class="alert alert-success col-5 text-center py-1 mx-auto" id="success-msg" style="display: none"></div>
    <div class="alert alert-danger col-5 text-center py-1 mx-auto" id="error_msg" style="display: none"></div>

    <!-- edit-Modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">edit user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="form-edit">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Enter email">
                            <span class="text-danger" id="editnameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="enter email" style="text-align: left">
                            <span class="text-danger" id="editemailError"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone"
                                placeholder="Enter phone">
                            <span class="text-danger" id="editphoneError"></span>
                        </div>
                        {{-- <div class="form-group">
                            <label for="email">Address</label>
                            <input type="email" name="address" class="form-control" id="address"
                                placeholder="enter address" style="text-align: left">
                            <span class="text-danger" id="editaddressError"></span>
                        </div> --}}
                        <div class="form-group">
                            <label for="">type</label>
                            <select class="form-control w-100 @error('type') is-invalid @enderror" name="type">
                                <!-- <option label=" "></option> -->
                                <option value='admin'>admin</option>
                                <option value='superAdmin'>superAdmin</option>
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id='close-btn'>Close</button>
                    <button type="button" class="btn btn-primary" id="sub-edit" >Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- show-Modal -->
    <div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">show admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table-responsive ">
                        <tr height="50px">
                            <td><strong>Name: </strong></td>
                            <td id="show-name"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>email:</strong></td>
                            <td id="show-email"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>phone: </strong></td>
                            <td id="show-phone"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>type:</strong></td>
                            <td id="show-type"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>status: </strong></td>
                            <td id="show-status"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>created at:</strong></td>
                            <td id="show-created-at"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <br>
    <!-- Basic table -->
    <section id="basic-datatable">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic table" id="admins">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>type</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>


        {{-- delete comfirm --}}
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete?
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user-id" id="admin-id" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="close">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="delete-btn">delete</button>
                    </div>
                </div>
            </div>
        </div>

         {{-- restore comfirm --}}
         <div class="modal fade" id="restore-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     Are you sure you want to restore ?
                 </div>
                 <div class="modal-footer">
                     <input type="hidden" name="user-id" id="user-id" value="">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal"
                         id="close">Close</button>
                     <button type="button" class="btn btn-primary" data-dismiss="modal"
                         id="restore-btn">restore</button>
                 </div>
             </div>
         </div>
     </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    </section>
    <!--/ Basic table -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}

    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>


@endsection
@section('page-script')
    {{-- Page js files --}}

    <script src="{{ asset('js/scripts/tables/table-datatables-admins.js') }}"></script>

@endsection
