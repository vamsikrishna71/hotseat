@extends('layouts.master')

@section('title') @lang('Add Employee') @endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Employee @endslot
        @slot('title') Add Employee @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Add Employee Details</h4>
                    <form action="{{ route('addEmployee')  }}" class="needs-validation" novalidate method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Employee ID<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom01" name="username"
                                        placeholder="Employee ID" value="{{ old('username') }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">@error('username')
                                        {{ $message }} @enderror</span>
                                    <div class="invalid-feedback">
                                        Please enter the valid Employee ID.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">First name<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom01" name="firstName"
                                        placeholder="First name" value="{{ old('firstName') }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">@error('firstName')
                                        {{ $message }} @enderror</span>
                                    <div class="invalid-feedback">
                                        Please enter the valid Firstname.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Last name<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom02" name="lastName"
                                        placeholder="Last name" value="{{ old('lastname') }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">@error('lastName')
                                        {{ $message }} @enderror</span>
                                    <div class="invalid-feedback">
                                        Please enter the valid Last name.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{--  <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">State</label>
                                    <select class="form-select" id="validationCustom03" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option>-</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>
                            </div>  --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Password<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom01" name="password"
                                        placeholder="Password" value="{{ old('password') }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">@error('password')
                                        {{ $message }} @enderror</span>
                                    <div class="invalid-feedback">
                                        Please enter the valid password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Designation<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom02" name="designation"
                                        placeholder="Designation" value="{{ old('designation') }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">@error('designation')
                                        {{ $message }} @enderror</span>
                                    <div class="invalid-feedback">
                                        Please enter the valid designation.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Department<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom04" name="department" placeholder="CSE"
                                        required>
                                       <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">@error('department')
                                        {{ $message }} @enderror</span>
                                    <div class="invalid-feedback">
                                        Please enter the valid department.
                                    </div>
                                </div>
                            </div>
                            {{--  <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom05" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="validationCustom05" placeholder="Zip"
                                        required>
                                    <div class="invalid-feedback">
                                        Please provide a valid zipcode.
                                    </div>
                                </div>
                            </div>  --}}
                        </div>
                        {{--  <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>  --}}
                        <div>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}">
    </script>
@endsection
