@extends('layouts.contentLayoutMaster')

@section('title', 'category')

@section('vendor-style')
{{-- vendor css files --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" media="all" />
@endsection

@section('content')
<div class="row">
    <div class="col-10">
    </div>
    <div class="col-2">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-category">
            Add new record
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modal-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="" id="form">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Enter email">
                                <span class="text-danger" id="addnameError"></span>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">price</label>
                                <input type="text" name="price" class="form-control" id="exampleInputPassword1" placeholder="enter price">
                                <span class="text-danger" id="addpriceError"></span>
                            </div>

                            <div class="form-group">
                                <label for="">description</label>
                                <input type="text" name="description" class="form-control" placeholder=" description">
                                <span class="text-danger" id="adddescriptionError"></span>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="alert alert-success col-5 text-center py-1 mx-auto" id="create-msg" style="display: none">
        created successfully
    </div>
    <div class="alert alert-success col-5 text-center py-1 mx-auto" id="update-msg" style="display: none">
        updated successfully
    </div>
</div>
<div class="alert alert-success col-5 text-center py-1 mx-auto" id="delete-msg" style="display: none">
    deleted successfully
</div>
<div class="alert alert-danger col-5 text-center py-1 mx-auto" id="error-msg" style="display: none">
    some things went wrongs
</div>
<br>

<!-- edit-Modal -->
<div class="modal fade" id="category-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">edit category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="" id="form-edit">
                    {{-- @csrf --}}
                    {{-- <input type="hidden" name="id" id="id"> --}}

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter email">
                        <span class="text-danger" id="editnameError"></span>
                    </div>
                    <div class="form-group">
                        <label for="price">price</label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="enter price">
                        <span class="text-danger" id="editpriceError"></span>
                    </div>

                    <div class="form-group">
                        <label for="">description</label>
                        <input type="text" name="description" class="form-control" id="description" placeholder=" description">
                        <span class="text-danger" id="editdescriptionError"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal-edit">Close</button>
                <button type="button" class="btn btn-primary" id="sub-edit">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- show-Modal -->
<div class="modal fade" id="category-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">edit category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-responsive ">
                    <tr height="50px">
                        <td><strong>Name:  </strong></td>
                        <td id="show-name"></td>
                    </tr>
                    <tr height="50px">
                        <td><strong>price:</strong></td>
                        <td id="show-price"></td>
                    </tr>
                    <tr height="50px">
                        <td><strong >description:</strong></td>
                        <td id="show-description" ></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


</div>
</div>

<!-- Basic table -->
<section id="basic-datatable">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="datatables-basic table" id="specializations">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- delete comfirm --}}
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                <button type="button" class="btn btn-danger" id="delete-btn">delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>


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
