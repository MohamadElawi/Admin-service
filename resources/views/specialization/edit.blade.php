@extends('layouts/contentLayoutMaster')

@section('title', 'Form Layouts')

@section('content')
<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
  <div class="row">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Specialization Form</h4>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ROUTE('specializations.update',$specialization->id)}}" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="first-name">Name</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" name="name" value="{{ $specialization->name }}" id="first-name" required class="form-control" placeholder="First Name" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="contact-info">Slug</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" name="slug" id="contact-info" value="{{ $specialization->slug }}" required class="form-control" placeholder="slug/" />
                  </div>
                </div>
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
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- Basic Horizontal form layout section end -->
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-tooltip-valid.js'))}}"></script>
@endsection
