@extends('layouts.contentLayoutMaster')

@section('title', 'Create New User')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection

@section('content')
    <!-- Modern Horizontal Wizard -->
    <section class="modern-horizontal-wizard">
        <div class=" wizard-modern modern-wizard-example">
            <div class="bs-stepper-header">
                <form class="form" method="post" action="{{ ROUTE('users.store') }}" enctype="multipart/form-data"
                    style="    width: 100%;

    padding: 3rem 2rem; border-radius: 10px;">
                    @csrf
                    
                        <div id="account-details-modern" class="content" role="tabpanel"
                            aria-labelledby="account-details-modern-trigger" style="margin-left: 0 !important;">
                            <div class="content-header">
                                <h5 class="mb-0">User Details</h5>
                                <small class="text-muted">Enter Your User Info.</small>
                            </div>
                            <br>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="user_name">User name</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control @error('user_name') is-invalid @enderror"
                                     value="{{old('user_name')}}" required />
                                    @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                        {{-- <select class="select2 w-100" name="paid" id="paid" form="categoryForm"> --}}
                                    <input type='text' class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    value="{{old('email')}}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    value="{{old('password')}}"  required />
                                         @error('password')
                                         <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                         </span>
                                       @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                    value="{{old('phone')}}"  required />
                                         @error('phone')
                                         <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                         </span>
                                       @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror "
                                    value="{{old('address')}}"   required />
                                         @error('address')
                                         <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                         </span>
                                       @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="gender">Gender</label>
                                    <select class="form-control w-100 @error('gender') is-invalid @enderror" name="gender" >
                                        <!-- <option label=" "></option> -->
                                        <option value='male'>Male</option>
                                        <option value='female'>Female</option>
                                    </select>

                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-1">
                                            <label class="col-form-label" for="icon">Icon</label>
                                        </div>
                                        <div class="col-sm-11">
                                            <input class="form-control" name="icon" type="file" required
                                                id="formFile" />
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success" style="margin-inline-start: auto;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /Modern Horizontal Wizard -->

@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>

@endsection

