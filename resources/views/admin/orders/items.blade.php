@extends('layouts.contentLayoutMaster')

@section('title', 'Order items')

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
                <form class="form" method="post" action="{{ ROUTE('roles.store') }}"
                    style="    width: 100%;

    padding: 3rem 2rem; border-radius: 10px;">
                    @csrf

                    <div id="account-details-modern" class="content" role="tabpanel"
                        aria-labelledby="account-details-modern-trigger" style="margin-left: 0 !important;">
                        <div class="content-header">
                            <h5 class="mb-0">admin Details</h5>
                            <small class="text-muted">Enter Your admin Info.</small>
                        </div>
                        <br>
                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="user_name">name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                    </div>
                    @foreach ($data as $item)
                    @if(count($item))
                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-title text-uppercase">{{$item->first()->category}}</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @foreach ($item as $key=>$permission)
                                    <div class="mb-1 col-4">
                                        <label for="name" class="form-check-label mx-auto">{{$permission->name}}
                                        </label>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="{{$permission->id}}" id="name">
                                    </div>
                                    @if(($key+1) % 4 == 0)
                                         </div><div class="row">
                                    @endif
                                @endforeach
                            </div>

                            {{-- <div class="d-flex justify-content-end">
                                    <div class="d-flex align-items-baseline">
                                        <button type="submit" class="btn btn-primary text-uppercase waves-effect waves-float waves-light">
                                            Save
                                        </button>
                                    </div>
                                </div> --}}
                        </div>
                    </div>
                    @endif
                    @endforeach

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
