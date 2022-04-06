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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Success!</strong>
      <small>2 secs ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Desk Added Successfully
    </div>
  </div>
</div>
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
                    <button type="submit" class="btn btn-success float-end"
                    onclick='save()'>Save</button>

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
    @endphp
@endsection


@section('script')
    <!-- leaflet plugin -->
    <script src="{{ URL::asset('/assets/libs/leaflet/leaflet.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/leaflet-us-states.js') }}"></script>
    <script>
        $(function() {
            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled',
                onstyle: 'success',
                offstyle: 'danger'
            });
            
        })
    </script>
    <!-- leaflet map.init -->
    <script>
        /******/
        var markers = [];
        var markerClick = 1;
        var deskName;
        var employeeName;
        bounds = new L.LatLngBounds(new L.LatLng(28.5, -10.3), new L.LatLng(61.2, 60.5));
        var zoom = 2;
        var myMap = L.map("leaflet-map", {
            center: [0, 0],
            crs: L.CRS.Simple,
            zoom: zoom,
            zoomSnap: 0.1,
            zoomDelta: 0.1,
        });
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

            var img = new Image();
            var imgUrl = <?php echo json_encode($mapTileImage); ?>

            img.onload = function() {
                var h = img.height,
                    w = img.width,
                    southWest = myMap.unproject([-w, h], zoom),
                    northEast = myMap.unproject([w, -h], zoom),
                    bounds = new L.LatLngBounds(southWest, northEast);
                L.imageOverlay(imgUrl, bounds).addTo(myMap);
                myMap.setMaxBounds(bounds);
                myMap.fitBounds(bounds);
            };
            img.src = imgUrl;
            editMarker();

            function onMapClick(e) {
                marker = new L.marker(e.latlng, {
                    draggable: true,
                    icon: greenIcon,
                    autoPan: true,
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
                <div class='form-check form-switch toggle-button'>\
                <input class='form-check-input' data-classname='popcontent-'" + id + "' id='saveDeskForm'\
                onclick='savePop(\"popcontent-" + id + "\"," + id + " )' type='checkbox' role='switch' id='flexSwitchCheckDefault'>\
                <label class='form-check-label text-muted' for='flexSwitchCheckDefault'>Enable Desk</label>\
                </div>\
                <div class='d-flex align-items-center justify-content-around'>\
                \<button data-classname='popcontent-'" + id +
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
                    var markerobj = markers[id-1].markerobj;
                    var desk = $('#deskName-' + id).val();
                    var employee = $('#employeeName-' + id).val();
                    var positions = markerobj.getLatLng();
                    markers[id-1].desk = desk;
                    markers[id-1].employee = employee;
                    $('.test #deskName-' + id).val(desk);
                    $('.test #employeeName' + id).val(employee);
                    var callContent = $('.test').find('popcontent' + id).html();
                    markerobj.bindPopup(callContent);
                    markerobj.bindTooltip(desk);
                    markerobj.on('mouseover', customTip);
                    markerobj.setIcon(greenIcon).closePopup();
                    markerobj.dragging.disable();
                    return false;
                }

        function editMarker() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('mapAssign') }}',
                type: 'post',
                dataType: 'json',
                data: {
                    'deskId': {{ $floor->id }}
                },
                success: function(response) {
                    if (response) {
                        for (var i = 0; i < response.length; i++) {
                            // console.log(response[i]);
                            marker = new L.marker([response[i].latitude, response[i].longitude], {
                                draggable: false,
                                icon: greenIcon,
                                autoPan: true,
                                raiseOnHover: true,
                            }).bindTooltip(response[i].employee_name).addTo(myMap);
                            marker.bindPopup(popupContentReady(
                                markerClick,
                                response[i].employee_name,
                                response[i].desk_name
                            ));
                            $('.test').append(popupContentReady(
                                markerClick,
                                response[i].employee_name,
                                response[i].desk_name
                            ));
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

        function updateMarker() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('updateDeskAssign') }}',
                type: 'post',
                dataType: 'json',
                data: {
                    'deskId': {{ $floor->id }}
                },
                success: function(response) {
                    alert(response);
                }
            });
        }
        
        function save() {
                    var desks = [];
                    if (markers.length) {
                        markers.forEach(function(marker, index) {
                            desks.push({
                                'latitude': marker.markerobj.getLatLng().lat,
                                'longitude': marker.markerobj.getLatLng().lng,
                                'desk': marker.desk,
                                'employee' : marker.employee
                            });
                        });

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{ route('deskAssign') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'floorId': {{ $floor->id }},
                                'desks': desks
                            },
                            success: function(response) {
                                if(response.success === true) {
                                alert(response.message);
                                }else if(response.success === false){
                                    alert(response.message);
                                } else {
                                    alert('Something went wrong!');
                                }
                            }
                        });
                    } else {
                        alert('no desk allocated');
                    }
                }
    </script>
    // {{-- <script src="{{ URL::asset('/assets/js/pages/leaflet-map.init.js') }}"></script> --}}
@endsection
