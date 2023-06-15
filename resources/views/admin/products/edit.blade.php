@extends('layouts.contentLayoutMaster')

@section('title', 'update Product')

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

                <form class="form" method="post" action="{{ route('product.update', $product['id']) }}"
                    enctype="multipart/form-data" style=" width: 100%;padding: 3rem 2rem; border-radius: 10px;">
                    @csrf
                    @method('put')
                    <div id="account-details-modern" class="content" role="tabpanel"
                        aria-labelledby="account-details-modern-trigger" style="margin-left: 0 !important;">
                        <div class="content-header">
                            <h5 class="mb-0">Product Details</h5>
                            <small class="text-muted">Enter Your product Info.</small>
                        </div>
                        <br>
                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="name">name</label>
                                <input type="text" name="name_en" id="name_en"
                                    class="form-control @error('name_en') is-invalid @enderror"
                                    value="{{ $product['name'] }}" required />
                                @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="category">Category</label>
                                <select class="form-control w-100 @error('category_id') is-invalid @enderror"
                                    name="category_id">
                                    @if (isset($categories))
                                        @foreach ($categories as $category)
                                            <option value={{ $category['id'] }}
                                                @if ($category['id'] == $product['category_id']) selected @endif>{{ $category['name'] }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>

                        </div>
                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="description_en">Description</label>

                                <input type='text' class="form-control @error('description_en') is-invalid @enderror"
                                    name="description_en" id="description_en" value="{{ $product['description'] }}"
                                    required>
                                @error('description_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="name">Price</label>
                                <input type="text" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ $product['price'] }}" required />
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="details">Details</label>

                                <input type='text' class="form-control @error('details_en') is-invalid @enderror"
                                    name="details_en" id="description_en" value="{{ $product['details'] }}" required>
                                @error('details_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="details">quantity</label>

                                <input type='text' class="form-control @error('quantity') is-invalid @enderror"
                                    name="quantity" id="quantity" value="{{ $product['quantity'] }}" required>
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        {{--
                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="image">Image</label>
                                <input type="file" name="main_image" class="form-control" value="{{ old('main_image') }}"/>
                                @error('main_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}


                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="image">Image</label>
                                @if (!empty(old('main_image')))
                                    <input type="file" name="main_image" class="form-control"
                                        value="{{ old('main_image') }}" />
                                @else
                                    <input type="file" name="main_image" class="form-control" />
                                @endif
                                @error('main_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="mb-1 col-md-6" id="productSpecialQuantity" style="display: {{ $product['is_special'] ? 'block' : 'none'}}">
                                <label class="form-label" for="quantity_special_product">Product Special Quantity</label>

                                <input type='number' class="form-control @error('quantity_special_product') is-invalid @enderror"
                                    name="quantity_special_product"  value="{{ old('quantity_special_product') }}" required>
                                @error('quantity_special_product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-1 col-md-6" style="display: flex;  align-items: center">
                                <input style="width: 24px;height: 24px" type="checkbox"
                                    @if ($product['is_special'] == 1) checked @endif name="is_special"
                                    class="form-check-input" value="1" id="special" />
                                <label style="padding:2px ;" class="form-check-label" for="flexCheckDefault">
                                    Is Special
                                </label>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success"
                                style="margin-inline-start: auto;">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /Modern Horizontal Wizard -->

@endsection

@section('vendor-script')
    <!-- vendor files -->


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var specialCheckbox = document.getElementById("special");
            var productSpecialQuantityDiv = document.getElementById("productSpecialQuantity");

            specialCheckbox.addEventListener("change", function() {
                if (this.checked) {
                    productSpecialQuantityDiv.style.display = "block";
                } else {
                    productSpecialQuantityDiv.style.display = "none";
                }
            });
        });
    </script>

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
