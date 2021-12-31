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
        @slot('title') Leaflet Maps @endslot
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <label for="floor">Floor Name</label>
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
            var imgUrl = <?php echo json_encode($mapTileImage); ?>

            L.tileLayer(imgUrl, {
                maxZoom: 10,
                attribution: "mapbox/streets-v11",
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(myMap), L.marker([51.5, -.09], {
                draggable: true,
            }).addTo(myMap).bindPopup(
                '<b>Desk Available</b>!</b><br />Here We go!.').openPopup();

            function onMapClick(e) {
                marker = new L.marker(e.latlng, {
                    draggable: 'true'
                }).bindPopup(
                    "<div class='row'>\
                    <form>\
                    <div class='col-lg-12'>\
                        <div class='mb-2'>\</br>\
                            <label for='deskName' class='form-label'>Desk Name<span style='color:red'>*</span></label>\</br>\
                            <input type='text' class='form-control @error('deskName') is-invalid @enderror' id='deskName' value='Desk1' name='deskName' autofocus>\</br>\
                        </div>\
                    </div>\
                    <div class='modal-footer'>\
                        <button type='submit' class='btn btn-success'>Create</button>\
                    </div>\
                </form>\
            </div>").openPopup();

                marker.on('dragend', function(event) {
                    var marker = event.target;
                    var position = marker.getLatLng();
                    marker.setLatLng(new L.LatLng(position.lat, position.lng), {
                        draggable: 'true'
                    });
                    myMap.panTo(new L.LatLng(position.lat, position.lng))
                });
                myMap.addLayer(marker);
            };
            myMap.on('click', onMapClick);
            /******/
            // Add a new repeating section
            $('.addDesk').click(function() {
                var currentCount = $('.repeatingSection').length;
                var newCount = currentCount + 1;
                var deskId = $('#deskName').length;
                var lastRepeatingGroup = $('.repeatingSection').last();
                var newSection = lastRepeatingGroup.clone();
                newSection.insertAfter(lastRepeatingGroup);
                newSection.find("input").each(function(index, input) {
                    input.id = input.id.replace("_" + currentCount, "_" + newCount);
                    input.name = input.name.replace("_" + currentCount, "_" + newCount);
                });
                newSection.find("label").each(function(index, label) {
                    var l = $(label);
                    l.attr('for', l.attr('for').replace("_" + currentCount, "_" + newCount));
                });
                return false;
            });

            // Delete a repeating section
            $(document).on('click', '.deleteDesk', function() {
                $(this).parent('div').remove();
                return false;
            });
        });
    </script>
    // {{-- <script src="{{ URL::asset('/assets/js/pages/leaflet-map.init.js') }}"></script> --}}
@endsection
