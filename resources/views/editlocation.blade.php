@extends('layouts.master')

@section('title') Edit Location @endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Location @endslot
        @slot('title') Edit Location @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Address</h4>
                    <form action="{{ route('location.update', ['location_id' => $location->id]) }}" method="post">
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
                        @if ($message = Session::get('status'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ old('address', $location->address) }}"
                                        id="formrow-firstname-input address" placeholder="Address" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputState" class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" id="formrow-inputCity country"
                                        value="{{ old('country', $location->country) }}" placeholder="Enter Your Country"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputState" class="form-label">State</label>
                                    <input type="text" class="form-control" id="formrow-inputCity state" name="state"
                                        value="{{ old('state', $location->state) }}" placeholder="Enter Your State">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="formrow-inputCity city"
                                        value="{{ old('city', $location->city) }}" name="city"
                                        placeholder="Enter Your Living City">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formrow-inputZip" class="form-label">Zipcode</label>
                                    <input type="text" class="form-control" id="formrow-inputZip zipcode" name="zipcode"
                                        value="{{ old('zipcode', $location->zipcode) }}" placeholder="Enter Your Zip Code">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title mb-4">Other Details</h4>
                                    <div class="mb-3">
                                        <label for="formrow-inputZip" class="form-label">Time Zone</label>
                                        <input type="text" name="timezone" class="form-control"
                                            value="{{ old('timezone', $location->timezone) }}"
                                            id="formrow-inputZip timezone" placeholder="Enter Your Time Zone">
                                    </div>
                                </div>
                                @foreach ($location->zone as $zone)
                                    <h5 class="card-title mb-4">Add Zones</h5>
                                    <div class="repeater">
                                        <div data-repeater-list="zones">
                                            <div data-repeater-item class="row">
                                                <div class="mb-3 col-lg-3">
                                                    <label for="formrow-firstname-inpu"
                                                        class="form-label">Building</label>
                                                    <input type="text" name="building_name" class="form-control"
                                                        value="{{ old('building_name', $zone->building_name) }}"
                                                        id="formrow-firstname-input building_name"
                                                        placeholder="Building Name" required>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="name">Level</label>
                                                    <input type="text" name="level_name" class="form-control"
                                                        value="{{ old('level_name', $zone->level) }}"
                                                        id="formrow-firstname-input level_name" placeholder="Level">
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="name">Zone</label>
                                                    <input type="text" class="form-control"
                                                        id="formrow-inputZip zone_name"
                                                        value="{{ old('zone_name', $zone->zone) }}" name="zone_name"
                                                        placeholder="Enter Your Zone ID">
                                                </div>

                                                <div class="col-lg-3 mt-2 align-self-center">
                                                    <div class="d-grid">
                                                        <input data-repeater-delete type="button" class="btn btn-primary"
                                                            value="Delete" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    <input data-repeater-create type="button" class="btn btn-success mt-3 btn-lg mt-lg-0"
                                        value="Add Zone" />
                                    <button type="submit" class="btn btn-success btn-lg w-md mt-3 m-lg-3">Submit</button>
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
    <script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
@endsection
