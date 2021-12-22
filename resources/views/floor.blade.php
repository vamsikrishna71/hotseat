@extends('layouts.master')

@section('title') Add Desk @endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Desk Reservation System @endslot
        @slot('title') Dashbaord @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Setup Desks</h4>
                <hr>
                <p class="mb-0">Create a floor to get started or Import CSV</p>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-success btn-lg" type="button" data-bs-toggle="modal" data-bs-target="#createFloor">Create
                Floor</button>
            <button class="btn btn-primary btn-lg" type="button">Import CSV</button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createFloor" tabindex="-1" aria-labelledby="createFloor" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Floor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="floorName" class="form-label">Floor Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="floorName"
                            value="Floor 4" name="email" placeholder="Enter email" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="floorMap" class="form-label">Floor Map <span style="color:red">*</span></label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="floorMap"
                                name="logo" autofocus required>
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                    <button type="button" class="btn btn-success">Create</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}">
    </script>
@endsection
