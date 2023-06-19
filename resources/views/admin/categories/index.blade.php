@extends('layouts.contentLayoutMaster')

@section('title', 'categories')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <style>#categories_wrapper {margin: 10px;}</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-10">
        </div>
        <div class="col-2">
            @can('create category')
            <a class="btn btn-primary" href="{{ route('category.create') }}">
                Add new record
            </a>
            @endcan

        </div>
    </div>
    @include('includes.alerts.success')
    @include('includes.alerts.errors')
    <div class="alert alert-success col-5 text-center py-1 mx-auto" id="success-msg" style="display: none"></div>
    <div class="alert alert-danger col-5 text-center py-1 mx-auto" id="error_msg" style="display: none"></div>

    <!-- edit-Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">edit category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form-edit">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name_en" class="form-control" id="name"
                                placeholder="Enter Name">
                            <span class="text-danger" id="editnameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <input type="text" name="description_en" class="form-control" id="description"
                                 style="text-align: left">
                            <span class="text-danger" id="editdescriptionError"></span>
                        </div>
                        <div class="form-group">
                            <label for="">image</label>
                            <input type="file" name="image" class="form-control"
                            <span class="text-danger" id="editimageError"></span>
                            <br>
                            <img id="image" width="200px" style="margin: auto; border: 1rem ; display: block">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id='close'>Close</button>
                    <button type="button" class="btn btn-primary" id="sub-edit">Save changes</button>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">show category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <table class="table-responsive ">
                        <tr height="50px">
                            <td><strong>Name: </strong></td>
                            <td id="show-name"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>Description:</strong></td>
                            <td id="show-description"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>status: </strong></td>
                            <td id="show-status"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>created at:</strong></td>
                            <td id="show-created-at"></td>
                        </tr>
                        <tr height="50px">
                            <td><strong>image: </strong></td>
                            <img id="show-image" width="100px"></img>
                        </tr>
                    </table> --}}


                    <h5>Name</h5>
                    <p id="show-name"></p>
                    <hr>
                    <h5>Description</h5>
                    <p id="show-description"></p>
                    <hr>
                    <h5>Status</h5>
                    <p id="show-status"></p>
                    <hr>
                    <h5>Created at</h5>
                    <p id="show-created-at"></p>
                    <hr>
                    <h5>image</h5>
                    <img id="show-image" width="200px" style="margin: auto; border: 1rem ; display: block"></p>


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
                    <table class="datatables-basic table" id="categories">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>image</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>


        {{-- change status comfirm --}}
        @include('includes.Modal.change-status')


        {{-- delete comfirm --}}
        @include('includes.Modal.delete')
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

    <script src="{{ asset('js/scripts/tables/table-datatables-categories.js') }}"></script>

@endsection
