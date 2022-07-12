@extends('layouts.master')

@section('title')
    @lang('translation.Leaflet_Maps')
@endsection
@section('css')
    <!-- leaflet Css -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ URL::asset('/assets/libs/leaflet/leaflet.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Bower --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/toastr/toastr.min.css') }}">
    <link href="{{ URL::asset('/css/cutom.css') }}" id="custom-style" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Maps
        @endslot
        @slot('title')
            Floor Name
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
        <div class="col-12">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
            <div class="floor-map-date mb-3">
                <input class="form-control" type="date" value="0000-00-00" id="example-date-input">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <label for="floor">Floor name</label>
                    <div class="alert alert-success d-none" id="saveMessage">
                        <span id="responseMessage"></span>
                    </div>
                    {{-- <button type="submit" class="btn btn-success float-end"
                    onclick='save()'>Save</button> --}}

                    {{-- <h4 class="card-title mb-4">{{ $hotdesk->floor_name }}</h4> --}}
                    {{-- {{ dd($maps->desk_name) }} --}}
                    <div id="leaflet-map" class="leaflet-map">
                    </div>
                    <div class="test" style="display:none"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end row -->
@endsection

