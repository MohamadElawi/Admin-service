@extends('layouts.contentLayoutMaster')

@section('title', 'maintenances order')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <style>
        #maintenances_wrapper {
            margin: 10px;
        }
    </style>


@endsection

@section('content')
    <div class="row">
        <div class="col-10">
        </div>
        <div class="col-2">

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
                    <h5 class="modal-title" id="exampleModalLongTitle">Maintenanace Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form-edit">
                        @method('put')
                        <input type="hidden" name="id" id="id">

                        <div class="mb-3">
                            <label for="datetime1" class="form-label">First Date:</label>
                            <input type="text" class="form-control datetimepicker" id="datetime1" name="datetime1">
                        </div>
                        <div class="mb-3">
                            <label for="datetime2" class="form-label">Secound Date:</label>
                            <input type="text" class="form-control datetimepicker" id="datetime2" name="datetime2">
                        </div>
                        <div class="mb-3">
                            <label for="datetime3" class="form-label">Third Date:</label>
                            <input type="text" class="form-control datetimepicker" id="datetime3" name="datetime3">
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
                    <h5>Service Name</h5>
                    <p id="show-service-name"></p>
                    <hr>
                    <h5>User name</h5>
                    <p id="show-user-name"></p>
                    <hr>
                    <h5>User phone</h5>
                    <p id="show-user-phone"></p>
                    <hr>
                    <h5>location</h5>
                    <p id="show-location"></p>
                    <hr>
                    <h5>street</h5>
                    <p id="show-street"></p>
                    <hr>
                    <h5>area</h5>
                    <p id="show-area"></p>
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
                    <h5>Appointment at</h5>
                    <p id="show-appointment-at"></p>
                    <hr>

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
                    <table class="datatables-basic table" id="maintenances">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>service Name</th>
                                <th>User Name</th>
                                <th>User phone</th>
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

        <!-- add-price-Modal -->
        <div class="modal fade" id="add-price-modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Maintenanace Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="form-add-price">
                            <input type="hidden" name="id" id="main-id">
                            @csrf
                            <h4 class="">Add Price</h4>
                            <div class="mb-3">
                                <label for="price" class="form-label"></label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id='close'>Close</button>
                        <button type="button" class="btn btn-primary" id="sub-add-price">Save changes</button>
                    </div>
                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('js/scripts/tables/table-datatables-maintenances.js') }}"></script>

@endsection
