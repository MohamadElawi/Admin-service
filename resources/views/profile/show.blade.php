@extends('layouts.contentLayoutMaster')

@section('title', 'Profile')



@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Profile Information</h4>
            @include('profile.alert')
        </div>

        <div class="card-body">
            <form action="{{ route('profile.edit') }}" method="POST">
                @csrf

                <p class="card-text text-muted">
                    Update your account's profile information and email address.
                </p>

                <div class="alert alert-success" role="alert" style="display: none;">
                    <div class="alert-body">
                        Saved.
                    </div>
                </div>

                <div class="mb-1">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}"
                        id="name" placeholder="Enter Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-1">
                    <label for="email">email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}"
                       style="text-align: left" id="email" placeholder="Enter email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div></div>
                </div>

                <div class="d-flex justify-content-end">
                    <div class="d-flex align-items-baseline">
                        <button type="submit" class="btn btn-primary text-uppercase waves-effect waves-float waves-light">
                            Save
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    {{-- update password --}}

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Password</h4>
            @include('profile.alert-pass')
        </div>
        <div class="card-body">
            <form action="{{ route('profile.edit.pass') }}" method="POST">
                @csrf
                <p class="card-text text-muted">
                    Ensure your account is using a long, random password to stay secure.
                </p>

                <div class="mb-1">
                    <label for="password">password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="mb-1">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password"
                        class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="">
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="mb-1">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password"
                        placeholder="">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary text-uppercase waves-effect waves-float waves-light">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- <script>
        function() {
            alert('dsa')
        }
    </script> --}}

@endsection

@section('page-script')
 <script>
       $(document).ready(function(){
            setTimeout(() => {
                $(".alert").hide();
            }, 3000);
       })
    </script>
@endsection

