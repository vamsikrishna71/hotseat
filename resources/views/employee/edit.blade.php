@extends('layouts.master')

@section('title') @lang('Add Employee') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Users @endslot
        @slot('title') Edit Users @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Employee Details</h4>
                    <p class="card-title-desc">Edit Employee Details</p>
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Employee ID</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="First name" value="Mark" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="First name" value="Mark" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="validationCustom02"
                                        placeholder="Last name" value="Otto" required>
                                    <div class="valid-feedback">
                                        Looks good!
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
                                    <label for="validationCustom02" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="validationCustom02"
                                        placeholder="Last name" value="Developer" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="CSE"
                                        required>
                                    <div class="invalid-feedback">
                                        Please provide a valid Department.
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
                            <button class="btn btn-primary" type="submit">Submit form</button>
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
