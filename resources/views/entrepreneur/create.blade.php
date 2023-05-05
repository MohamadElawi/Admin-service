
@extends('layouts/contentLayoutMaster')

@section('title', 'Form Wizard')

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
  <div class="bs-stepper wizard-modern modern-wizard-example">
    <div class="bs-stepper-header">
        <form class="form" method="post" action="{{ROUTE('entrepreneur.store')}}" enctype="multipart/form-data" id="entrepreneurForm">
    @csrf
      <div class="step" data-target="#account-details-modern" role="tab" id="account-details-modern-trigger">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">
            <i data-feather="file-text" class="font-medium-3"></i>
          </span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Account Details</span>
            <span class="bs-stepper-subtitle">Setup Account Details</span>
          </span>
        </button>
      </div>
      <div class="line">
        <i data-feather="chevron-right" class="font-medium-2"></i>
      </div>
      <div class="step" data-target="#personal-info-modern" role="tab" id="personal-info-modern-trigger">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">
            <i data-feather="user" class="font-medium-3"></i>
          </span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Personal Info</span>
            <span class="bs-stepper-subtitle">Add Personal Info</span>
          </span>
        </button>
      </div>
      <div class="line">
        <i data-feather="chevron-right" class="font-medium-2"></i>
      </div>
      <div class="step" data-target="#address-step-modern" role="tab" id="address-step-modern-trigger">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">
            <i data-feather="map-pin" class="font-medium-3"></i>
          </span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Address</span>
            <span class="bs-stepper-subtitle">Add Address</span>
          </span>
        </button>
      </div> 
       <div class="line">
        <i data-feather="chevron-right" class="font-medium-2"></i>
      </div> 
       <div class="step" data-target="#social-links-modern" role="tab" id="social-links-modern-trigger">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">
            <i data-feather="link" class="font-medium-3"></i>
          </span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Social Links</span>
            <span class="bs-stepper-subtitle">Add Social Links</span>
          </span>
        </button>
      </div>
    </div>
    <div class="bs-stepper-content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <div id="account-details-modern" class="content" role="tabpanel" aria-labelledby="account-details-modern-trigger">
        <div class="content-header">
          <h5 class="mb-0">Account Details</h5>
          <small class="text-muted">Enter Your Account Details.</small>
        </div>
        <div class="row">
          <div class="mb-1 col-md-6">
            <label class="form-label" for="modern-username">Username</label>
            <input type="text" name="user_name" id="modern-username" class="form-control" placeholder="johndoe" required />
          </div>
          <div class="mb-1 col-md-6">
            <label class="form-label" for="modern-email">Email</label>
            <input
              type="email"
              name="email"
              id="modern-email"
              class="form-control"
              placeholder="john.doe@email.com"
              aria-label="john.doe"
              required
            />
          </div>
        </div>
        <div class="row">
          <div class="mb-1 form-password-toggle col-md-6">
            <label class="form-label" for="modern-password">Password</label>
            <input
              type="password"
              name="password"
              id="modern-password"
              class="form-control"
              required
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            />
          </div>
          <div class="mb-1 form-password-toggle col-md-6">
            <label class="form-label" for="modern-confirm-password">Confirm Password</label>
            <input
              type="password"
              name="repassword"
              id="modern-confirm-password"
              class="form-control"
              required
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            />
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <button class="btn btn-outline-secondary btn-prev" disabled>
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-primary btn-next">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
          </button>
        </div>
      </div>
      <div id="personal-info-modern" class="content" role="tabpanel" aria-labelledby="personal-info-modern-trigger">
        <div class="content-header">
          <h5 class="mb-0">Personal Info</h5>
          <small>Enter Your Personal Info.</small>
        </div>
        <div class="row">
          <div class="mb-1 col-md-6">
            <label class="form-label" for="modern-first-name">First Name</label>
            <input type="text" name="first_name" id="modern-first-name" class="form-control" placeholder="John" />
          </div>
          <div class="mb-1 col-md-6">
            <label class="form-label" for="modern-last-name">Last Name</label>
            <input type="text" name="last_name" id="modern-last-name" class="form-control" placeholder="Doe" />
          </div>
        </div>
        <div class="row">
          <div class="mb-1 col-md-6">
            <label class="form-label" for="modern-country">Country</label>
            <select class="select2 w-100" name="country" id="modern-country" form="entrepreneurForm">
              <option label=" "></option>
              <option value="UK">UK</option>
              <option value="USA">USA</option>
              <option value="Spain">Spain</option>
              <option value="France">France</option>
              <option value="Italy">Italy</option>
              <option value="Australia">Australia</option>
            </select>
          </div>
          <div class="mb-1 col-md-6">
            <label class="form-label" for="city">City</label>
            <select class="select2 w-100" name="city" id="city" form="entrepreneurForm">
              <option label=" "></option>
              <option value="damas">damas</option>
              <option value="etc">etc</option>
            </select>
          </div>
        </div>
        <div class="row">
            <div class="mb-1 col-md-6">
                <label class="form-label" for="Gender">Gender</label>
                <select class="select2 w-100" name="gender" id="gender" form="entrepreneurForm">
                    <option label="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
            </div>
            <div class="col-md-6 mb-1">
                <label class="form-label" for="fp-human-friendly">Human Friendly</label>
                <input
                  type="text"
                  name="birthdate"
                  id="fp-human-friendly"
                  class="form-control flatpickr-human-friendly"
                  placeholder="October 14, 2020"
                />
            </div>
        </div>
          <label class="form-label" for="modern-last-name">Phone</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
                <select class="select2 w-100" name="country_code" id="modern-country-code" form="entrepreneurForm">
                    <option label=" "></option>
                    <option value="+1">+1</option>
                    <option value="+2">+2</option>
                    <option value="+963">+963</option>
                    <option value="+966">+966</option>
                </select>
                {{-- <span class="input-group-text" id="basic-addon3">+966</span> --}}
            </div>
            <input type="text" name="phone" id="modern-last-name" class="form-control" placeholder="Doe" />
          </div>
          <div class="col-12">
            <div class="mb-1 row">
              <div class="col-sm-3">
                <label class="col-form-label" for="contact-info">Photo</label>
              </div>
              <div class="col-sm-9">
                <input class="form-control" name="image" type="file" required id="formFile" />
              </div>
            </div>
          </div>
        <div class="d-flex justify-content-between">
          <button class="btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
      <div id="address-step-modern" class="content" role="tabpanel" aria-labelledby="address-step-modern-trigger">
        <div class="content-header">
          <h5 class="mb-0">Address</h5>
          <small>Enter Your Address.</small>
        </div>
        <div class="row">
          <div class="mb-1 col-md-6">
            <label class="form-label" for="modern-address">Address</label>
            <input
              type="text"
              id="modern-address"
              class="form-control"
              placeholder="98  Borough bridge Road, Birmingham"
            />
          </div>
          <div class="mb-1 col-md-6">
            <label class="form-label" for="modern-landmark">Landmark</label>
            <input type="text" id="modern-landmark" class="form-control" placeholder="Borough bridge" />
          </div>
        </div>
        <div class="row">
          <div class="mb-1 col-md-6">
            <label class="form-label" for="pincode3">Pincode</label>
            <input type="text" id="pincode3" class="form-control" placeholder="658921" />
          </div>
          <div class="mb-1 col-md-6">
            <label class="form-label" for="city3">City</label>
            <input type="text" id="city3" class="form-control" placeholder="Birmingham" />
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <button class="btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-success btn-submit">Submit</button>

        </div>
      </div> 
       <div id="social-links-modern" class="content" role="tabpanel" aria-labelledby="social-links-modern-trigger">
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Studeis</h4>
                  </div>
                  <div class="card-body">
                    <form action="#" class="invoice-repeater">
                      <div data-repeater-list="invoice">
                        <div data-repeater-item>
                          <div class="row d-flex align-items-end">
                            <div class="col-md-4 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="itemname">Univesity</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="itemname"
                                  aria-describedby="itemname"
                                  placeholder="Univesity"
                                />
                              </div>
                            </div>

                            <div class="col-md-3 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="itemcost">Lisense</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="itemcost"
                                  aria-describedby="itemcost"
                                  placeholder="Lisense"
                                />
                              </div>
                            </div>

                            <div class="col-md-3 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="itemquantity">Country</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="itemquantity"
                                  aria-describedby="itemquantity"
                                  placeholder="Country"
                                />
                              </div>
                            </div>

                            <div class="col-md-2 col-12 mb-50">
                              <div class="mb-1">
                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                  <i data-feather="x" class="me-25"></i>
                                  <span>Delete</span>
                                </button>
                              </div>
                            </div>
                          </div>
                          <hr />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                            <i data-feather="plus" class="me-25"></i>
                            <span>Add New</span>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        <div class="d-flex justify-content-between">
          <button class="btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-success btn-submit">Submit</button>
        </div>
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
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-repeater.js')) }}"></script>


@endsection
