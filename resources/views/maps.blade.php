@extends('layouts.master')

@section('title') @lang('translation.Leaflet_Maps') @endsection

@section('css')
    <!-- leaflet Css -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ URL::asset('/assets/libs/leaflet/leaflet.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
                    <div class="alert alert-success d-none" id="saveMessage">
                        <span id="responseMessage"></span>
                    </div>
                    <h4 class="card-title mb-4">{{ $floor->floor_name }}</h4>
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
    @php
    $mapTileImage = $floor->floor_map;
    // $latitude = $map->latitude;
    // $longitude = $map->longitude;
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
        var markerClick = 1;
        var deskName;
        var employeeName;

        var myMap = L.map("leaflet-map").setView([-41.2858, 174.78682], 10);
        var LeafIcon = L.Icon.extend({
            options: {
                iconSize: [25],
            }
        });

        var redIcon = new LeafIcon({
            iconUrl: '/images/seat-booked.png'
        });
        var greenIcon = new LeafIcon({
            iconUrl: '/images/seat-open.png'
        });
    
        $(function() {
            // webpackBootstrap
            var __webpack_exports__ = {};
            /*!************************************************!*\
              !*** ./resources/js/pages/leaflet-map.init.js ***!
              \************************************************/

            var southWest = new L.LatLng(10.712, -54.227),
                northEast = new L.LatLng(50.774, -74.125),
                south = new L.LatLng(60.220, -80);
                north = new L.LatLng(80,70);
            var bounds = new L.LatLngBounds(southWest, northEast, south, north);

            var imgUrl = <?php echo json_encode($mapTileImage); ?>

             L.tileLayer(imgUrl, {
                bounds: bounds,
                center: [17.385044, 78.486671],
                maxZoom: 13,
                attribution: "mapbox/streets-v11",
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(myMap);

            updateMarker();
             
            function onMapClick(e) {
                marker = new L.marker(e.latlng, {
                    draggable: true,
                    icon: greenIcon,
                    autoPan:true,
                    raiseOnHover: true,
                });
                
                markers.push({
                    "markerobj": marker,
                    "className": 'popcontent-' + markerClick
                });

                marker.bindPopup(
                    popupContentReady(markerClick)
                );
                $('.test').append(popupContentReady(markerClick));

                markerClick++;
                myMap.addLayer(marker);
            };

            myMap.on('click', onMapClick);
            myMap.fitBounds(bounds);
            // myMap.setMaxBounds(myMap.getBounds());
        });

        function popupContentReady(id, employeeName = '', deskName = '') {
                var desk = !deskName ? 'desk-' + id : deskName;
                var employee = !employeeName ? 'employee-' + id : employeeName;
                
                return "<div class='row popcontent-" + id +
                    "'>\
                        <div class='col-12'>\
                             <div class='mb-3'>\
                              <label for='deskName'class='form-label'>Desk Name<span style='color:red'>*</span></label>\
                            <input type='text' class='form-control deskName @error('deskName') is-invalid @enderror' id='deskName-" +
                    id +
                    "' value='" + desk +
                    "'name='deskName' autofocus>\
                        </div>\
                        <div class='mb-3'>\
                        <label for='employeeName' class='form-label'>Employee Name<span style='color:red'>*</span></label>\
                        <input type='text' class='form-control employeeName @error('employeeName') is-invalid @enderror' id='employeeName-" +
                    id +
                    "' value='" + employee + "' name='employeeName' autofocus>\
                        </div>\
                        <div class='d-flex align-items-center justify-content-around'>\
                        <button data-classname='popcontent-'" + id + "' type='button' class='btn btn-sm\
                        btn-success text-light waves-effect fw-semibold get-markers'\
                        id='saveDeskForm'\
                        onclick='savePop(\"popcontent-" + id + "\"," + id + " )'>Save</a>\
                        <button data-classname='popcontent-'" + id +
                    "' class='btn btn-sm btn-danger text-light waves-effect fw-semibold marker-delete-button' id='popcontentDelete' onclick='deletePop(\"popcontent-" +
                    id + "\")'>Delete</button>\
                    </div>\
                </div>\
            </div>";
        }

        function deletePop(classname) {
            $.each(markers, function(index, value) {
                if (value.className == classname) {
                    var markerobj = value.markerobj;
                    myMap.removeLayer(markerobj);
                }
            });
        }

        function savePop(classname, id, e) {
            $.each(markers, function(index, value) {
                if (value.className == classname) {
                    var markerobj = value.markerobj;
                    var curentDeskName = $('#deskName-' + id).val();
                    var currentEmployee = $('#employeeName-' + id).val();
                    var positions = markerobj.getLatLng();
                    deskSaveForm(curentDeskName, currentEmployee, positions);
                    $('.test #deskName-' + id).val(curentDeskName);
                    $('.test #employeeName' + id).val(currentEmployee);
                    var callContent = $('.test').find('popcontent' + id).html();
                    markerobj.bindPopup(callContent);
                    markerobj.bindTooltip('This place is booked by ' + currentEmployee);
                    markerobj.on('mouseover', customTip);
                    markerobj.setIcon(redIcon).closePopup();
                    markerobj.dragging.disable();
                    return false;
                }
            });
        }

        function updateMarker(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('mapAssign') }}',
                type: 'post',
                dataType: 'json',
                data:{
                    'deskId':{{ $floor->id }}
                },
                success: function(response) {
                    if(response) {
                        for (var i = 0; i < response.length; i++) {
                            // console.log(response[i]);
                            marker = new L.marker([response[i].latitude,response[i].longitude],{
                                draggable: false,
                                icon: redIcon,
                                autoPan:true,
                                raiseOnHover: true,
                            }).bindTooltip(response[i].employee_name).addTo(myMap);
                            marker.bindPopup(popupContentReady(
                                    markerClick,
                                    response[i].employee_name,
                                    response[i].desk_name
                                )
                            );
                            $('.test').append(popupContentReady(
                                    markerClick,
                                    response[i].employee_name,
                                    response[i].desk_name
                                )
                                );
                        }
                    }
                }
            });
        }
        
        function customTip() {
            if (!this.isPopupOpen()) {
                this.openTooltip();
            }
        }

        function deskSaveForm(deskName, employee, positions) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('deskAssign') }}',
                type: 'POST',
                data: {
                    'deskId': {{ $floor->id }},
                    'deskName': deskName,
                    'employeeName': employee,
                    'latitude' : positions.lat,
                    'longitude' : positions.lng
                },
                success: function(response) {
                    // alert('saved');
                }
            });
        }
        
    </script>
    // {{-- <script src="{{ URL::asset('/assets/js/pages/leaflet-map.init.js') }}"></script> --}}
@endsection
