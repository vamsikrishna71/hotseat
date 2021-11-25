@extends('layouts.master')

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title') Location @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Location @endslot
@slot('title') Locations Overview @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">All Location</h4>

                <div class="row">
                    {{--  <div class="col-sm-12 col-md-3 mb-3">
                        <select id="formrow-inputState" class="form-select">
                            <option selected>Select Country</option>
                                @foreach (\App\Models\Location::select('country')->get() as $country )
                                    <option>{{ $country->country }}</option>
                                @endforeach
                        </select>
                    </div>  --}}
                    <div class="col-sm-12 offset-md-12 col-md-12 mb-3 text-end">
                        <a href="{{ url('addlocation') }}">
                            <button type="button" class="btn btn-success waves-effect waves-light">
                                <i class="fas fa-plus px-1"></i> Add New Location
                            </button>
                        </a>
                    </div>
                </div>

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>Area</th>
                            <th>Building Name</th>
                            <th>Levels</th>
                            <th>Time Zone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($location as $centre )
                            <tr>
                            <td>{{ $centre->city }}</td>
                            <td>{{ $centre->country }}</td>
                            <td>Building 1</td>
                            <td>Level 0</td>
                            <td>{{ $centre->timezone }}</td>
                            <td>
                                <a href="#" class="text-dark fs-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="fs-3" style="color: red;">
                                    {{--  <form class="d-inline"
                                                         action="{{ url('destroy') }}"
                                                         method="post">
                                                         @csrf
                                                         @method('DELETE')
                                                         <input type="submit" class="btn btn-danger" >
                                                     </form>  --}}
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('script')
<!-- Required datatable js -->
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
