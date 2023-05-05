@extends('layouts.contentLayoutMaster')


@section('title','create category')

@section('page-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" media="all" />
@endsection

@section('content')

<div class="row">
  <div class="col-10">
  </div>
  <div class="col-2">

    <a href="{{route('page.create')}}" class="btn btn-danger">Add new record</a>

  </div>
  <div class="">
    <form action="{{route('page.store')}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Enter email">
        @error('name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror


      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">price</label>
        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="exampleInputPassword1" placeholder="enter price">
        @error('price')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="">description</label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder=" description">
        @error('description')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

        <div class="form-group">
                          <label class="mr-sm-2" for="select">Preference</label>
                          <select class="custom-select mr-sm-2" id="select">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>

            <div class="form-group">
                          <label for="image"> image</label>
                          <input type="file" name="image" class="form-control-file" id="image">
                        </div>

      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>

      </div>

      <div class="modal-footer mx-auto">
        <button onclick="history.back()" class="btn btn-warning">back</button>
        <button type="submit" class="btn btn-success "  id="submit">Save changes</button>

    </form>
  </div>
</div>
</div>

</div>

</div>
</div>





@endsection


@section('page-script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
