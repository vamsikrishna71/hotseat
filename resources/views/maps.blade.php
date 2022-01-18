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
                    <div class="test" style="display:none"></div>
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
        var markers = [];
        var myMap = L.map("leaflet-map").setView([-41.2858, 174.78682], 1);
        $(function() {
            // webpackBootstrap
            var __webpack_exports__ = {};
            /*!************************************************!*\
              !*** ./resources/js/pages/leaflet-map.init.js ***!
              \************************************************/
            
            var southWest = new L.LatLng(10.712, -54.227),
                northEast = new L.LatLng(50.774, -74.125),
                south = new L.LatLng(60.220, -80);

            bounds = new L.LatLngBounds(southWest, northEast, south);

            var myIcon = L.icon({
                iconUrl: '/images/seat-open.png',
                iconSize: [30],
            });

            function popupContentReady(id) {
                return "<div class='row popcontent-" + id + "'>\
                                    <div class='col-12'>\
                                <div class='mb-3'>\
                                    <label for='deskName'class='form-label'>Desk Name<span style='color:red'>*</span></label>\
                                    <input type='text' class='form-control @error('deskName') is-invalid @enderror' id='deskName-" + id +
                    "' value='Desk-" + id + "'name='deskName' autofocus>\
                                </div>\
                                <div class='mb-3'>\
                                    <label for='employeeName' class='form-label'>Employee Name<span style='color:red'>*</span></label>\
                                    <input type='text' class='form-control @error('employeeName') is-invalid @enderror' id='employeeName-" +
                    id +
                    "' value='" + id + "' name='employeeName' autofocus>\
                                </div>\
                                <div class='d-flex align-items-center justify-content-around'>\
                                    <button data-classname='popcontent-'" + id + "' type='button' class='btn btn-sm\
                                    btn-success text-light waves-effect fw-semibold get-markers'>SAVE</a>\
                                    <button data-classname='popcontent-'" + id + "' class='btn btn-sm btn-danger text-light waves-effect fw-semibold marker-delete-button' id='popcontentDelete' onclick='deletePop(\"popcontent-"+id+"\")'>Delete</button>\
                                </div>\
                            </div>\
                        </div>";
            }

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

            function onMapClick(e) {
                marker = new L.marker(e.latlng, {
                    draggable: true,
                    icon: myIcon,
                    // bounceOnAdd: true,
            });
            
            // marker.on('click', function () {
            // marker.bounce({duration: 500, height: 100});
            // });
            
                markers.push(
                    [{
                        "markerobj": marker,
                        "className": 'popcontent-' + markerClick
                    }]
                );

                // console.log(markers['markerobj']);
                marker.bindPopup(
                    popupContentReady(markerClick)
                );
                markerClick++;
                myMap.addLayer(marker);
            };

            var markerClick = 1;
            myMap.on('click', onMapClick);
            myMap.fitBounds(bounds);
        });

        function deletePop(classname) {
            $.each(markers, function(index, value) {
                $.each(value, function(index, value) {
                    if (value.className == classname) {
                        var markerobj = value.markerobj;;
                        myMap.removeLayer(markerobj);
                        alert('Removed Succesfully');
                    }
                })
            });
        }

        // $.ajax({
        //     url: '{{ url('deskAssign') }}',
        //     type: 'POST',
        //     data: $('#deskAssign').serialize(),
        //     success: function(response) {
        //         $('#submit').html('Submit');
        //         $('#submit').attr('disabled', false);
        //         alert('Desk Assigned successfully');
        //         document.getElementById('deskAssign').reset();
        //     }
        // });


    </script>
    // {{-- <script src="{{ URL::asset('/assets/js/pages/leaflet-map.init.js') }}"></script> --}}
@endsection
