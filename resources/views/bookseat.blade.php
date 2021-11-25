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

                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Building</label>
                                <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Building Name">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Address 1</label>
                                <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Address 1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Address 2</label>
                                <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Address 2">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="formrow-inputCity" class="form-label">City</label>
                                <input type="text" class="form-control" id="formrow-inputCity" placeholder="Enter Your Living City">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">State</label>
                                <select id="formrow-inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="formrow-inputZip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="formrow-inputZip" placeholder="Enter Your Zip Code">
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Country</label>
                                <select id="formrow-inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
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

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Other Details</h4>

                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-inputZip" class="form-label">Zone</label>
                                <input type="text" class="form-control" id="formrow-inputZip" placeholder="Enter Your Zone">
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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Add Level</h5>

                <form class="repeater" enctype="multipart/form-data">
                    <div data-repeater-list="group-a">
                        <div data-repeater-item class="row">
                            <div class="mb-3 col-lg-3">
                                <label for="name">Level</label>
                                <select id="formrow-inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>1</option>
                                </select>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="name">Zone</label>
                                <input type="text" class="form-control" id="formrow-inputZip" placeholder="Enter Your Zone ID">
                            </div>

                            <div class="col-lg-3 mt-2 align-self-center">
                                <div class="d-grid">
                                    <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add Zone/Level" />
                    <button type="submit" class="btn btn-primary w-md mt-3 mt-lg-0">Submit</button>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection

@section('script')
<!-- form repeater js -->
<script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
@endsection