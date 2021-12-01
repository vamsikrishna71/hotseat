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
                    <h4 class="card-title mb-4">Address</h4>

                    <form action="{{ route('addlocation') }}" method="post">
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
                                    <label for="formrow-firstname-input" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="formrow-firstname-input"
                                        placeholder="Address">
                                        <span class="text-danger">@error('address'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputState" class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" id="formrow-inputCity"
                                        placeholder="Enter Your Country">
                                        <span class="text-danger">@error('country'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputState" class="form-label">State</label>
                                    <input type="text" class="form-control" id="formrow-inputCity" name="state"
                                        placeholder="Enter Your State">
                                        <span class="text-danger">@error('state'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="formrow-inputCity" name="city"
                                        placeholder="Enter Your Living City">
                                        <span class="text-danger">@error('city'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputZip" class="form-label">Zipcode</label>
                                    <input type="text" class="form-control" id="formrow-inputZip" name="zipcode"
                                        placeholder="Enter Your Zip Code">
                                        <span class="text-danger">@error('zipcode'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title mb-4">Other Details</h4>
                                    <div class="mb-3">
                                        <label for="formrow-inputZip" class="form-label">Time Zone</label>
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
                                                    <span class="text-danger">@error('building_name'){{ $message }} @enderror</span>
                                            </div>
                                            <div class="mb-3 col-lg-3">
                                                <label for="name">Level</label>
                                                <input type="text" name="level_name" class="form-control"
                                                    id="formrow-firstname-input" placeholder="Level">
                                                    <span class="text-danger">@error('level_name'){{ $message }} @enderror</span>
                                            </div>
                                            <div class="mb-3 col-lg-3">
                                                <label for="name">Zone</label>
                                                <input type="text" class="form-control" id="formrow-inputZip" name="zone_name"
                                                    placeholder="Enter Your Zone ID"><span class="text-danger">@error('zone_name'){{ $message }} @enderror</span>
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
                                        <input data-repeater-create type="button" class="btn btn-success mt-3 btn-lg mt-lg-0"
                                        value="Add Zone" />
                                        <button type="submit" class="btn btn-primary btn-lg w-md mt-3 m-lg-3">Submit</button>
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
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
@endsection
