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
                <form class="form" method="post" action=""
                    style="    width: 100%;

    padding: 3rem 2rem; border-radius: 10px;">
                    @csrf

                    <div id="account-details-modern" class="content" role="tabpanel"
                        aria-labelledby="account-details-modern-trigger" style="margin-left: 0 !important;">
                        <div class="content-header">
                            <h5 class="mb-0">Order Details</h5>
                        </div>
                        <br>

                    </div>
                    @foreach ($data as $item)

                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-title text-uppercase">{{$item['product_name']}}</h4>
                        </div>
{{--
                        <div class="card-body">
                            <div class="row">
                                    <div class="mb-1 col-4">
                                        <label for="name" class="form-check-label mx-auto">{{$item['product_name']}}
                                        </label>
                                        <label for="name" class="form-check-label mx-auto">{{$item['price']}}</label>
                                            <label for="name" class="form-check-label mx-auto">{{$item['quantity']}}</label>
                                                <label for="name" class="form-check-label mx-auto">{{$item['price'] * $item['quantity']}}</label>
                                        <img src="{{$item['product_image']}}" width="40px" height="40px">
                                    </div>

                            </div>

                        </div>
                    </div> --}}

                    <div class="card-body">
                        <div class="row">
                          <div class="col-8">
                            <p class="key-value">
                              <span class="key">Price:</span> {{$item['price']}}
                            </p>
                            <p class="key-value">
                              <span class="key">Quantity:</span> {{(int)$item['quantity']}}
                            </p>
                            <p class="key-value">
                              <span class="key">Total Price:</span> {{$item['price'] * $item['quantity']}}
                            </p>
                          </div>
                          <div class="col-4 d-flex align-items-center justify-content-end">
                            <img src="{{$item['product_image']}}" class="product-image" width="200px" height="140px">
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach

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
