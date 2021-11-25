@extends('layouts.master')

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title') MY WORK @endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">MY WORK</h4>
                    </div>
                    <div class="col-md-6 mb-3 text-end">
                        <a href="{{url('bookseat')}}">
                            <button type="button" class="btn btn-success waves-effect waves-light">
                                <i class="fas fa-plus px-1"></i> Book New
                            </button>
                        </a>
                    </div>
                </div>

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="width: 10px;">
                                <input class="form-check-input" type="checkbox" id="formCheck1">
                            </th>
                            <th>Date</th>
                            <th>Work From</th>
                            <th>Time Slot</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" id="formCheck1">
                            </td>
                            <td>o6 Nov, 2021</td>
                            <td>Office</td>
                            <td>08:00 - 17:30 UTC 00</td>
                            <td>Location 1</td>
                            <td>
                                <a href="#" class="text-dark fs-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="fs-3" style="color: red;">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" id="formCheck1">
                            </td>
                            <td>o7 Nov, 2021</td>
                            <td>Office</td>
                            <td>08:00 - 17:30 UTC 00</td>
                            <td>Location 2</td>
                            <td>
                                <a href="#" class="text-dark fs-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="fs-3" style="color: red;">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
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