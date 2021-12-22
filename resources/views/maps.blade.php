@extends('layouts.master')

@section('title') Add Desk @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/jquery-vectormap/jquery-vectormap.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Desks @endslot
        @slot('title') Maps @endslot
    @endcomponent
    <div class="row mb-4">
        <div class="col-12">
            <span class="text-dark">Desks / All Desks / Maps</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">World Vector Map</h4>
                    <p class="card-title-dsec">Example of world vector maps.</p>
                    <div id="world-map-markers" style="height: 420px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

@endsection
@section('script')
    <!-- Plugins js-->
    <script src="{{ URL::asset('/assets/libs/jquery-vectormap/jquery-vectormap.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ URL::asset('/assets/js/pages/vector-maps.init.js') }}"></script>
@endsection
