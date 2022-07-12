@extends('layouts.master')

@section('title')
    @lang('Edit Employee')
@endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/css/cutom.css') }}" id="custom-style" rel="stylesheet" type="text/css" />
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Employee
        @endslot
        @slot('title')
            Edit Employee
        @endslot
    @endcomponent
    @if (Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::get('fail'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('fail') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Employee Details</h4>
                    <p class="card-title-desc">Edit Employee Details</p>
                    <form action="{{ route('employee.update', ['id' => $employee->id]) }}" method="post"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Employee ID</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="employeeId"
                                        placeholder="employee id" value="{{ $employee->employeeId }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">@error('employeeId')
                                        {{ $message }} @enderror</span>
                                    <div class="invalid-feedback">
                                        Please enter the valid Employee id.
                                    </div>
                                </div>
                            </div>
                                    <span for="validationCustom01" class="form-label">User Name<span
                                            style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="validationCustom01" name="username"
                                            value="{{ $employee->username }}" required>
                                        <div class="valid-feedback">
                                            Looks good!
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
                                        placeholder="First name" value="{{ $employee->first_name }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Last name<span
                                            style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom02" name="lastName"
                                        value="{{ $employee->last_name }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-4">
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
                            </div> --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Email Id<span
                                            style="color:red">*</span></label>
                                    <input type="email" class="form-control" id="validationCustom01" name="email"
                                        placeholder="Email" 
                                        value="{{ $employee->email }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        Please enter the valid email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Designation</label>
                                     {{-- <input type="text" class="form-control" id="validationCustom02" name="designation" placeholder="Designation" value="{{ old('designation') }}"> --}}
                                    <select class="form-select" name="designation" id="designation">
                                    <option value="0">Select designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$employee->designation }}">
                                            {{ $designation }}
                                        </option>
                                    @endforeach
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
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="validationCustom04" class="form-label">Department</label>
                                <!-- <input type="text" class="form-control" id="validationCustom04" name="department" placeholder="CSE"> -->
                                <select class="form-select" name="department" id="department">
                                    <option value="0">Select department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $employee->department }})">
                                            {{ $department }}
                                        </option>
                                    @endforeach
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
                        
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Submit</button>
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
