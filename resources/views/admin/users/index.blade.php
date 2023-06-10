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
        #users_wrapper {
            margin: 10px;
        }

        .feather {
            height: 30px;
            width: 30px;
            font-size: large;
            margin-right: 2em;

        }

        /* a:hover{
                cursor:pointer ;
            } */
    </style>
    {{-- <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" media="all" /> --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-10">
        </div>
        <div class="col-2">
            @can('create user')
                <a class="btn btn-primary" href="{{ route('users.create') }}">
                    Add new record
                </a>
            @endcan
            <!-- Modal -->
            <div class="modal fade" id="create-modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="" id="form">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id=""
                                        placeholder="Enter email">
                                    <span class="text-danger" id="addnameError"></span>


                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="enter Email"
                                        style='text-align: left'>
                                    <span class="text-danger" id="addemailError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" name="password" class="form-control" id="pass"
                                        placeholder="enter Password">
                                    <span class="text-danger" id="addpasswordError"></span>
                                </div>


                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                id="close-modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submit">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.alerts.success')
    @include('includes.alerts.errors')
    <div class="alert alert-success col-5 text-center py-1 mx-auto" id="success-msg" style="display: none"></div>
    <div class="alert alert-danger col-5 text-center py-1 mx-auto" id="error_msg" style="display: none"></div>

    <!-- edit-Modal -->
    <div class="modal fade" id="user-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <input type="text" name="user_name" class="form-control" id="name"
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
                        <div class="form-group">
                            <label for="email">Address</label>
                            <input type="email" name="address" class="form-control" id="address"
                                placeholder="enter address" style="text-align: left">
                            <span class="text-danger" id="editaddressError"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select class="form-control w-100 @error('gender') is-invalid @enderror" name="gender">
                                <!-- <option label=" "></option> -->
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id='close-btn'>Close</button>
                    <button type="button" class="btn btn-primary" id="sub-edit">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- show-Modal -->
    <div class="modal fade" id="user-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">show user</h5>
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
                            <td><strong>adress:</strong></td>
                            <td id="show-address"></td>
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
                    <table class="datatables-basic table" id="users">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>User Name</th>
                                <th width="1%">Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th width="25%">Action</th>
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
                        <input type="hidden" name="user-id" id="user-id" value="">
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

        {{-- block comfirm --}}
        <div class="modal fade" id="block-modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><span class='block_user'></span> user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to <span class="block_user"></span>?
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user-id" id="item-id" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="close">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="block-btn"><span
                                class="block_user"></span></button>
                    </div>
                </div>
            </div>
        </div>


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

    <script></script>
    <script src="{{ asset('js/scripts/tables/table-datatables-users.js') }}"></script>

@endsection
