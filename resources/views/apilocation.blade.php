@extends('layouts.master')

@section('title') Add Location @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Location @endslot
@slot('title') Add Location @endslot
@endcomponent
<div class="container mt-5">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h5 class="card-title text-white">Address</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="autocomplete"> Location/City/Address </label>
                            <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Select Location">
                        </div>

                        <div class="form-group" id="lat_area">
                            <label for="latitude"> Latitude </label>
                            <input type="text" name="latitude" id="latitude" class="form-control">
                        </div>

                        <div class="form-group" id="long_area">
                            <label for="latitude"> Longitude </label>
                            <input type="text" name="longitude" id="longitude" class="form-control">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"> Submit </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- form repeater js -->
<script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
{{-- javascript code --}}
   <script src="https://maps.google.com/maps/api/js?key=AIzaSyDcwGyRxRbcNGWOFQVT87A1mkxEOfm8t0w&libraries=places&callback=initAutocomplete" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
       });
   </script>


   <script>
       google.maps.event.addDomListener(window, 'load', initialize);

       function initialize() {
           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }
    </script>
@endsection
