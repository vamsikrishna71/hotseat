@extends('layouts.master')

@section('title') Add Location @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Location @endslot
        @slot('title') Add Location @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Address Details</h4>

                    <form action="{{ route('addlocation') }}" class="needs-validation" novalidate method="post">
                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif

                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Address<span style="color:red">*</span></label>
                                    <input type="text" name="address" class="form-control"
                                        id="validationCustom01"  placeholder="Address">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <span class="text-danger">@error('address')
                                        {{ $message }} @enderror</span>
                                    <div class="invalid-feedback">
                                        Please enter the address.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Country<span style="color:red">*</span></label>
                                    <input type="text" name="country" class="form-control" id="validationCustom02"
                                        placeholder="Enter Your Country">
                                    <span class="text-danger">@error('country')
                                        {{ $message }} @enderror</span>
                                        <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter the Country.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">State<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom03" name="state"
                                        placeholder="Enter Your State">
                                    <span class="text-danger">@error('state'){{ $message }} @enderror</span>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter the State.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">City<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom04" name="city"
                                        placeholder="Enter Your Living City">
                                    <span class="text-danger">@error('city'){{ $message }} @enderror</span>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid city name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputZip" class="form-label">Zipcode<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="formrow-inputZip" name="zipcode"
                                        placeholder="Enter Your Zip Code">
                                    <span class="text-danger">@error('zipcode'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title mb-4">Other Details</h4>
                                    <div class="mb-3">
                                        <label for="formrow-inputZip" class="form-label">Time Zone<span style="color:red">*</span></label>
                                        <input type="text" name="timezone" class="form-control" id="formrow-inputZip"
                                            placeholder="Enter Your Time Zone">
                                        <span class="text-danger">@error('timezone'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <h5 class="card-title mb-4">Add Zones</h5>
                                <div class="repeater">
                                    <div data-repeater-list="zones">
                                        <div data-repeater-item class="row">
                                            <div class="mb-3 col-lg-3">
                                                <label for="formrow-firstname-input" class="form-label">Building</label>
                                                <input type="text" name="building_name" class="form-control"
                                                    id="formrow-firstname-input" placeholder="Building Name">
                                                <span class="text-danger">@error('building_name'){{ $message }}
                                                    @enderror</span>
                                            </div>
                                            <div class="mb-3 col-lg-3">
                                                <label for="name">Level</label>
                                                <input type="text" name="level_name" class="form-control"
                                                    id="formrow-firstname-input" placeholder="Level">
                                                <span class="text-danger">@error('level_name'){{ $message }}
                                                    @enderror</span>
                                            </div>
                                            <div class="mb-3 col-lg-3">
                                                <label for="name">Zone</label>
                                                <input type="text" class="form-control" id="formrow-inputZip"
                                                    name="zone_name" placeholder="Enter Your Zone ID"><span
                                                    class="text-danger">@error('zone_name'){{ $message }}
                                                    @enderror</span>
                                            </div>

                                            <div class="col-lg-3 mt-2 align-self-center">
                                                <div class="d-grid">
                                                    <input data-repeater-delete type="button" class="btn btn-primary"
                                                    value="Delete" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input data-repeater-create type="button"
                                            class="btn btn-success mt-3 btn-lg mt-lg-0" value="Add Zone" />
                                        <button type="submit"
                                            class="btn btn-primary btn-lg w-md mt-3 m-lg-3">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end row -->

@endsection

@section('script')
    <!-- form repeater js -->
     <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}">
    </script>
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
