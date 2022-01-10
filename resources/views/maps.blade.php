@extends('layouts.master')

@section('title') @lang('translation.Leaflet_Maps') @endsection

@section('css')
    <!-- leaflet Css -->
    <link href="{{ URL::asset('/assets/libs/leaflet/leaflet.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/toastr/toastr.min.css') }}">
    <link href="{{ URL::asset('/css/cutom.css') }}" id="custom-style" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Maps @endslot
        @slot('title') Floor Name @endslot
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
            <div class="mb-3 floor-map-date">
                <input class="form-control" type="date" value="0000-00-00" id="example-date-input">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <label for="floor">Floor name</label>

                    <h4 class="card-title mb-4">{{ $floor->floor_name }}</h4>
                    {{-- {{ dd($floor->floor_map) }} --}}
                    <div id="leaflet-map" class="leaflet-map">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end row -->
    @php
    $mapTileImage = $floor->floor_map;
    @endphp
@endsection


@section('script')
    <!-- leaflet plugin -->
    <script src="{{ URL::asset('/assets/libs/leaflet/leaflet.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/leaflet-us-states.js') }}"></script>
    <!-- leaflet map.init -->
    <script>
        /******/
        $(function() {
            // webpackBootstrap
            var __webpack_exports__ = {};
            /*!************************************************!*\
              !*** ./resources/js/pages/leaflet-map.init.js ***!
              \************************************************/
            var myMap = L.map("leaflet-map").setView([-41.2858, 174.78682], 1);
            var markerId = 0;
            var myIcon = L.icon({
                iconUrl: '/images/circle-icon-16068.png',
                iconSize: [30],
            });


            //For local
            var imgUrl = <?php echo json_encode($mapTileImage); ?>

            L.tileLayer(imgUrl, {
                maxZoom: 10,
                attribution: "mapbox/streets-v11",
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(myMap), L.marker([51.5, -.09], {
                draggable: true,
                icon: myIcon
            }).addTo(myMap).bindPopup(
                '<b>Desk Available</b>!</b><br />Here We go!.').openPopup();

            // Form Data 

            function onMapClick(e) {
                marker = new L.marker(e.latlng, {
                    draggable: true,
                    icon: myIcon,
                }).bindPopup(
                    "<form action='javascript:void(0)' id='deskAssign' name='deskAssign'>\
                                <div class='row'>\
                                    <div class='col-12'>\
                                    <div class='mb-3'>\
                                    <label for='deskName'class='form-label'>Desk Name<span style='color:red'>*</span></label>\
                                    <input type='text' class='form-control @error('deskName') is-invalid @enderror' id='deskName' value='Desk1' name='deskName' autofocus>\
                                    </div>\
                                    <div class='mb-3'>\
                                    <label for='zoneName' class='form-label'>Zone Name<span style='color:red'>*</span></label>\
                                    <input type='text' class='form-control @error('zoneName') is-invalid @enderror' id='zoneName' value='zoneName' name='zoneName' autofocus>\
                                    </div>\
                                    <div class='mb-3'>\
                                    <label for='employeeName' class='form-label'>Employee Name<span style='color:red'>*</span></label>\
                                    <input type='text' class='form-control @error('employeeName') is-invalid @enderror' id='employeeName' value='Employee' name='employeeName' autofocus>\
                                    </div>\
                                    <div class='d-flex align-items-center justify-content-around'>\
                                        <a href='#' type='button' class='btn btn-sm\
                                        btn-success text-light waves-effect fw-semibold'>SAVE</a>\
                                        <a href='#' type='button' class='btn btn-sm btn-danger text-light waves-effect fw-semibold'>CANCEL</a>\
                                    </div>\
                                    </div>\
                                    </div>\
                                    </form>").openPopup();

                // if ($('#deskAssign').length > 0) {
                //     $('#deskAssign').validate({
                //         rules: {
                //             deskName: {
                //                 required: true,
                //                 maxlength: 50
                //             },
                //             employeeName: {
                //                 required: true,
                //                 maxlength: 50,
                //             },
                //         },
                //         messages: {
                //             deskName: {
                //                 required: 'Please enter name',
                //                 maxlength: 'Your name maxlength should be 50 characters long.'
                //             },
                //             employeeName: {
                //                 required: 'Please enter valid employee',
                //                 maxlength: 'The employee name should less than or equal to 50 characters',
                //             },
                //         },
                //         // submitHandler: function(form) {
                //         //     $.ajaxSetup({
                //         //         headers: {
                //         //             'X-CSRF-TOKEN': $('meta[name='
                //         //                 csrf - token ']').attr('content')
                //         //         }
                //         //     });
                //         //     $('#submit').html('Please Wait...');
                //         //     $('#submit').attr('disabled', true);

                //         //     $.ajax({
                //         //         url: '{{ url('deskAssign') }}',
                //         //         type: 'POST',
                //         //         data: $('#deskAssign').serialize(),
                //         //         success: function(response) {
                //         //             $('#submit').html('Submit');
                //         //             $('#submit').attr('disabled', false);
                //         //             alert('Desk Assigned successfully');
                //         //             document.getElementById('deskAssign').reset();
                //         //         }
                //         //     });
                //         // }
                //     })
                // }
                myMap.addLayer(marker);
            };
            myMap.on('click', onMapClick);
        });
    </script>
    // {{-- <script src="{{ URL::asset('/assets/js/pages/leaflet-map.init.js') }}"></script> --}}
@endsection
