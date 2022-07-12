@extends('layouts.master')

@section('title')
    @lang('Add Employee')
@endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@section('content')
    <div class="row profile_edit">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Profile</h4>
                    <form action="{{ route('user.update', ['id' => Auth::user()->id]) }}" class="needs-validation"
                        method="post" enctype="multipart/form-data">
                        @csrf

                        @if (Session::get('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ Session::get('success') }}<button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (Session::get('fail'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ Session::get('fail') }}<button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">User ID<span
                                            style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom01" name="username"
                                        placeholder="User ID" value="{{ Auth::user()->username }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">
                                        @error('username')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        Please enter the valid User ID.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">First name<span
                                            style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom01" name="firstName"
                                        placeholder="First name" value="{{ Auth::user()->first_name }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">
                                        @error('firstName')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        Please enter the valid Firstname.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Last name<span
                                            style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom02" name="lastName"
                                        placeholder="Last name" value="{{ Auth::user()->last_name }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">
                                        @error('lastName')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        Please enter the valid Last name.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Email Id<span
                                            style="color:red">*</span></label>
                                    <input type="email" class="form-control" id="validationCustom01" name="email"
                                        placeholder="Email Id" value="{{ Auth::user()->email }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        Please enter the valid password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Designation</label>
                                    <select class="form-select" name="designation" id="designation">
                                        <option>Developer</option>
                                        <option>Developer</option>
                                        <option>Developer</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">
                                        @error('designation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        Please enter the valid designation.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Department</label>
                                    <select class="form-select" name="department">
                                        <option>UI</option>
                                        <option>UI</option>
                                        <option>UI</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">
                                        @error('department')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        Please enter the valid department.
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Password<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="validationCustom01" name="password" placeholder="Password" value="********" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <span class="text-danger">@error('password')
                                    {{ $message }} @enderror</span>
                                <div class="invalid-feedback">
                                    Please enter the valid password.
                                </div>
                            </div>
                        </div> --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01"
                                        class="form-label @error('logo') is-invalid @enderror">Upload Profile Photo<span
                                            style="color:red">*</span></label>
                                    <input class="form-control" type="file" id="formFile" name="logo" accept="image/*">
                                </div>
                                 <span class="text-danger">
                                        @error('logo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        Please upload under 125Kb.
                                    </div>
                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-3 align-self-end">
                                    <img src="{{ isset(Auth::user()->logo) ? asset(Auth::user()->logo) : asset('/assets/images/users/avatar-1.jpg') }}"
                                        alt="" class="img-thumbnail rounded-circle">
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('root') }}" class="btn btn-danger w-md">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-success w-md">
                                Done
                            </button>

                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
    <style>
        /* form.needs-validation input {
                    pointer-events: none;
                    background-color: #eff2f7;
                    opacity: 1;
                } */

    </style>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}">
    </script>
@endsection
